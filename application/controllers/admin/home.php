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
        $admin_info = array(
            'admin_user_name'=>'admin',
            'admin_password'=>'we123admin');
        
        if( $this->session->userdata( 'admin_user_name' ) ){
            redirect('admin');
        }
        $messages = array();
        if( $this->input->post() ){
            if($this->input->post('admin_user_name') == $admin_info['admin_user_name']
                    && $this->input->post('admin_password') == $admin_info['admin_password']){

                $this->session->set_userdata(array('admin_user_name'=>'admin'));
                $data['admin_user_name'] = 'admin';

                redirect($_SERVER['HTTP_REFERER']);
            }else{
                $messages[] = array(
                        'type'=>'error',
                        'message'=>'Invalid credentials'
                    );
            }
        }
        
        $data['body_id'] = 'login';
        $data['messages'] = $messages;
        
        $view_folder = 'admin/home';
        $this->load->view('templates/admin/head', $data);
        $this->load->view($view_folder . '/' . __FUNCTION__, $data);
        $this->load->view('templates/admin/footer');
    }
    
    function logout(){
        $this->session->unset_userdata('admin_user_name');
        redirect('admin/home/login');
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