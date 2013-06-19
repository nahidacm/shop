<?php

//application\controllers\admin\product.php

class ConfigurableProduct extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
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
        
        $data['category_html'] = $this->category->html_output();
        $data['associated_products'] = $this->product_model->getProducts(array('product_type'=>1));
        $data['messages'] = $message;
        $data['title'] = 'Create Configurable product';
        $data['selected_menu'] = 'admin/configurableProduct/create';
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
        $view_folder = 'admin/configurableProduct';
        $this->load->view('templates/admin/head', $data);
        $this->load->view('templates/admin/header', $data);
        $this->load->view($view_folder . '/' . $view, $data);
        $this->load->view('templates/admin/footer');
    }

}
