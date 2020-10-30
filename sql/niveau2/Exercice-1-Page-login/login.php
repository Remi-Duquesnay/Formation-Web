<?php


function test_input($data)
{
    $data = trim($data); //Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); //Remove backslashes
    $data = htmlspecialchars($data); //converts special characters to HTML entities to avoid malicious code injection
    return $data;
}

$usernameErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $valid = true;
    if (empty($_POST["username"])) {
        $usernameErr = "The username is required";
        $valid = false;
    }
    if (empty($_POST["password"])) {
        $passwordErr = "The password is required";
        $valid = false;
    }

    if ($valid == true) {
        $username = test_input($_POST["username"]);
        echo $username;
        $password = test_input($_POST["password"]);
        echo $password;
        $date = date("Y-m-d H:i:s");
        echo $date;

        $dbUser = 'root';
        $dbPass = '';
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=niveau2exo1', $dbUser, $dbPass);
            $sql = "INSERT INTO Connexions (login, password, date_connexion)
                    VALUES  ('$username', '$password', '$date')";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $dbh = null;
        } catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style .error{color:red;}></style>
    <title>sql - login page</title>
</head>

<body>

    <form action="login.php" method="post">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : "" ?>"><span class="error"><?php echo $usernameErr; ?></span>
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"><span class="error"><?php echo $passwordErr; ?></span>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>

</body>

</html>