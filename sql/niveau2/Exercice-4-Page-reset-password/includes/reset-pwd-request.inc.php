<?php

$emailErr = "";

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

function emailExist($email)
{
    
    try {

        $conn = dbh();


        $sql = "SELECT email FROM Utilisateurs WHERE email = '$email' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $conn = null;
        return $result;
    } catch (PDOException $e) {
        echo "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function saveToken($email, $selector, $token, $expires)
{
    $conn = dbh();
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = '$email' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $hasedToken = password_hash($token, PASSWORD_DEFAULT);
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES ('$email', '$selector', '$hasedToken', '$expires' )";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $conn = null;
    
}

function sendMail($email, $url)
{
    $to = $email;

    $subject = "Changing password request for [\"INESRT WEBSITE ADDRESS HERE\"]";
    
    $message = "<p>We recieved a password reset request. If you did not make this request, you can ignore this message.</p>";
    $message .= "<p>Here is your link to reset your password :<br>";
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: admin <virtualayu@free.fr>\r\n";
    $headers .= "Reply-to: virtualayu@free.fr\r\n";
    $headers .= "Content-type: text/html\r\n";

    /* mail($to, $subject, $message, $headers); */
    echo $url;


}

if (isset($_POST["resetPasswordSubmit"])) {

    $email = test_input($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "A valid E-Mail is required";
    } else {
        if (emailExist($email)) {

            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $url = "localhost/Formation-Web/sql/niveau2/Exercice-4-Page-reset-password/change-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
            $expires = date("U") + 1800;

            saveToken($email, $selector, $token, $expires);
            sendMail($email, $url);
            echo "<script>alert(\"Un E-mail pour réinitialiser votre mot de passe vous a été envoyé.\")</script>";
            
        }
    }
} else {
    header("Location: ../index.php");
}
