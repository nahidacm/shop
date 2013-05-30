<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function add($product_id, $quantity) {
       
        $product_detail = $this->product_model->getProductDetail($product_id);

        $data = array(
            'id' => $product_detail['product_sku'],
            'qty' => $quantity,
            'price' => $product_detail['product_price'],
            'name' => $product_detail['product_name'],
            'options' => array()
        );

        $this->cart->insert($data);
        
        $this->session->set_flashdata('message', 
                array(
                    'type'=>'success',
                    'message'=>$product_detail['product_name'].' Added to cart'
                )
            );

        redirect( $_SERVER['HTTP_REFERER'] );
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/cart.php */