<?php

class Order_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function generateOrder() {

        $customer_info = $this->customer_model->getLogedInCustomer();
        $shipping_address_string = $customer_info['customer_aadress_line_1'].','.
                                    $customer_info['customer_aadress_line_2'].','.
                                    $customer_info['customer_location'];
        $data = array(
            'order_customer_id' => $customer_info['customer_id'],
            'order_customer_name' => $customer_info['customer_name'],
            'order_customer_mobile' => $customer_info['customer_mobile'],
            'order_shipping_address' => $shipping_address_string,
            'order_status' => 'new',
            'order_time' => time(),
        );

        if ($this->db->insert('order', $data)) {
            $created_order_id = $this->db->insert_id();

            if ($this->setOrderItems($created_order_id)) {
                $this->subtractFromStock();
            }
            
            $this->cart->destroy();
            
            return $created_order_id;
        } else {
            return FALSE;
        }
    }

    function subtractFromStock() {
        foreach ($this->cart->contents() as $item) {
            $sku = $item['id'];
            $quantity = $item['qty'];
            if ($this->product_model->get_stock($sku) >= $quantity) {
                $this->db->set('product_stock', "product_stock - $quantity", FALSE);
                $this->db->where("product_sku = '$sku'");
                $this->db->update('product');
            }
        }
    }

    function setOrderItems($order_id) {
        $data = array();
        foreach ($this->cart->contents() as $item) {

            $item_options_string = '';
            foreach ($item['options'] as $item_option_key => $item_option_value) {
                $item_options_string .= $item_option_key . ' : ' . $item_option_value . ';';
            }

            $data[] = array(
                'order_item_order_id' => $order_id,
                'order_item_product_sku' => $item['id'],
                'order_item_name' => $item['name'],
                'order_item_price' => $item['price'],
                'order_item_quantity' => $item['qty'],
                'order_item_options' => $item_options_string,
            );
        }
        
        if ($this->db->insert_batch('order_item', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}