<?php

include_once "includes/functions.inc.php";
include_once "includes/formHandling.inc.php";
include_once "includes/modifyUser.inc.php";

if (isset($modifyError) && $modifyError == true) {
    echo "<script type='text/javascript'>
            $(window).on('load',function(){ $('#modifyUserModal').modal('show');});
        </script>";
}
if (isset($_POST['id'])) {
    $user = getUser($_POST['id']);
}


?>

<div class="modal fade" id="modifyUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification compte utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" action="" method="post">
                <input type='hidden' name='id' value='<?php echo $_POST["id"] ?>'>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="name" name="lastname" value="<?php if (isset($_POST["lastname"])) {
                                                                                                        echo $_POST["lastname"];
                                                                                                    } else if (isset($user['lastname'])) {
                                                                                                        echo $user['lastname'];
                                                                                                    }  ?>">
                        <?php echo $lastnameErr; ?>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Prénom :</label>
                        <input type="text" class="form-control" id="lastname" name="firstname" value="<?php if (isset($_POST["firstname"])) {
                                                                                                            echo $_POST["firstname"];
                                                                                                        } else if (isset($user['firstname'])) {
                                                                                                            echo $user['firstname'];
                                                                                                        } ?>">
                        <?php echo $firstnameErr; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail :</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php if (isset($_POST["email"])) {
                                                                                                    echo $_POST["email"];
                                                                                                } else if (isset($user['email'])) {
                                                                                                    echo $user['email'];
                                                                                                } ?>">
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
                        <input type="radio" id="pro" name="pro" value="1" <?php if ((isset($_POST['pro']) && $_POST['pro'] == '1') || (isset($user['pro']) && $user['pro'] == '1')) {
                                                                                echo ' checked="checked"';
                                                                            } ?>>
                        <label for="pro">Professionel</label>
                        <br>
                        <input type="radio" id="particulier" name="pro" value="0" <?php if ((isset($_POST['pro']) && $_POST['pro'] == '0') || (isset($user['pro']) && $user['pro'] == '0')) {
                                                                                        echo ' checked="checked"';
                                                                                    } ?>>
                        <label for="particulier">Particulier</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Abandonner</button>
                        <button type="submit" class="btn btn-primary" name="submitModif">Envoyer</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>