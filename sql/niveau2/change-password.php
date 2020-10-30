<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include "includes/reset-password.inc.php";
    $selector = $_GET["selector"];
    $validator = $_GET["validator"];

    if (isset($selector) && isset($validator)) {
        $_SESSION['selector'] = $selector;
        $_SESSION['validator'] = $validator;
    }


    if (empty($selector) || empty($validator)) {
        echo "Could not validate your request";
    } else {
        if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
    ?>

            <form action="change-password.php?selector=<?php echo $_SESSION['selector'] ?>&validator=<?php echo $_SESSION['validator'] ?>" method="POST">
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" id="password" name="password"><span class="error"><?php echo $passwordErr; ?></span>
                <br>
                <label for="passwordConfirm">Confirmation du mot de passe :</label>
                <input type="password" id="passwordConfirm" name="passwordConfirm"><span class="error"><?php echo $passwordConfirmErr; ?></span>
                <br>
                <button type="submit" name="submit">Changer le mot de passe.</button>
            </form>

    <?php
        }
    }
    ?>
</body>

</html>