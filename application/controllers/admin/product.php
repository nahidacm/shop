<?php

//application\controllers\admin\product.php

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['content'] = 'Here is all the contents';

        $this->_loadView(__FUNCTION__, $data);
    }
    public function delete($product_id){
        
        if($this->product_model->deleteProduct($product_id)){
            $this->session->set_flashdata('message', array(
                    'type' => 'success',
                    'message' => 'Product Deleted Successfuly'
                ));
        }  else {
            $this->session->set_flashdata('message', array(
                    'type' => 'error',
                    'message' => 'Could not delete the product'
                ));
        }
        
        redirect('/admin/product/view');
    }

    public function edit($product_id){
     
        $message = array();
        
        if ($this->input->post()) {
            
            $data['post'] = $this->input->post();
            
            $this->form_validation->set_rules('product_name', 'Name', 'required');
            $this->form_validation->set_rules('product_sku', 'SKU', 'required');

            if ($this->form_validation->run() === FALSE) {
                $message[] = array(
                    'type' => 'error',
                    'message' => 'Could not create product, validation failed'
                );
            } else {
                if ($this->product_model->isUniqueSku($product_id)) {
                    
                    $upload_message = $this->_upload();
                    
                    if (isset($upload_message['file_name']) || count($_FILES) == 0) {
                        $this->product_model->updateProduct($product_id);
                        
                        if(isset($upload_message['file_name'])){
                            $this->product_model->updateProductImageInfo($product_id, $upload_message);
                        }
                        
                        $message[] = array(
                            'type' => 'success',
                            'message' => 'Product updated successfully'
                        );
                    } else {
                        foreach ($upload_message as $upload_msg) {
                            $message[] = array(
                                'type' => 'error',
                                'message' => $upload_msg
                            );
                        }
                    }
                } else {
                    $message[] = array(
                        'type' => 'error',
                        'message' => 'This SKU value already given to a product, it must me unique'
                    );
                }
            }
        }  else {
            $product_detail = $this->product_model->getProductDetail($product_id);
            $data['post'] = $product_detail;
        }

        $data['messages'] = $message;
        $data['title'] = 'Update product';
        $data['selected_menu'] = '';
        $this->_loadView(__FUNCTION__, $data);
    }

    public function view(){
     
        $message = array();
        if($this->session->flashdata('message'))
            $message[] = $this->session->flashdata('message');
        
        $products = $this->product_model->getProducts();
        
        $data['messages'] = $message;
        $data['products'] = $products;
        $data['selected_menu'] = 'admin/product/view';
        $this->_loadView(__FUNCTION__, $data);
    }

    public function create() {
        
        $message = array();

        if ($this->input->post()) {

            $this->form_validation->set_rules('product_name', 'Name', 'required');
            $this->form_validation->set_rules('product_sku', 'SKU', 'required');

            if ($this->form_validation->run() === FALSE) {
                $message[] = array(
                    'type' => 'error',
                    'message' => 'Could not create product, validation failed'
                );
            } else {
                if ($this->product_model->isUniqueSku()) {
                    
                    $upload_message = $this->_upload();
                    
                    if (isset($upload_message['file_name']) || count($_FILES) == 0) {
                        
                        $product_id = $this->product_model->saveProduct();
                        
                        if(isset($upload_message['file_name']) && $product_id){
                            $this->product_model->setProductImageInfo($product_id, $upload_message);
                        }
                        
                        $message[] = array(
                            'type' => 'success',
                            'message' => 'Product created successfully'
                        );
                    } else {
                        foreach ($upload_message as $upload_msg) {
                            $message[] = array(
                                'type' => 'error',
                                'message' => $upload_msg
                            );
                        }
                    }
                } else {
                    $message[] = array(
                        'type' => 'error',
                        'message' => 'This SKU value already given to a product, it must me unique'
                    );
                }
            }
        }

        if (shop_hasErrorMessage($message)) {
            $data['post'] = $this->input->post();
        }
        echo '<pre>';
            print_r($this->category_model->getCategories());
        echo '</pre>';
        $data['categories'] = $this->category_model->getCategories();
        $data['messages'] = $message;
        $data['title'] = 'Create new product';
        $data['selected_menu'] = 'admin/product/create';
        $this->_loadView(__FUNCTION__, $data);
    }

    private function _upload() {
        
        $this->load->library('upload', shop_getUploadImgConfig());

        if (!$this->upload->do_upload('product_image')) {
            $error = array('error' => $this->upload->display_errors());

            return $error;
        } else {
            return $this->upload->data();
        }
    }

    private function _loadView($view, $data) {
        $view_folder = 'admin/product';
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/header', $data);
        $this->load->view($view_folder . '/' . $view, $data);
        $this->load->view('templates/admin/footer');
    }

}
