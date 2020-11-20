<?php

include_once "includes/login.inc.php";

if (isset($loginError) && $loginError == true) {
    echo "<script type='text/javascript'>
            $(window).on('load',function(){ $('#loginModal').modal('show');});
        </script>";
}

?>
<div class="modal fade" id="loginModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Email">E-Mail</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : "" ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <a href="#forgotPwdModal" data-dismiss="modal" data-toggle="modal" data-target="#forgotPwdModal">Mot de passe oublié?</a>
                    </div>
                    <div>
                        <?php echo $loginError; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Abandonner</button>
                    <button type="submit" class="btn btn-primary" name="logIn">Connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>