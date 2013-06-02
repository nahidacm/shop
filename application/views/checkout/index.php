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
    <div class="span12">
        <div class="row-fluid">
            <h4 class="pull-left">Cart Summery</h4>
            <a href="<?php echo site_url('checkout/proceed') ?>" class="btn btn-large btn-danger pull-right">Proceed Checkout</a>
        </div>
        <h6></h6>
        <?php echo form_open('cart/update'); ?>
        <table class="table">
            <tr>
                <th>QTY</th>
                <th>Item Description</th>
                <th style="text-align:right">Item Price</th>
                <th style="text-align:right">Sub-Total</th>
            </tr>

            <?php $i = 1; ?>

            <?php foreach ($this->cart->contents() as $items): ?>

                <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>

                <tr>
                    <td><?php echo form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                    <td>
                        <?php echo $items['name']; ?>

                        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                            <p>
                                <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                    <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                <?php endforeach; ?>
                            </p>

                        <?php endif; ?>

                    </td>
                    <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                    <td style="text-align:right">Tk.<?php echo $this->cart->format_number($items['subtotal']); ?></td>
                </tr>

                <?php $i++; ?>

            <?php endforeach; ?>

            <tr>
                <td colspan="2"> </td>
                <td class="right"><strong>Total</strong></td>
                <td class="right">Tk.<?php echo $this->cart->format_number($this->cart->total()); ?></td>
            </tr>

        </table>

        <p><?php echo form_submit(array('name'=>'update_cart','class'=>'btn btn-info'), 'Update your Cart'); ?></p>
    </div>
</div>
