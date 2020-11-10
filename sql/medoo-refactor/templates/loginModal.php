<?php

include_once "includes/functions.inc.php";
include_once "includes/login.inc.php";

if (isset($loginError) && $loginError == true) {
    echo "<script type='text/javascript'>
            $(window).on('load',function(){ $('#loginModal').modal('show');});
        </script>";
}

?>
<form action="" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label for="Email">E-Mail</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : "" ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <a href="forgotPwd.php">Forgot your password?</a>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Abandonner</button>
        <button type="submit" class="btn btn-primary" name="logIn">Connecter</button>
    </div>
</form>