<?php
include "formHandling.inc.php";

$passwordErr = "";

if (isset($_POST["submit"])) {
    $selector = $_SESSION["selector"];
    $token = $_SESSION["token"];
    $email = isPwdTokenValid($selector, $token);
    if ($email == false) {
        echo "<script>alert('Une erreur c'est produite! \\nVeuillez refaire une demande de changement de mot de passe.')</script>";
    } else {
        $verifPassword = verifPassword($_POST['password'], $_POST['passwordConfirm']);
        if ($verifPassword != "valid") {
            $passwordErr = $verifPassword;
        } else {
            if (updatePwd($_POST['password'], $email)) {
                deletePwdToken($email);
                header("Location: pwdChangeConfirm.php");
            }else{
                echo "<script>alert('Une erreur c'est produite! \\nVeuillez refaire une demande de changement de mot de passe. \\nSi le problème persiste, veuillez contacter l'administrateur du site.')</script>";
            }
        }
    }
}
