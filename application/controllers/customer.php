<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller {

    function create() {
        if ($this->input->post()) {

            $this->form_validation->set_rules('product_name', 'Name', 'required');
            $this->form_validation->set_rules('product_sku', 'SKU', 'required');

            if ($this->form_validation->run() === FALSE) {
                $message[] = array(
                    'type' => 'error',
                    'message' => 'Could not create product, validation failed'
                );
            } else {
                
            }
        }
    }

    private function _loadView($view, $data) {
        $view_folder = strtolower(get_class($this));
        $this->load->view('templates/head', $data);
        $this->load->view('templates/header', $data);
        $this->load->view($view_folder . '/' . $view, $data);
        $this->load->view('templates/footer');
    }

}