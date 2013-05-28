<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {
//
//    public function index() {
//
//        $products = $this->product_model->getProducts();
//
//        $data['products'] = $products;
//        $this->_loadView(__FUNCTION__, $data);
//    }

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
//
//    private function _loadView($view, $data) {
//        $view_folder = 'cart';
//        $this->load->view('templates/head', $data);
//        $this->load->view('templates/header', $data);
//        $this->load->view($view_folder . '/' . $view, $data);
//        $this->load->view('templates/footer');
//    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/cart.php */