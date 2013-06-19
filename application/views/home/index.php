<?php
    $message = $this->session->flashdata('message');
    if ($message) {
        ?>
        <div class="alert alert-<?php echo $message['type'] ?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $message['message'] ?>
        </div>
    <?php } ?>
<div class="row-fluid">
    
    <?php
    $count = 0;
    foreach ($products as $product) {
        ?>
        <div class="span4 product_cell" id="product_cell_<?php echo $product['product_id'] ?>">
            <h3><?php echo $product['product_name'] ?></h3>
            <div class="catalog_image">
                <img class="img-polaroid" src="<?php echo catalog_image($product['image']) ?>" alt="Image Missing" />
            </div>
            <?php 
            if( $product['product_type'] == CONFIGURABLE_PRODUCT ){
                //$associated_products = $this->product_model->getAssociatedProducts($product['product_id']);
            ?>
            <div>
                <select class="configurable_product_select">
                    <?php foreach ( $product['associated_products'] as $associated_product ){
                    echo "<option value='{$associated_product['associated_product_simple_product_id']}' 
                        data-price = '{$associated_product['product_price']}'>{$associated_product['product_name']} 
                            Tk.{$associated_product['product_price']}</option>";
                    } ?>
                </select>
            </div>
            <?php 
            $product = $product['associated_products'][0]; //First product is selected default
            } 
            ?>
            <div>
                <div class="btn disabled span4">
                    <strong>Price: <span class="product_price"><?php echo $product['product_price'] ?></span></strong>
                </div>
                <div class="span4"><?php echo getQtyHtml($product) ?></div>
                <button class="btn span4" type="button">Detail</button>
            </div>
            <?php echo getAddToCartHtml($product) ?>
        </div>
        <?php
        if (++$count % 3 == 0) {
            echo '</div>';
            if ($count < count($products))
                echo '<div class="row-fluid">';
        }
    }
    echo '</div>';
    ?>

    