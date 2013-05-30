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
    <div class="span6">
        <fieldset>
            <legend>Login</legend>
            <form action="<?php echo site_url('customer/login') ?>" method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label" for="login_mobile_number">Mobile Number</label>
                    <div class="controls">
                        <input type="text" id="login_mobile_number" name="login_mobile_number" placeholder="01xxxxxxxxx" class="input-xlarge" autocomplete="off">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="login_password">Password</label>
                    <div class="controls">
                        <input type="password"  id="login_password" name="login_password" placeholder="Password"  class="input-xlarge" autocomplete="off">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-warning">
                            <i class="icon-user"></i> Sign in
                        </button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
    <div class="span6">
        <fieldset>
            <legend>OR Register</legend>
            <form class="form-horizontal" action="<?php echo site_url('customer/register') ?>" method="post">
                <div class="control-group">
                    <label class="control-label" for="reg_mobile_number">Mobile Number</label>
                    <div class="controls">
                        <input type="text" id="reg_mobile_number" name="reg_mobile_number" placeholder="01xxxxxxxxx" class="input-xlarge">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="reg_name">Name</label>
                    <div class="controls">
                        <input type="text" id="reg_name" name="reg_name" placeholder="Name" class="input-xlarge">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="reg_address_line1">Address</label>
                    <div class="controls">
                        <input type="text" id="reg_address_line1" name="reg_address_line1" placeholder="Flat no.,House no." class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="text" id="reg_address_line2" name="reg_address_line2" placeholder="Road name etc..." class="input-xlarge" autocomplete="off">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <select name="reg_location" class="input-xlarge">
                            <option>Shantinagar</option>
                            <option>Malibaag</option>
                            <option>Baily Road</option>
                            <option>Siddheswari</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="reg_password">Password</label>
                    <div class="controls">
                        <input type="password" id="reg_password" name="reg_password" placeholder="Password" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="reg_email">Email(Optional)</label>
                    <div class="controls">
                        <input type="text" id="reg_email" name="reg_email" placeholder="Email" class="input-xlarge">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-success"><i class="icon-user icon-white"></i> Register</button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</div>
