<?php

include_once "includes/functions.inc.php";
include_once "includes/formHandling.inc.php";
include_once "includes/register.inc.php";

if (isset($registerError) && $registerError == true) {
    echo "<script type='text/javascript'>
            $(window).on('load',function(){ $('#registerModal').modal('show');});
        </script>";
}

?>
<div class="modal fade" id="registerModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">S'enregister</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" action="" method="post">
                <input type='hidden' name='register'>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="name" name="lastname" value="<?php echo isset($_POST["lastname"]) ? $_POST["lastname"] : "" ?>">
                        <?php echo $lastnameErr; ?>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Prénom :</label>
                        <input type="text" class="form-control" id="lastname" name="firstname" value="<?php echo isset($_POST["firstname"]) ? $_POST["firstname"] : "" ?>">
                        <?php echo $firstnameErr; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail :</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>">
                        <?php echo $emailErr; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <?php echo $passwordErr; ?>
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirm">Confirmation du mot de passe :</label>
                        <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm">
                    </div>
                    <div class="form-group">
                        <p>Status :</p>
                        <input type="radio" id="pro" name="pro" value="1" <?php echo isset($_POST['pro']) && $_POST['pro'] == '1' ? ' checked="checked"' : ""; ?>>
                        <label for="pro">Professionel</label>
                        <br>
                        <input type="radio" id="particulier" name="pro" value="0" <?php echo isset($_POST['pro']) && $_POST['pro'] == '0' ? ' checked="checked"' : ""; ?>>
                        <label for="particulier">Particulier</label>
                        <?php echo $proErr; ?>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="cgu" name="cgu" value="cgu">
                        <label for="cgu" class="d-inline">Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement.</label>
                        <?php echo $cguErr; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Abandonner</button>
                    <button type="submit" class="btn btn-primary" name="register">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>