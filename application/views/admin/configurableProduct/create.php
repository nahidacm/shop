
<div class="row-fluid">
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Create New Product</div>
        </div>
        <div class="block-content">
            <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                <!-- configurable product -->
                <input type="hidden" name="product_type" value="2" />
                
                <div class="control-group">
                    <label class="control-label" for="product_name">Name</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="text" 
                               id="product_name" name="product_name" 
                               value="<?php echo (isset($post['product_name'])) ? $post['product_name'] : '' ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="product_description">Description</label>
                    <div class="controls">
                        <textarea class="input-xxlarge" id="product_description" name="product_description" rows="3"><?php echo (isset($post['product_description'])) ? $post['product_description'] : '' ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="product_price">Price</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="text" id="product_price" name="product_price"
                               value="<?php echo (isset($post['product_price'])) ? $post['product_price'] : '' ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="product_stock">Stock</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="text" id="product_stock" name="product_stock"
                               value="<?php echo (isset($post['product_stock'])) ? $post['product_stock'] : '' ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="product_sku">SKU</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="text" id="product_sku" name="product_sku"
                               value="<?php echo (isset($post['product_sku'])) ? $post['product_sku'] : '' ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"></label>
                    <div class="controls">
                        <fieldset>
                            <legend>Associated Products</legend>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check_all_configurable_product" /></th>
                                        <th>ID</th>
                                        <th>SKU</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                    </tr>
                                    <tr>
                                        <th><span class="btn btn-info btn-small">Filter</span></th>
                                        <th><input type="text" id="filter_product_id" class="input-mini" /></th>
                                        <th><input type="text" id="filter_product_sku" class="input-mini" /></th>
                                        <th><input type="text" id="filter_product_name" /></th>
                                        <th><input type="text" id="filter_product_price" class="input-mini" /></th>
                                        <th><input type="text" id="filter_product_stock" class="input-mini" /></th>
                                    </tr>
                                    <?php foreach ( $associated_products as $associated_product ){ ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="filtered_products" name="associated_products[]" 
                                                   value="<?php echo $associated_product['product_id'] ?>" />
                                        </td>
                                        <td><?php echo $associated_product['product_id'] ?></td>
                                        <td><?php echo $associated_product['product_sku'] ?></td>
                                        <td><?php echo $associated_product['product_name'] ?></td>
                                        <td><?php echo $associated_product['product_price'] ?></td>
                                        <td><?php echo $associated_product['product_stock'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </thead>
                            </table>
                            <input type="hidden" id="associated_product_list" value=""/>
                        </fieldset>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"></label>
                    <div class="controls">
                        <fieldset>
                            <legend>Categories</legend>
                            <?php echo $category_html; ?>
                        </fieldset>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="product_image">Image</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="file" id="product_image" name="product_image">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>
