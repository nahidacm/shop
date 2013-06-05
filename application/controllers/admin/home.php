<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $data['orders'] = $this->order_model->getOrders();
        $data['title'] = 'Dashboard';
        $data['selected_menu'] = 'admin';

        $this->_loadView(__FUNCTION__, $data);
    }

    public function login() {
        $data['body_id'] = 'login';

        $view_folder = 'admin/home';
        $this->load->view('templates/admin/head', $data);
        //$this->load->view('templates/admin/header', $data);
        $this->load->view($view_folder . '/' . __FUNCTION__, $data);

        $this->load->view('templates/admin/footer');

        //$this->_loadView(__FUNCTION__, $data);
    }

    private function _loadView($view, $data) {
        $view_folder = 'admin/home';
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/header', $data);
        $this->load->view($view_folder . '/' . $view, $data);
        $this->load->view('templates/admin/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */