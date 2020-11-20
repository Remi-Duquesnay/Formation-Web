<?php

function verifEmail($email)   // Return "valid" or an error
{
    $email = test_input($email);
    if (empty($email)) {
        $result = "Veuillez indiquer un E-mail";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = "Veuillez indiquer un E-mail valide.";
    } else {
        $result = "valid";
    }
    return $result;
}

function verifLastname($lastname)
{
    $lastname = test_input($lastname);

    if (empty($lastname)) {
        $result = "Veuillez indiquer un nom de famille.";
    } else {
        $result = true;
    }
    return $result;
}

function verifFirstname($firstname)
{
    $firstname = test_input($firstname);
    if (empty($firstname)) {
        $result = "Veuillez indiquer un prénom.";
    } else {
        $result = "valid";
    }
    return $result;
}

function verifPassword($password, $passwordConfirm)
{
    $password = test_input($password);
    $passwordConfirm = test_input($passwordConfirm);
    if (empty($password)) {
        $result = "Veuillez indiquer un mot de passe";
    } else if (strlen($password) < 8 || !preg_match("~[0-9]~", $password) ||  !preg_match("~[a-z]~", $password) ||  !preg_match("~[A-Z]~", $password)) {
        $result = "Le mot de passe doit contenir minimum : 8 charactères, un chiffre, une majuscule et une muniscule";
    } else if ($passwordConfirm != $password) {
        $result = "Les mots de passe ne correspondent pas.";
    } else {
        $result = "valid";
    }
    return $result;
}

