<?php

$firstnameErr = $lastnameErr = $emailErr = $passwordErr = $passwordConfirmErr = $proErr = $cguErr = "";
$userAdded = false;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {

    $verifFirstname = verifFirstname($_POST['firstname']);
    $verifLastname = verifLastname($_POST['lastname']);
    $verifEmail = verifEmail($_POST['email']);
    $verifPassword = verifPassword($_POST['password'], $_POST['passwordConfirm']);

    $valid = true;
    if (!isset($_POST['pro'])) {
        $proErr = "Veuillez selectioner un status.";
        $valid = false;
    }
    if (!isset($_POST['cgu'])) {
        $cguErr = "Veuillez lire et accepter les conditions d'utilisation.";
        $valid = false;
    }
    if ($verifLastname != "valid") {
        $lastnameErr = $verifLastname;
        $valid = false;
    }
    if ($verifFirstname != "valid") {
        $firstnameErr = $verifFirstname;
        $valid = false;
    }
    if ($verifEmail != "valid") {
        $emailErr = $verifEmail;
        $valid = false;
    }
    if ($verifPassword != "valid") {
        $passwordErr = $verifPassword;
        $valid = false;
    }
    
    if ($valid == false) {
        $registerError = true;
    }

    if ($valid) {
        $userAdded = addUser($_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['pro'], $_POST['password']);
        if ($userAdded) {
            echo "<script>alert(\"Création du compte réussi!\")</script>";
        } else {
            echo "<script>alert(\"Erreur!\\nIl  y a eu un problème lors de la création du compte.\\nVeuillez rééssayer.\\nSi le problème persiste, veuillez nous contacter.\")</script>";
        }
    }
}
