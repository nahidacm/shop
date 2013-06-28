<body id="login">
    <div class="container">
        <div class="row-fluid">
                    <?php 
                    if(isset($messages)){
                        foreach ($messages as $message){
                    ?>
                    <div class="alert alert-<?php echo $message['type'] ?>">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $message['message'] ?>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>

        <form class="form-signin" method="post">
            <h2 class="form-signin-heading">Please sign in</h2>
            <input type="text" name="admin_user_name" class="input-block-level" placeholder="Username">
            <input type="password" name="admin_password" class="input-block-level" placeholder="Password">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn btn-large btn-primary" type="submit">Sign in</button>
        </form>
