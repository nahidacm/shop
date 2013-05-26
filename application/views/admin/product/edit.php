
<div class="row-fluid">
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Edit Product</div>
        </div>
        <div class="block-content">
            <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                <div class="control-group">
                    <label class="control-label" for="product_name">Name</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="text" 
                               id="product_name" name="product_name" 
                               value="<?php echo (isset($post['product_name']))?$post['product_name']:'' ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="product_description">Description</label>
                    <div class="controls">
                        <textarea class="input-xxlarge" id="product_description" name="product_description" rows="3"><?php echo (isset($post['product_description']))?$post['product_description']:'' ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="product_price">Price</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="text" id="product_price" name="product_price"
                               value="<?php echo (isset($post['product_price']))?$post['product_price']:'' ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="product_stock">Stock</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="text" id="product_stock" name="product_stock"
                               value="<?php echo (isset($post['product_stock']))?$post['product_stock']:'' ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="product_sku">SKU</label>
                    <div class="controls">
                        <input class="input-xxlarge" type="text" id="product_sku" name="product_sku"
                               value="<?php echo (isset($post['product_sku']))?$post['product_sku']:'' ?>">
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
                    <label class="control-label" for="product_image"></label>
                    <div class="controls">
                        <img class="img-polaroid" src="<?php echo timThumbPath($post['product_image_path']) ?>" alt="Image Missing" /> 
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
