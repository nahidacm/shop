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
        <fieldset>
            <legend>Cart Summery</legend>
            
        </fieldset>
    </div>
</div>
    