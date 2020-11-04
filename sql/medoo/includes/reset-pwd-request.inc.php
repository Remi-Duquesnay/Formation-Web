<?php

include "functions.inc.php";
include "sendemail.php";

$emailErr = "";

if (isset($_POST["resetPasswordSubmit"])) {

    $email = test_input($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "A valid E-Mail is required";
    } else {
        if (emailExist($email)) {

            $selector = bin2hex(random_bytes(8));
            $token = bin2hex(random_bytes(32));
            $url = "localhost/Formation-Web/sql/medoo/changePwd.php?selector=" . $selector . "&token=" . $token;

            $subject = "Reinitialisation du mot de passe";
            $body = "<a href='".$url."'>".$url."</a>";

            savePwdToken($email, $selector, $token);
            
            /* send_mail($email, $subject, $body); */
            echo $url;
        }
        echo "<script>alert(\"Un E-mail pour réinitialiser le mot de passe a été envoyé à l'adresse indiquée.\")</script>";
    }
}
