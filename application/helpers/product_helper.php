<?php

/**
 * Contains product related methods
 *
 * @author Nahid
 */
class ProductHelper {
    
    private $CI;
    
    function __construct() {
        $this->CI = &get_instance();
    }
    /**
     * Set the parameter for dataGrid and creates grid with the help of Datagrid
     * helper class.
     * 
     * @return string generated table datagrid html
     */
    function getProductViewGrid(){
        
        $products = $this->CI->product_model->getProducts(array('product_stock >' => 1)); //Ignoring stock zero
        
        $this->CI->load->helper('datagrid');
        $datagrid = new Datagrid($products);
        $datagrid->setHeader( array(
                    'product_id'=>'#',
                    'product_name'=>'Product Name',
                    'product_sku'=>'SKU',
                )
            );
        $datagrid->setPrimaryKeyIndex('product_id');
        $datagrid->setTableProperty('class="table table-striped"');
        $actions = array( 
            'edit'=>array( 
                'title' => 'Edit', 
                'url' => 'admin/product/edit', 
                'class' => 'edit_action' 
                ), 
            'view'=>array( 
                'title' => 'View', 
                'url' => '#', 
                'class' => 'view_action' 
                ),
            'delete'=>array( 
                'title' => 'Delete', 
                'url' => 'admin/product/delete', 
                'class' => 'delete_action' 
                ),
            );
        $datagrid->setActions( $actions );
        $product_table = $datagrid->getGridHtml();
        
        return $product_table;
    }
}

?>
