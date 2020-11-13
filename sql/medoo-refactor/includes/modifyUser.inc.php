<?php

$firstnameErr = $lastnameErr = $emailErr = $passwordErr = $passwordConfirmErr = $proErr = $cguErr = "";
$userAdded = false;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitModif'])) {
    
    if (isset($_POST['id'])) {
        $user = getUser($_POST['id']);
    }

    $modifyError = false;

    $firstname = test_input($_POST['firstname']);
    $lastname = test_input($_POST['lastname']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $passwordConfirm = test_input($_POST['passwordConfirm']);
    $pro = test_input($_POST['pro']);

    
    
    $valid = true;

    if($email != $user['email']){
        if (verifEmail($email) != "valid") {
            $emailErr = $verifEmail;
            $valid = false;
        }else if (emailExist($email)) {
            $emailErr = "Cet E-mail est déjà utilisé!";
            $valid = false;
        }
    }
    if (!empty($password)) {
        $verifPassword = verifPassword($password, $passwordConfirm);
        if ($verifPassword != "valid") {
            $passwordErr = $verifPassword;
            $valid = false;
        }
    }
    if (!isset($_POST['pro'])) {
        $proErr = "Veuillez selectioner un status.";
        $valid = false;
    }

    if ($valid) {
        $userModifyed = updateUser($user['id'], $lastname, $firstname, $email, $pro, $password);
        if ($userModifyed) {
            echo "<script>alert(\"Modifications des données réussi!\")</script>";
        } else {
            echo "<script>alert(\"Erreur!\\nIl  y a eu un problème lors de la modification des données.\\nVeuillez rééssayer.\\nSi le problème persiste, veuillez nous contacter.\")</script>";
        }
    } else {
        $modifyError = true;
    }
}
