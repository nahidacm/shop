<?php

class Product_model extends CI_Model{
    
    public function __construct() {
        $this->load->database();
    }
    public function save_product() {
        
        $data = array(
            'product_name' => $this->input->post('product_name'),
            'product_description' => $this->input->post('product_description'),
            'product_price' => $this->input->post('product_price'),
            'product_stock' => $this->input->post('product_stock'),
            'product_sku' => $this->input->post('product_sku'),
        );

        return $this->db->insert('product', $data);
    }
    
    public function isUniqueSku(){
        $sku = $this->input->post('product_sku');
        $query = $this->db->get_where('product', array('product_sku' => $sku));
        
        if($query->num_rows()>0){
            return FALSE;
        }  else {
            return TRUE;
        }
    }
}