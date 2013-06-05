<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

    public function index() {
        $data['orders'] = $this->order_model->getOrders();
        $data['title'] = 'Orders';
        $data['selected_menu'] = 'admin/order';

        $this->_loadView(__FUNCTION__, $data);
    }
    
    function update(){
        
        if($this->input->get_post('update_order_status') == 'update_order_status'){
            
            $order_id = $this->input->get_post('order_id');
            $order_status = $this->input->get_post('order_status');
            $this->order_model->update_order_status($order_id, $order_status);
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }
            
    function view($order_id){
        $data['order'] = $this->order_model->getOrder($order_id);
        $data['order_items'] = $this->order_model->getOrderItems($order_id);
        $data['title'] = 'Orders';
        $data['selected_menu'] = 'admin/order';

        $this->_loadView(__FUNCTION__, $data);
    }

    private function _loadView($view, $data) {
        $view_folder = 'admin/order';
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/header', $data);
        $this->load->view($view_folder . '/' . $view, $data);
        $this->load->view('templates/admin/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */