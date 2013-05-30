<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller {

    function index() {

        $data = array();

        $this->_loadView(__FUNCTION__, $data);
    }

    function login() {
        if ($this->input->post()) {

            $mobile_num = $this->input->post('login_mobile_number');
            $password = $this->input->post('login_password');

            $login = $this->customer_model->doLogin($mobile_num, md5($password));
            if ($login) {

                $user_data = array(
                    'customer_id' => $login['customer_id'],
                    'customer_name' => $login['customer_name'],
                    'customer_mobile' => $login['customer_mobile'],
                    'logged_in' => TRUE
                );
                
                $this->session->set_userdata($user_data);
                
                $this->session->set_flashdata('message', array(
                    'type' => 'success',
                    'message' => 'Login Success '.$this->session->userdata('customer_name')
                        )
                );

                redirect('/checkout');
            } else {
                $this->session->set_flashdata('message', array(
                    'type' => 'error',
                    'message' => 'Login Failed'
                        )
                );
                redirect('/customer');
            }
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        
        redirect_back();
    }
    
    function register() {
        if ($this->input->post()) {

            $this->form_validation->set_rules('reg_mobile_number', 'Phone number', 'required');
            $this->form_validation->set_rules('reg_name', 'Name', 'required');

            $this->customer_model->saveCustomer();

            if ($this->form_validation->run() === FALSE) {
                $message[] = array(
                    'type' => 'error',
                    'message' => 'Could not create user, validation failed'
                );
            } else {
                
            }
        }

        redirect('/checkout');
        //redirect( $_SERVER['HTTP_REFERER'] );
    }

    private function _loadView($view, $data = array()) {
        $view_folder = 'customer';
        $this->load->view('templates/head', $data);
        $this->load->view('templates/header', $data);
        $this->load->view($view_folder . '/' . $view, $data);
        $this->load->view('templates/footer');
    }

}