<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error {
            color: red;
        }
    </style>
    <title>Change password</title>
</head>

<body>
    <?php
    session_start();
    include "includes/reset-password.inc.php";
    $selector = $_GET["selector"];
    $token = $_GET["token"];

    if (isset($selector) && isset($token)) {
        $_SESSION['selector'] = $selector;
        $_SESSION['token'] = $token;
    }


    if (ctype_xdigit($selector) !== false && ctype_xdigit($token) !== false) {

    ?>

        <form action="changePwd.php?selector=<?php echo $_SESSION['selector'] ?>&token=<?php echo $_SESSION['token'] ?>" method="POST">
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password"><span class="error"><?php echo $passwordErr; ?></span>
            <br>
            <label for="passwordConfirm">Confirmation du mot de passe :</label>
            <input type="password" id="passwordConfirm" name="passwordConfirm">
            <br>
            <button type="submit" name="submit">Changer le mot de passe</button>
        </form>

    <?php
    } else {
        header("Location: home.php");
    }
    ?>
</body>

</html>