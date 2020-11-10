<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logIn'])) {

    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    if (!verifyIpBan(5) || !verifyEmailBan($email, 5)) {
        if (!login($email, $password)) {
            $loginError = true;
            echo "<script>alert(\"Combinaison E-Mail/Mot de passe incorrecte!\");</script>";
        } else {
            header('location: index.php');
        }
    } else {
        echo "<script>alert(\"Trop de tentative de connexions. \\nPour des raisons de sécurité, vous ne pouvez pas vous connecter. \\nVous pourrez réessayer dans 30 minutes \");window.location = 'index.php';</script>";
    }
}
