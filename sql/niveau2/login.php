<?php

session_start();

$emailErr = $passwordErr = "";

function test_input($data)
{
    $data = trim($data); //Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); //Remove backslashes
    $data = htmlspecialchars($data); //converts special characters to HTML entities to avoid malicious code injection
    return $data;
}

function connexionsLog($email, $password, $clientIp, $succes)
{
    $dbUser = 'root';
    $dbPass = '';
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=niveau2', $dbUser, $dbPass);
        $sql = "INSERT INTO Connexions (login, password, ip, succes)
                VALUES  ('$email', '$password', '$clientIp', '$succes')";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $dbh = null;
    } catch (PDOException $e) {
        echo "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function emailExist($email)
{
    $dbUser = 'root';
    $dbPass = '';

    try {

        $dbh = new PDO('mysql:host=localhost;dbname=niveau2', $dbUser, $dbPass);

        $sql = "SELECT email FROM Utilisateurs WHERE email = '$email' ";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $dbh = null;
        return $result;
    } catch (PDOException $e) {
        echo "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function getClientIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}

function verifyIpBan()
{
    $dbUser = 'root';
    $dbPass = '';
    $clientIp = getClientIp();
    $ban = false;

    try {

        $dbh = new PDO('mysql:host=localhost;dbname=niveau2', $dbUser, $dbPass);
        $sql = "SELECT date_connexion, succes as x FROM Connexions WHERE ip = '127.0.0.1' AND TIMEDIFF(NOW(), date_connexion) < '00:30:00' ORDER BY date_connexion DESC";
        $stmt = $dbh->query($sql);
        $failedConn = 1;
        foreach ($stmt as $row) {
            if ($failedConn >= 5) {
                $ban = true;
                break;
            }
            if ($row['x'] == "1") {
                $ban = false;
                break;
            }
            $failedConn++;
        }
        $dbh = null;
        return $ban;
    } catch (PDOException $e) {
        echo "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function login($email, $password, $date)
{

    if (emailExist($email)) {

        $clientIp = getClientIp();
        $dbUser = 'root';
        $dbPass = '';

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=niveau2', $dbUser, $dbPass);

            $sql = "SELECT password FROM Utilisateurs WHERE email = '$email' ";
            $stmt = $dbh->query($sql);

            foreach ($stmt as $row) {
                $passCheck = password_verify($password, $row["password"]);
            }
            if ($passCheck == 1) {
                $_SESSION['email'] = $email;
                connexionsLog($email, $password, $clientIp, '1');
                header('location: home.php');
            } else {
                connexionsLog($email, $password, $clientIp, '0');
                echo "<script>alert(\"E-Mail, Password combination incorrect!\")</script>";
            }
            $dbh = null;
        } catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    } else {
        echo "<script>alert(\"E-Mail, Password combination incorrect!\")</script>";
    }
}



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
        $date = date("Y-m-d H:i:s");
        if(!verifyIpBan()){
            login($email, $password, $date);
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

        >
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