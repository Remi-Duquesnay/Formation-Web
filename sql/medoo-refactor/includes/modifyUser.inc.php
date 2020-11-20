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
    $modifError = "";
    
    
    $valid = true;

    if($email != $user['email']){
        if (verifEmail($email) != "valid") {
            $emailErr = "<p class='alert alert-danger'>" . verifEmail($email) . "</p>";
            $valid = false;
        }else if (emailExist($email)) {
            $emailErr = "<p class='alert alert-danger'>Cet E-mail est déjà utilisé!</p>";
            $valid = false;
        }
    }
    if (!empty($password)) {
        $verifPassword = verifPassword($password, $passwordConfirm);
        if ($verifPassword != "valid") {
            $passwordErr = "<p class='alert alert-danger'>" . $verifPassword . "</p>";
            $valid = false;
        }
    }
    if (!isset($_POST['pro'])) {
        $proErr = "<p class='alert alert-danger d-block'>Veuillez selectioner un status.</p>";
        $valid = false;
    }

    if ($valid) {
        $userModifyed = updateUser($user['id'], $lastname, $firstname, $email, $pro, $password);
        if ($userModifyed) {
            $modifError = "<p class='alert alert-success'>Modifications des données réussi!\")</p>";
        } else {
            $modifError = "<script>alert(\"Erreur!\\nIl  y a eu un problème lors de la modification des données.\\nVeuillez rééssayer.\\nSi le problème persiste, veuillez nous contacter.\")</script>";
        }
    } else {
        $modifyError = true;
    }
}
