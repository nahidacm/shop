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
    <h4>Thanks for shopping with us, We will call you after a while...</h4>
    <h6>Your order id is: <?php echo $order_id ?></h6>
    <a href="<?php echo base_url() ?>" class="btn">Continue Shopping</a>
</div>
