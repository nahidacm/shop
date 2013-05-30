<?php

function getQtyHtml($product) {
    $html = '<div class="input-prepend">
                <span class="add-on">Qty</span>
                <input class="span4 qtyField" id="qty_' . $product['product_id'] . '" type="text" placeholder="0">
            </div>';

    return $html;
}

function getAddToCartHtml($product) {
    $html = '<button class="btn btn-large btn-block btn-primary addTocartBtn" type="button" data-product_id ="' . $product['product_id'] . '">
                <i class="icon-shopping-cart icon-white"></i>Add to cart
            </button>';

    return $html;
}
function getCheckOutButton(){
    $html = '<button class="checkoutBtn span4 btn btn-success">Check out</button>';
    
    return $html;
}
function get_system_scripts() {
    $html = '<script src="' . base_url('/js') . '/config.js"></script>
            <script src="' . base_url('/js') . '/frontend.js"></script>';

    return $html;
}
