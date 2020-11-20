<?php

$firstnameErr = $lastnameErr = $emailErr = $passwordErr = $passwordConfirmErr = $proErr = $cguErr = "";
$userAdded = false;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addUser'])) {
    $registerError = false;

    $firstname = test_input($_POST['firstname']);
    $lastname = test_input($_POST['lastname']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $passwordConfirm = test_input($_POST['passwordConfirm']);

    $verifFirstname = verifFirstname($firstname);
    $verifLastname = verifLastname($lastname);
    $verifEmail = verifEmail($email);

    $valid = true;
    
    if ($verifLastname != "valid") {
        $lastnameErr = "<p class='alert alert-danger'>" . $verifLastname . "</p>";
        $valid = false;
    }
    if ($verifFirstname != "valid") {
        $firstnameErr = "<p class='alert alert-danger'>" . $verifFirstname . "</p>";
        $valid = false;
    }
    if ($verifEmail != "valid") {
        $emailErr = "<p class='alert alert-danger'>" . $verifEmail . "</p>";
        $valid = false;
    }else if (emailExist($email)) {
        $emailErr = "<p class='alert alert-danger'>Cet E-mail est déjà utilisé!</p>";
        $valid = false;
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
        $userAdded = addUser($lastname, $firstname, $email, $_POST['pro'], $password);
        if ($userAdded) {
            echo "<script>alert(\"Création du compte réussi!\")</script>";
        } else {
            echo "<script>alert('Erreur!\\nIl  y a eu un problème lors de la création du compte.\\n\')</script>";
        }
    }else{
        $addUserError = true;
    }
}
