
<div class="row-fluid">
    <!-- block -->
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Orders</div>
        </div>
        <div class="block-content collapse in">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td><?php echo $order['order_id'] ?></td>
                            <td><?php echo $order['order_customer_name'] ?></td>
                            <td><?php echo $order['order_customer_mobile'] ?></td>
                            <td><?php echo $order['order_status'] ?></td>
                            <td>
                                <a href="<?php echo site_url( 'admin/order/view/'.$order['order_id'] ) ?>">View</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /block -->
</div>
