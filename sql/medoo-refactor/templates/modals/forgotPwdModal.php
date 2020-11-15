<?php
include_once "includes/reset-pwd-request.inc.php";

if (isset($loginError) && $loginError == true) {
    echo "<script type='text/javascript'>
            $(window).on('load',function(){ $('#loginModal').modal('show');});
        </script>";
}

?>

<div class="modal fade" id="forgotPwdModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Mot de passe oublié.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Pour changer votre mot de passe veuillez entrer votre Email :</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="resetPasswordSubmit">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>