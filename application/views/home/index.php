<div class="row-fluid">
    <?php 
    $count = 0; 
    foreach ($products as $product) { 
    ?>
    <div class="span4">
        <h2><?php echo $product['product_name'] ?></h2>
        <p><?php echo $product['product_description'] ?></p>
        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
    <?php
    if(++$count == 3){
        echo '</div>';
        if($count < count($products))
            echo '<div class="row-fluid">';
    }
    }
    echo '</div>';
    ?>