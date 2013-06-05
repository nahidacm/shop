
<div class="row-fluid">

    <div class="span6">
        <div class="block">
            <div class="block-header navbar navbar-inner"><div>Customer information</div></div>
            <div class="block-content">
                <table class="table">
                    <tr>
                        <td><strong>Customer Name : </strong></td>
                        <td><?php echo $order['order_customer_name'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Customer Contact : </strong></td>
                        <td><?php echo $order['order_customer_mobile'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Customer Address : </strong></td>
                        <td><?php echo $order['order_shipping_address'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="block">
            <div class="block-header navbar navbar-inner"><div>Order Information</div></div>
            <div class="block-content">
                <table class="table">
                    <tr>
                        <td><strong>Order ID : </strong></td>
                        <td><?php echo $order['order_id'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Price : </strong></td>
                        <td><?php echo $order['total_price'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total items : </strong></td>
                        <td>Tk.<?php echo $order['total_items'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Order time : </strong></td>
                        <td><?php echo $order['order_time'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Order Status : </strong></td>
                        <td><?php echo $order['order_status'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="span12">
        <div class="block">
            <div class="block-header navbar navbar-inner"><div>Order Items</div></div>
            <div class="block-content">
                <table class="table">
                    <tr>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?php foreach ($order_items as $order_item) { ?>
                    <tr>
                        <td><?php echo $order_item['order_item_product_sku'] ?></td>
                        <td><?php echo $order_item['order_item_name'] ?></td>
                        <td><?php echo $order_item['order_item_price'].' x '.$order_item['order_item_quantity'] ?></td>
                        <td><?php echo ' = TK.'.$order_item['order_item_price'] * $order_item['order_item_quantity'] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Total Price = </td>
                        <td><?php echo 'TK.'.$order['total_price'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="span12">
        <form action="<?php echo site_url('admin/order/update') ?>" method="post">
            <input type="hidden" name="order_id" value="<?php echo $order['order_id'] ?>" />
            <input type="hidden" name="update_order_status" value="update_order_status" />
            <select name="order_status">
                <option>new</option>
                <option>complete</option>
                <option>cancel</option>
                <option>processing</option>
            </select>
            <input type="submit" name="submit" value="Update Order Status" class="btn btn-warning" />
        </form>
    </div>
</div>
