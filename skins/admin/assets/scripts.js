$(function() {
    // Side Bar Toggle
    $('.hide-sidebar').click(function() {
        $('#sidebar').hide('fast', function() {
            $('#content').removeClass('span9');
            $('#content').addClass('span12');
            $('.hide-sidebar').hide();
            $('.show-sidebar').show();
        });
    });

    $('.show-sidebar').click(function() {
        $('#content').removeClass('span12');
        $('#content').addClass('span9');
        $('.show-sidebar').hide();
        $('.hide-sidebar').show();
        $('#sidebar').show('fast');
    });

    /*
     * Associated products for configurable product
     */
    $("#check_all_configurable_product").change(function() {
        if($(this).is(':checked'))
            $(".filtered_products").prop('checked', true);
        else
            $(".filtered_products").prop('checked', false);
    });
    
});