<?php

class Customer_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    function doLogin($mobile_num, $password) {

        //$this->db->select('id,level,email,username');
        $this->db->where("customer_mobile = '$mobile_num' AND customer_password = '$password'");
        $query = $this->db->get('customer');
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }  else {
            return FALSE;
        }
    }
    function getLogedInCustomer(){
        $customer_id = $this->session->userdata('customer_id');
        $this->db->where("customer_id = '$customer_id'");
        $query = $this->db->get('customer');
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }  else {
            return FALSE;
        }
    }

    public function saveCustomer() {

        $data = array(
            'customer_name' => $this->input->post('reg_name'),
            'customer_mobile' => $this->input->post('reg_mobile_number'),
            'customer_aadress_line_1' => $this->input->post('reg_address_line1'),
            'customer_aadress_line_2' => $this->input->post('reg_address_line2'),
            'customer_location' => $this->input->post('reg_location'),
            'customer_password' => md5($this->input->post('reg_password')),
        );
        if ($this->input->post('reg_email') != '')
            $data['customer_email'] = $this->input->post('reg_email');

        if ($this->db->insert('customer', $data)) {
            $created_customer_id = $this->db->insert_id();
            return $created_customer_id;
        } else {
            return FALSE;
        }
    }

}