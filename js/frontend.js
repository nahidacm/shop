$(document).ready(function(){
    
    $(config.addToCartBtn).click(function(){
        var ref_url = window.location.pathname;
        var product_id = $(this).data('product_id');
        var quantity = $('#'+config.qtyIdPrefix+product_id).val();
        quantity = (quantity == '')? 1 : quantity;
        
       window.location.href = config.base_url+'index.php/cart/add/'+product_id+'/'+quantity; 
    });
    
});