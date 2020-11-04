<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
</head>

<body>
    <?php
    include "includes/reset-pwd-request.inc.php";


    ?>

    <form action="forgotPwd.php" method="POST">
        <label for="email">Pour changer votre mot de passe veuillez entrer votre Email :</label>
        <br>
        <input type="email" id="email" name="email"><span class="error"><?php echo $emailErr; ?></span>
        <br>
        <button type="submit" name="resetPasswordSubmit">Envoyer</button>
    </form>


</body>

</html>