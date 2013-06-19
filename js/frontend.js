$(document).ready(function(){
    
    $(config.addToCartBtn).click(function(){
        var ref_url = window.location.pathname;
        var product_id = $(this).data('product_id');
        var quantity = $('#'+config.qtyIdPrefix+product_id).val();
        quantity = (quantity == '')? 1 : quantity;
        
       window.location.href = config.base_url+'index.php/cart/add/'+product_id+'/'+quantity; 
    });
    
    $(config.checkoutBtn).click(function(){
        
       window.location.href = config.base_url+'index.php/checkout'; 
    });
    
    //change product values with configurable product drop-down change
    $('.configurable_product_select').change(function(){
        var product_id = $(this).val();
        var product_price = $('.configurable_product_select option:selected').data('price');
        
        $(this).closest('div.product_cell').find('span.product_price').text( product_price );
        $(this).closest('div.product_cell').find('button.addTocartBtn').data( 'product_id',product_id );
        //$(this).closest('button.addTocartBtn').data( 'product_id',product_id );
    });
    
});