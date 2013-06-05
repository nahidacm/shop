<?php

class Order_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    function getOrders(){
        
        $query = $this->db->order_by("order_time", "desc")->get('order');
        $orders = $query->result_array();
        
        return $orders;
    }
    
    function getOrder($order_id){
        $this->db->select('order.*, customer.*, 
            SUM(order_item.order_item_price * order_item.order_item_quantity) AS total_price,
            SUM(order_item.order_item_quantity) AS total_items');
        $this->db->from('order');
        $this->db->join('customer', 'customer.customer_id = order.order_customer_id','left');
        $this->db->join('order_item', 'order_item.order_item_order_id = order.order_id','left');
        $this->db->where( 'order.order_id', $order_id );
        $this->db->group_by("order.order_id");
        
        $query = $this->db->get();
  
        $order = $query->row_array();
        
        return $order;
    }
    
    function getOrderItems($order_id){
        $query = $this->db->get_where('order_item', array( 'order_item_order_id'=>$order_id ));
        
        return $query->result_array() ;
    }
            
    function update_order_status($order_id,$order_status){
        $this->db->where('order_id', $order_id);
        $this->db->update('order', array('order_status'=>$order_status)); 
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
            'order_time' => date('Y-m-d H:i:s'),
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