<?php


function test_input($data)
{
    $data = trim($data); //Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); //Remove backslashes
    $data = htmlspecialchars($data); //converts special characters to HTML entities to avoid malicious code injection
    return $data;
}

$nameErr = $surnameErr = $emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;
    if (empty($_POST["name"])) {
        $nameErr = "Veuillez indiquer votre nom de famille.";
        $valid = false;
    }
    if (empty($_POST["surname"])) {
        $surnameErr = "Veuillez indiquer votre prénom.";
        $valid = false;
    }
    if(empty($_POST["email"])) {
        $emailErr = "Veuillez indiquer un E-mail";
        $valid = false;
        }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Veuillez indiquer un E-mail valide.";
            $valid = false;
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Veuillez indiquer un mot de passe.";
        $valid = false;
    }else[
        
    ]

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

    <form action="register.php" method="post">

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>"><span class="error"><?php echo $nameErr; ?></span>
        <br>
        <label for="surname">Prénom :</label>
        <input type="text" id="surname" name="surname" value="<?php echo isset($_POST["surname"]) ? $_POST["surname"] : "" ?>"><span class="error"><?php echo $surnameErr; ?></span>
        <br>
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>"><span class="error"><?php echo $emailErr; ?></span>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password"><span class="error"><?php echo $passwordErr; ?></span>
        <br>
        <label for="passwordConfirm">Mot de passe :</label>
        <input type="password" id="passwordConfirm" name="passwordConfirm"><span class="error"><?php echo $passwordErr; ?></span>
        <br>
        <label for="pro">Je suis : professionel</label>
        <input type="radio" id="pro" name="pro" value="true" <?php if(isset($_POST['pro']) && $_POST['pro'] == 'true'){echo ' checked="checked"';} ?>>
        <label for="particulier"> particulier</label>
        <input type="radio" id="particulier" name="pro" value="false" <?php if(isset($_POST['pro']) && $_POST['pro'] == 'false'){echo ' checked="checked"';} ?>>
        <br>
        <input type="checkbox" id="cgu" name="cgu" value="true">
        <label for="cgu">Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement.</label>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>

</body>

</html>