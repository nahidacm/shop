<?php

class Category_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getCategories() {
        $query = $this->db->get('category');
        $result = $query->result_array();

        return $result;
    }

}