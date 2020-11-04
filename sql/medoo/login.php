<?php

include "includes/functions.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);

    if (!verifyIpBan(5) || !verifyEmailBan($email, 5)) {
        if (login($email, $password)) {
            header('location: home.php');
        } else {
            echo "<script>alert(\"Combinaison E-Mail/Mot de passe incorrecte!\")</script>";
        }
    } else {
        echo "<script>alert(\"Trop de tentative de connexions. \\nPour des raisons de sécurité, vous ne pouvez pas vous connecter. \\nVous pourrez réessayer dans 30 minutes \")</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

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

    <form action="login.php" method="post">

        <label for="Email">E-Mail</label>
        <input type="text" id="email" name="email" value="<?php echo isset($email) ? $email : "" ?>">
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <a href="forgotPwd.php">Forgot your password?</a>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>

</body>

</html>