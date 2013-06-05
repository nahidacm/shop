<?php
function shop_admin_getLeftMenu(){
    $menu = array(
        array(
            'title'=>'Dashboard',
            'url'=>'admin'
        ),
        array(
            'title'=>'Create Product',
            'url'=>'admin/product/create'
        ),
        array(
            'title'=>'View Products',
            'url'=>'admin/product/view'
        ),
        array(
            'title'=>'Orders',
            'url'=>'admin/order'
        ),
    );
    
    return $menu;
}

function shop_admin_drawCategoryHtml($category_array){
    
    $html = '';
    
    foreach ($category_array as $category){
        $html = '<label class="checkbox">
                    <input type="checkbox" value="'.$category['category_id'].'">
                    '.$category['category_name'].'
                </label>';
    }    
}
