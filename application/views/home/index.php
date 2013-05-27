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
        <p>
            <span>Price: <?php echo $product['product_price'] ?></span>
            <button class="btn" type="button">Detail</button>
        </p>
        <?php echo getAddCartHtml($product) ?>
        
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