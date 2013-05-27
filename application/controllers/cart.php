<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function index() {
        
        $products = $this->product_model->getProducts();
        
        $data['products'] = $products;
        $this->_loadView(__FUNCTION__, $data);
    }

    private function _loadView($view,$data) {
        $view_folder = 'home';
        $this->load->view('templates/head', $data);
        $this->load->view('templates/header', $data);
        $this->load->view($view_folder.'/'.$view, $data);
        $this->load->view('templates/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/cart.php */