<?php

class Product_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function deleteProduct($product_id){
        
        $this->deleteProductImage($product_id);
        if($this->db->delete('product', array('product_id' => $product_id)))
            return TRUE;
        else
            return FALSE;
    }

    public function getProductDetail($product_id) {
        $query = $this->db->get_where('product', array('product_id' => $product_id));
        $product_detail = $query->row_array();

        return $product_detail;
    }

    public function getProducts() {
        $query = $this->db->get('product');
        $result = $query->result_array();

        return $result;
    }

    public function updateProduct($product_id) {

        $data = array(
            'product_name' => $this->input->post('product_name'),
            'product_description' => $this->input->post('product_description'),
            'product_price' => $this->input->post('product_price'),
            'product_stock' => $this->input->post('product_stock'),
            'product_sku' => $this->input->post('product_sku'),
        );

        return $this->db->update('product', $data, "product_id = $product_id");
    }

    public function setProductImageInfo($product_id, $upload_data) {
        $data = array(
            'product_image_product_id' => $product_id,
            'product_image_path' => 'uploads/product_images/'.$upload_data['file_name'],
        );
        if ($this->db->insert('product_images', $data)) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    public function deleteProductImage($product_id){
        $previous_image_path = ROOT_PATH . '/'.$this->getProductImage($product_id);
        if(file_exists ( $previous_image_path ));
            unlink ( $previous_image_path );
    }

    public function updateProductImageInfo($product_id, $upload_data) {
        
        $this->deleteProductImage($product_id);
        
        $data = array(
            'product_image_path' => 'uploads/product_images/'.$upload_data['file_name'],
        );
        if ($this->db->update('product_images', $data, "product_image_product_id = $product_id"))    
            return $this->db->insert_id();
        else 
            return FALSE;
        
    }
    
    public function getProductImage($product_id){
        $this->db->select('product_image_path');
        $query = $this->db->get_where('product_images', array('product_image_product_id' => $product_id));
        $row = $query->row_array();
        $product_image_path = $row['product_image_path'];

        return $product_image_path;
    }

    public function saveProduct() {

        $data = array(
            'product_name' => $this->input->post('product_name'),
            'product_description' => $this->input->post('product_description'),
            'product_price' => $this->input->post('product_price'),
            'product_stock' => $this->input->post('product_stock'),
            'product_sku' => $this->input->post('product_sku'),
        );

//        var_dump($this->upload->data());
        if ($this->db->insert('product', $data)) {
            $created_product_id = $this->db->insert_id();
            return $created_product_id;
        } else {
            return FALSE;
        }
    }

    public function getProductSku($product_id) {
        $this->db->select('product_sku');
        $query = $this->db->get_where('product', array('product_id' => $product_id));
        $row = $query->row_array();
        $sku = $row['product_sku'];

        return $sku;
    }

    /**
     * For new product checks if the SKU is unique. and for updating product,
     * must need the $product_id , which checks if this is old SKU or unique
     * @param int $product_id checking for which product
     * @return boolean
     */
    public function isUniqueSku($product_id = NULL) {
        $sku = $this->input->post('product_sku');
        if ($product_id != NULL) {
            $product_sku = $this->getProductSku($product_id);
        }
        $query = $this->db->get_where('product', array('product_sku' => $sku));

        if ($query->num_rows() > 0 && $sku != $product_sku) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}