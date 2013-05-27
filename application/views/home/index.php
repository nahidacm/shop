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
        <div class="span4">
            <h3><?php echo $product['product_name'] ?></h3>
            <div class="catalog_image">
                <img class="img-polaroid" src="<?php echo catalog_image($product['image']) ?>" alt="Image Missing" />
            </div>
            <div>
                <div class="btn disabled span4">
                    <strong>Price: <?php echo $product['product_price'] ?></strong>
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

    