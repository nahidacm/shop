
<div class="row-fluid">
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">View Products</div>
        </div>
        <div class="block-content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo $product['product_id'] ?></td>
                        <td><?php echo $product['product_name'] ?></td>
                        <td><?php echo $product['product_sku'] ?></td>
                        <td>
                            <a href="<?php echo site_url('/admin/product/edit').'/'.$product['product_id'] ?>">Edit</a>&nbsp; |
                            <a href="#">View</a>&nbsp; |
                            <a href="<?php echo site_url('/admin/product/delete').'/'.$product['product_id'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</div>
