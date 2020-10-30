<?php
function test_input($data)
{
    $data = trim($data); //Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); //Remove backslashes
    $data = htmlspecialchars($data); //converts special characters to HTML entities to avoid malicious code injection
    return $data;
}

function dbh()
{
    $dbUser = 'root';
    $dbPass = '';

    $conn = new PDO('mysql:host=localhost;dbname=niveau2', $dbUser, $dbPass);

    return $conn;
}

$passwordConfirmErr = $passwordErr = "";

if (isset($_POST["submit"])) {
    $selector = $_SESSION["selector"];
    $validator = $_SESSION["validator"];
    $password = test_input($_POST["password"]);
    $passwordConfirm = test_input($_POST["passwordConfirm"]);

    $valid = true;

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


    $currentDate = date("U");

    $conn = dbh();

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($selector, $currentDate));
    $result = $stmt->fetch();
    $resultCount = count($result);
    var_dump($result);



    if ($resultCount == 0) {
        $valid = false;
    } else {
        $email = $result["pwdResetEmail"];
    }

    if ($valid == true) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE Utilisateurs SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($password, $email));

        $sql = "DELETE FROM pwdReset WHERE pwdResetSelector = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($selector));

        header("Location: pwdChangeConfirm.php");

    }else{
        $conn = null;
    }
}
