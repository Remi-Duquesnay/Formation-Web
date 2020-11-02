<?php

include "includes/medoo.php";

use Medoo\Medoo;



function dbInit() // Database initialisation
{
    $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'niveau2',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ]);
    return $database;
}

function emailExist($email) //return only true or false to limit the use of this function to only its purpose.
{
    $database = dbInit();
    $exist = $database->select("utilisateurs", "email", ["email" => "$email"]);
    if ($exist) {
        return true;
    } else {
        return false;
    }
}

function connexionsLog($email, $password, $succes)
{
    $clientIp = getClientIp();
    $database = dbInit();
    $connLog = $database->insert("connexions", ["login" => $email, "password" => $password, "ip" => $clientIp, "succes" => $succes]);
    return $connLog;
}

function verifyIpBan($nbAttempts) // return "true" or "false" if user is ban or not. Take in param the number of connexion attempts before we ban.
{
    $database = dbInit();

    $clientIp = getClientIp();

    $ipBan = $database->select("connexions", ["succes", "date_connexion"], ["ip" => $clientIp, "ORDER" => ["date_connexion" => "DESC"]]);

    $failedConn = 0;

    foreach ($ipBan as $row) {
        $dateConn = strtotime($row['date_connexion']);
        $timeDiff = time() - $dateConn;
        if ($failedConn >= $nbAttempts - 1) {
            $ban = true;
            break;
        }
        if ($row['succes'] == "1" || $timeDiff > 1800) {
            $ban = false;
            break;
        }
        $failedConn++;
    }
    return $ban;
}

function login($email, $password)
{
    $database = dbInit();
    if (emailExist($email)) {
        $user = $database->get("utilisateurs", ["password", "id"], ["email" => $email]);
        $passCheck = password_verify($password, $user['password']);

            if ($passCheck == 1) {
                $_SESSION['email'] = $email;
                connexionsLog($email, $password, '1');
                session_start();
                $_SESSION["userid"] = $user["id"];
                header('location: home.php');
            } else {
                connexionsLog($email, $password, '0');
                echo "<script>alert(\"E-Mail, Password combination incorrect!\")</script>";
            }
    } else {
        echo "<script>alert(\"E-Mail, Password combination incorrect!\")</script>";
    } 
}

function savePswToken($email, $selector, $token, $expires)
{
    $conn = dbh();
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = '$email' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $hasedToken = password_hash($token, PASSWORD_DEFAULT);
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES ('$email', '$selector', '$hasedToken', '$expires')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $conn = null;
}

function updatePwd($password)
{
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE Utilisateurs SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($password, $email));
}

function deletePwdToken($selector)
{
    $sql = "DELETE FROM pwdReset WHERE pwdResetSelector = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($selector));
}

function test_input($data)
{
    $data = trim($data); //Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); //Remove backslashes
    $data = htmlspecialchars($data); //converts special characters to HTML entities to avoid malicious code injection
    return $data;
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