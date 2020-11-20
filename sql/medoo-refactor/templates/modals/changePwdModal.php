
    <?php
    include_once "includes/reset-password.inc.php";

    if (isset($_GET["selector"]) && $_GET["token"]) {
        $_SESSION['selector'] = $_GET["selector"];
        $_SESSION['token'] = $_GET["token"];
    }

    if (ctype_xdigit($_SESSION['selector']) !== false && ctype_xdigit($_SESSION['token']) !== false) {// problem ici <-<-<-<-<-<-<-<-<-!!!!!!!!!!!!!!!!!!!!!!!!!

    ?>

        <form action="changePwdModal.php?selector=<?php echo $_SESSION['selector'] ?>&token=<?php echo $_SESSION['token'] ?>" method="POST">
            <div class="modal fade" id="changePwdModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Changement du mot de passe.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="mb-0" action="" method="post">
                            <input type='hidden' name='changePwd'>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="password">Nouveau mot de passe :</label>
                                    <input type="password" id="password" name="password">
                                    <?php echo $passwordErr; ?>
                                </div>
                                <div class="form-group">
                                    <label for="passwordConfirm">Confirmation du mot de passe :</label>
                                    <input type="password" id="passwordConfirm" name="passwordConfirm">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Abandonner</button>
                                <button type="submit" class="btn btn-primary" name="changePwd">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>



    <?php
    } else {
        header("Location: home.php");
    }
    ?>
</body>

</html>