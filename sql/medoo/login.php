<?php

include "./includes/functions.inc.php";

$emailErr = $passwordErr = "";




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $valid = true;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "A valid E-Mail is required";
        $valid = false;
    }
    if (empty($password)) {
        $passwordErr = "The password is required";
        $valid = false;
    }

    if ($valid == true) {
        if(!verifyIpBan(5)){
            login($email, $password);
        }else{
            echo "<script>alert(\"Too many connexions attempted. \\nFor safety you cannot login. \\nYou can try again in 30min \")</script>"; 
        }
        
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
        <input type="text" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>"><span class="error"><?php echo $emailErr; ?></span>
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"><span class="error"><?php echo $passwordErr; ?></span>
        <br>
        <a href="resetpassword.php">Forgot your password?</a>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>

</body>

</html>