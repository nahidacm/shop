<?php

function shop_hasErrorMessage($messages) {
    $flag = FALSE;
    foreach ($messages as $message) {
        if ($message['type'] == 'error') {
            $flag = TRUE;
            break;
        }
    }
    return $flag;
}

function shop_getUploadImgConfig() {
    $config['upload_path'] = ROOT_PATH . '/uploads/product_images';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '5000';
    $config['max_width'] = '1024';
    $config['max_height'] = '768';

    return $config;
}

function timThumbPath($image_path){
    
    return base_url('/images/timthumb.php').'?src='.base_url($image_path);
}