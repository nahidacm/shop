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
    );
    
    return $menu;
}
