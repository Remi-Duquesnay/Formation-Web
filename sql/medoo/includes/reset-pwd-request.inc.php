<?php

$emailErr = "";




if (isset($_POST["resetPasswordSubmit"])) {

    $email = test_input($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "A valid E-Mail is required";
    } else {
        if (emailExist($email)) {

            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $url = "localhost/Formation-Web/sql/niveau2/Exercice-4-Page-reset-password/change-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
            $expires = date("U") + 1800;

            saveToken($email, $selector, $token, $expires);
            sendMail($email, $url);
            echo "<script>alert(\"Un E-mail pour réinitialiser votre mot de passe vous a été envoyé.\")</script>";
            
        }
    }
} else {
    header("Location: ../index.php");
}
