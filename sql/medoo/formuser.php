<!-- A faire:

        if modify, check email but errors only if email changed and newone already in ddb.
        idea : check all input against the user data in ddb to see what changed???

        change function for modify and add in ddb to get arrays in parameters to allow the change of what is needed.


-->




<?php
session_start();

include "includes/functions.inc.php";
include "includes/formHandling.inc.php";

/* function adduser($name, $lastname, $email, $pro, $password)
{
    $conn = dbh();

    if (isset($password)) {
        $sql = "INSERT INTO Utilisateurs(name, lastname, email, password, pro) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($name, $lastname, $email, $password, $pro));
    } else {
        $sql = "INSERT INTO Utilisateurs(name, lastname, email, pro) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($name, $lastname, $email, $pro));
    }
} */



function verifFrom()
{
    $name = test_input($_POST["name"]);
    $lastname = test_input($_POST["lastname"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $passwordConfirm = test_input($_POST["passwordConfirm"]);

    $valid = true;
    if (empty($name)) {
        $errors["name"] = "Veuillez indiquer un nom de famille.";
        $valid = false;
    }
    if (empty($lastname)) {
        $errors["lastname"] = "Veuillez indiquer un prénom.";
        $valid = false;
    }
    if (empty($email)) {
        $errors["email"] = "Veuillez indiquer un E-mail";
        $valid = false;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Veuillez indiquer un E-mail valide.";
            $valid = false;
        } else {
            if (verifEmailDispo($email)) {
                $valid = false;
                $errors["email"] = "Cet E-mail est déjà utilisé!";
            }
        }
    }
    if (!empty($password)) {
        if (strlen($password) < 8 || !preg_match("~[0-9]~", $password) ||  !preg_match("~[a-z]~", $password) ||  !preg_match("~[A-Z]~", $password)) {
            $errors["password"] = "Le mot de passe doit contenir minimum : 8 charactères, un chiffre, une majuscule et une muniscule";
            $valid = false;
        } else {
            if ($passwordConfirm != $password) {
                $errors["passwordConfirm"] = "Les mots de passe ne correspondent pas.";
                $valid = false;
            }
        }
    }
    if (!isset($_POST["pro"])) {
        $errors["pro"] = "Veuillez selectioner un status.";
    }
    return $errors;
}

$errors = [];

if (isset($_POST['modify'])) {

    $id = $_POST['id'];

    $userinfo = getUser($id);
    
    $_POST['name'] = $userinfo['name'];
    $_POST['lastname'] = $userinfo['lastname'];
    $_POST['email'] = $userinfo['email'];
    $_POST['pro'] = $userinfo['pro'];
} else if (isset($_POST['add'])) {

    echo "add user";
} else if (isset($_POST['submit'])) {
    $errors = verifFrom();
    if (!empty($errors)) {echo "test";
        /* $password = password_hash($password, PASSWORD_DEFAULT);
        signingUp($name, $lastname, $email, $password, $_POST["pro"]); */
    }

} else if (!isset($_POST)) {

    header("Location: home.php");
}

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error {
            color: red;
        }
    </style>
    <title>sql - login page</title>
</head>

<body>

    <form action="formuser.php" method="post">

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>"><span class="error"><?php echo isset($errors["name"]) ? $errors["name"] : "";; ?></span>
        <br>
        <label for="lastname">Prénom :</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo isset($_POST["lastname"]) ? $_POST["lastname"] : "" ?>"><span class="error"><?php echo isset($errors["lastname"]) ? $errors["lastname"] : ""; ?></span>
        <br>
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>"><span class="error"><?php echo isset($errors["email"]) ? $errors["email"] : ""; ?></span>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password"><span class="error"><?php echo isset($errors["password"]) ? $errors["password"] : ""; ?></span>
        <br>
        <label for="passwordConfirm">Confirmation du mot de passe :</label>
        <input type="password" id="passwordConfirm" name="passwordConfirm"><span class="error"><?php echo isset($errors["passwordConfirm"]) ? $errors["passwordConfirm"] : ""; ?></span>
        <br>
        <label for="pro">Status pro : professionel</label>
        <input type="radio" id="pro" name="pro" value="pro" <?php echo isset($_POST['pro']) && $_POST['pro'] == '1' ? ' checked="checked"' : "" ?>>
        <label for="particulier"> particulier</label>
        <input type="radio" id="particulier" name="pro" value="particulier" <?php echo isset($_POST['pro']) && $_POST['pro'] == '0' ? ' checked="checked"' : "" ?>>
        <span class="error"><?php echo isset($errors["pro"]) ? $errors["pro"] : ""; ?></span>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <?php

    ?>