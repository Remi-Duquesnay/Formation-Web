<?php

include "includes/functions.inc.php";
include "includes/formHandling.inc.php";

$firstnameErr = $lastnameErr = $emailErr = $passwordErr = $passwordConfirmErr = $proErr = $cguErr = "";
$userAdded = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    if($valid){
        $userAdded = addUser($_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['pro'], $_POST['password']);
    }

    
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error {
            color: red;
        }
    </style>
    <title>sql - register page</title>
</head>

<body>
<?php
if($userAdded){
    echo "Votre compte à été créé <br><a href='login.php'>Se connecter</a>";
}else{
?>
    <form action="register.php" method="post">

        <label for="name">Nom :</label>
        <input type="text" id="name" name="lastname" value="<?php echo isset($_POST["lastname"]) ? $_POST["lastname"] : "" ?>"><span class="error"><?php echo $lastnameErr; ?></span>
        <br>
        <label for="lastname">Prénom :</label>
        <input type="text" id="lastname" name="firstname" value="<?php echo isset($_POST["firstname"]) ? $_POST["firstname"] : "" ?>"><span class="error"><?php echo $firstnameErr; ?></span>
        <br>
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>"><span class="error"><?php echo $emailErr; ?></span>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password"><span class="error"><?php echo $passwordErr; ?></span>
        <br>
        <label for="passwordConfirm">Confirmation du mot de passe :</label>
        <input type="password" id="passwordConfirm" name="passwordConfirm">
        <br>
        <label for="pro">Je suis : professionel</label>
        <input type="radio" id="pro" name="pro" value="1" <?php if (isset($_POST['pro']) && $_POST['pro'] == '1') {
                                                                echo ' checked="checked"';
                                                            } ?>>
        <label for="particulier"> particulier</label>
        <input type="radio" id="particulier" name="pro" value="0" <?php if (isset($_POST['pro']) && $_POST['pro'] == '0') {
                                                                        echo ' checked="checked"';
                                                                    } ?>>
        <span class="error"><?php echo $proErr; ?></span>
        <br>
        <input type="checkbox" id="cgu" name="cgu" value="cgu">
        <label for="cgu">Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement.</label>
        <span class="error"><?php echo $cguErr; ?></span>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>
<?php } ?>
</body>

</html>
