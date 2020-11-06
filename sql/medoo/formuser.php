<!-- A faire:

        if modify, check email but errors only if email changed and newone already in ddb.
        idea : check all input against the user data in ddb to see what changed???

        change function for modify and add in ddb to get arrays in parameters to allow the change of what is needed.




        !!!!!!! redo everything in order to generate the form in function of is use (if modify or "adminAdd" then the CGU is useless) !!!!!!!!!!!!
                                                        thing about making it for integration in a modal ???
-->




<?php
session_start();

include "includes/functions.inc.php";
include "includes/formHandling.inc.php";

$errors = [];



if (isset($_POST['submit'])) {
    $verifFirstname = verifFirstname($_POST['firstname']);
    $verifLastname = verifLastname($_POST['lastname']);
    $verifEmail = verifEmail($_POST['email']);
    
    
    $valid = true;
    if(!isset($_POST['pro'])){
        $proErr = "Veuillez selectioner un status.";
        $valid = false;
    }
    if(!isset($_POST['cgu'])){
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
    
    if($_POST['submit'] == "modify"){

        if(!empty($_POST['password'])){
            $verifPassword = verifPassword($_POST['password'], $_POST['passwordConfirm']);
            if ($verifPassword != "valid") {
        $passwordErr = $verifPassword;
        $valid = false;
    }
        }

    }else if($_POST['submit'] == "add"){

    }
}else{
    if ($_POST['action'] == "modify") {

        $id = $_POST['id'];
    
        $userinfo = getUser($id);
        
        $_POST['name'] = $userinfo['name'];
        $_POST['lastname'] = $userinfo['lastname'];
        $_POST['email'] = $userinfo['email'];
        $_POST['pro'] = $userinfo['pro'];
    
    } 
}


    $verifFirstname = verifFirstname($_POST['firstname']);
    $verifLastname = verifLastname($_POST['lastname']);
    $verifEmail = verifEmail($_POST['email']);
    $verifPassword = verifPassword($_POST['password'], $_POST['passwordConfirm']);
    
    $valid = true;
    if(!isset($_POST['pro'])){
        $proErr = "Veuillez selectioner un status.";
        $valid = false;
    }
    if(!isset($_POST['cgu'])){
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
        <button type="submit" name="submit" value="<?php echo $_POST["action"]?>">Submit</button>
    </form>
    <?php

    ?>