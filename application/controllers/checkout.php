<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Checkout extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        if(!$this->session->userdata('logged_in'))
            redirect ('customer');
        
    }

    public function index() {

        $products = $this->product_model->getProducts();

        $data['products'] = $products;
        $this->_loadView(__FUNCTION__, $data);
    }

    
    private function _loadView($view, $data) {
        $view_folder = strtolower(get_class($this));
        $this->load->view('templates/head', $data);
        $this->load->view('templates/header', $data);
        $this->load->view($view_folder . '/' . $view, $data);
        $this->load->view('templates/footer');
    }

}