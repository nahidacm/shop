<?php

class Product_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function deleteProduct($product_id) {

        $this->deleteProductImage($product_id);
        if ($this->db->delete('product', array('product_id' => $product_id)))
            return TRUE;
        else
            return FALSE;
    }

    public function getProductDetail($product_id) {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images', 'product_images.product_image_product_id = product.product_id', 'left');
        $this->db->where('product.product_id', $product_id);
        $query = $this->db->get();

        $product_detail = $query->row_array();

        $this->getProductCategories($product_id);
        return $product_detail;
    }

    public function getProductCategories($product_id) {
        $this->db->select('category.*');
        $this->db->from('category');
        $this->db->join('product_category_map', 'product_category_map.product_category_map_category_id = category.id', 'right');
        $this->db->where('product_category_map.product_category_map_product_id', $product_id);
        $query = $this->db->get();

        $product_categories = $query->result_array();

        return $product_categories;
    }

    public function getProductCategoryIds($product_id) {
        $categories = $this->getProductCategories($product_id);

        $category_ids = array();
        foreach ($categories as $category) {
            $category_ids[] = $category['id'];
        }

        return $category_ids;
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

        $update_product = $this->db->update('product', $data, "product_id = $product_id");


        if ($update_product) {

            //update product categories
            $category_ids = $this->input->post('caregory_ids');
            
            //first delete
            $this->db->delete('product_category_map', array('product_category_map_product_id' => $product_id));
            
            //then add
            if ($category_ids) {
                $cat_data = array();
                foreach ($category_ids as $category_id) {
                    $cat_data [] = array(
                        'product_category_map_product_id' => $product_id,
                        'product_category_map_category_id' => $category_id);
                }
                $this->db->insert_batch('product_category_map', $cat_data);
            }
            return $update_product;
        }

        return $update_product;
    }

    public function setProductImageInfo($product_id, $upload_data) {
        $data = array(
            'product_image_product_id' => $product_id,
            'product_image_path' => 'uploads/product_images/' . $upload_data['file_name'],
        );
        if ($this->db->insert('product_images', $data)) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function deleteProductImage($product_id) {
        $previous_image_path = ROOT_PATH . '/' . $this->getProductImage($product_id);
        if (file_exists($previous_image_path))
            unlink($previous_image_path);
    }

    public function updateProductImageInfo($product_id, $upload_data) {

        $this->deleteProductImage($product_id);

        $data = array(
            'product_image_path' => 'uploads/product_images/' . $upload_data['file_name'],
        );
        if ($this->db->update('product_images', $data, "product_image_product_id = $product_id"))
            return $this->db->insert_id();
        else
            return FALSE;
    }

    public function getProductImage($product_id) {
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


        if ($this->db->insert('product', $data)) {
            $created_product_id = $this->db->insert_id();

            //save product categories
            $category_ids = $this->input->post('caregory_ids');

            if ($category_ids) {
                $cat_data = array();
                foreach ($category_ids as $category_id) {
                    $cat_data [] = array(
                        'product_category_map_product_id' => $created_product_id,
                        'product_category_map_category_id' => $category_id);
                }
                $this->db->insert_batch('product_category_map', $cat_data);
            }
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