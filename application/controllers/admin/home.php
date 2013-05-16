<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $data['content'] = 'Here is all the contents';
        
        $this->_loadView(__FUNCTION__, $data);
    }

    private function _loadView($view,$data) {
        $view_folder = 'admin/home';
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/header', $data);
        $this->load->view($view_folder.'/'.$view, $data);
        $this->load->view('templates/admin/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */