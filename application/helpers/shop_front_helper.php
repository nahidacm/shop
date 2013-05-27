<?php
function getAddCartHtml($product){
    $html = '<p>
            <div class="input-prepend">
                <span class="add-on">Qty</span>
                <input class="span3" id="qty_'.$product['product_id'].'" type="text" placeholder="0">
            </div>
            <button class="btn btn-primary" type="button" data-product_id ="'.$product['product_id'].'">
                <i class="icon-shopping-cart icon-white"></i>Add to cart
            </button>
        </p>';
    
    return $html;
}