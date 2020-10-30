<?php


function test_input($data)
{
    $data = trim($data); //Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); //Remove backslashes
    $data = htmlspecialchars($data); //converts special characters to HTML entities to avoid malicious code injection
    return $data;
}

function verifEmailDispo($email)
{
    $dbUser = 'root';
    $dbPass = '';

    $dbh = new mysqli('localhost', $dbUser, $dbPass, 'niveau2');
    if ($dbh->connect_error) {
        die("Connection failed: " . $dbh->connect_error);
    }
    $sql = "SELECT email FROM Utilisateurs WHERE email = ? ";
    $stmt = $dbh->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}

function signingUp($name, $lastname, $email, $password, $pro)
{
    $dbUser = 'root';
    $dbPass = '';

    $dbh = new mysqli('localhost', $dbUser, $dbPass, 'niveau2');
    if ($dbh->connect_error) {
        die("Connection failed: " . $dbh->connect_error);
    }
    $querryLoginIn = "INSERT INTO Utilisateurs(name, lastname, email, password, pro) VALUES (?,?,?,?,?)";
    $stmt = $dbh->prepare($querryLoginIn);
    $stmt->bind_param('ssssi', $name, $lastname, $email, $password, $pro);
    $stmt->execute();
    $result = $stmt->fetch();
}

$nameErr = $lastnameErr = $emailErr = $passwordErr = $passwordConfirmErr = $proErr = $cguErr = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = test_input($_POST["name"]);
    $lastname = test_input($_POST["lastname"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $passwordConfirm = test_input($_POST["passwordConfirm"]);

    $valid = true;
    if (empty($name)) {
        $nameErr = "Veuillez indiquer votre nom de famille.";
        $valid = false;
    }
    if (empty($lastname)) {
        $lastnameErr = "Veuillez indiquer votre prénom.";
        $valid = false;
    }
    if (empty($email)) {
        $emailErr = "Veuillez indiquer un E-mail";
        $valid = false;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Veuillez indiquer un E-mail valide.";
            $valid = false;
        } else {
            if (verifEmailDispo($email)) {
                $valid = false;
                $emailErr = "Cet E-mail est déjà utilisé!";
            }
        }
    }
    if (empty($password)) {
        $passwordErr = "Veuillez indiquer un mot de passe.";
        $valid = false;
    } else {
        if (strlen($password) < 8 || !preg_match("~[0-9]~", $password) ||  !preg_match("~[a-z]~", $password) ||  !preg_match("~[A-Z]~", $password)) {
            $passwordErr = "Votre mot de passe doit contenir minimum : 8 charactères, un chiffre, une majuscule et une muniscule";
            $valid = false;
        } else {
            if ($passwordConfirm != $password) {
                $passwordConfirmErr = "Les mots de passe ne correspondent pas.";
                $valid = false;
            }
        }
    }
    if (!isset($_POST["pro"])) {
        $proErr = "Veuillez selectioner un status.";
    }
    if (!isset($_POST["cgu"])) {
        $cguErr = "Veuillez lire et accepter les conditions d'utilisation";
    }



    if ($valid == true) {
        $pro = $_POST["pro"];
        $password = password_hash($password, PASSWORD_DEFAULT);
        signingUp($name, $lastname, $email, $password, $pro);
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
    <title>sql - login page</title>
</head>

<body>

    <form action="register.php" method="post">

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>"><span class="error"><?php echo $nameErr; ?></span>
        <br>
        <label for="lastname">Prénom :</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo isset($_POST["lastname"]) ? $_POST["lastname"] : "" ?>"><span class="error"><?php echo $lastnameErr; ?></span>
        <br>
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>"><span class="error"><?php echo $emailErr; ?></span>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password"><span class="error"><?php echo $passwordErr; ?></span>
        <br>
        <label for="passwordConfirm">Confirmation du mot de passe :</label>
        <input type="password" id="passwordConfirm" name="passwordConfirm"><span class="error"><?php echo $passwordConfirmErr; ?></span>
        <br>
        <label for="pro">Je suis : professionel</label>
        <input type="radio" id="pro" name="pro" value="pro" <?php if (isset($_POST['pro']) && $_POST['pro'] == 'pro') {
                                                                    echo ' checked="checked"';
                                                                } ?>>
        <label for="particulier"> particulier</label>
        <input type="radio" id="particulier" name="particulier" value="false" <?php if (isset($_POST['pro']) && $_POST['pro'] == 'particulier') {
                                                                            echo ' checked="checked"';
                                                                        } ?>>
        <span class="error"><?php echo $proErr; ?></span>
        <br>
        <input type="checkbox" id="cgu" name="cgu">
        <label for="cgu">Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement.</label>
        <span class="error"><?php echo $cguErr; ?></span>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>

</body>

</html>