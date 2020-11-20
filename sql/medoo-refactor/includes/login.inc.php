<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logIn'])) {

    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    if (!verifyIpBan(5) || !verifyEmailBan($email, 5)) {
        if (!login($email, $password)) {
            $loginError = "<p class='alert alert-danger'>Combinaison E-Mail/Mot de passe incorrecte!</p>";
        }
    } else {
        $loginError = "<p class='alert alert-danger'>Trop de tentative de connexions. <br>Pour des raisons de sécurité, vous ne pouvez pas vous connecter. <br>Vous pourrez réessayer dans 30 minutes </p>";
    }
}else{
    $loginError = "";
}
