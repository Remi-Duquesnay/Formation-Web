<?php

include_once "medoo.php";

use Medoo\Medoo;

function dbInit() // Database initialisation
{
    $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'niveau2',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4'
    ]);
    return $database;
}

function emailExist($email){ //return only true if email is in the ddb of false if not.
    $exist = dbInit()->select("utilisateurs", "email", ["email" => "$email"]);
    if ($exist) {
        return true;
    } else {
        return false;
    }
}

function connexionsLog($email, $password, $succes) // log the connexions attempts
{
    $clientIp = getClientIp();

    $connLog = dbInit()->insert("connexions", ["login" => $email, "password" => $password, "ip" => $clientIp, "succes" => $succes]);
    return $connLog;
}

function verifyIpBan($nbAttempts) // return "true" or "false" if user IP is ban or not. Take in param the number of connexion attempts before we ban.
{

    $clientIp = getClientIp();

    $ipBan = dbInit()->select("connexions", ["succes", "date_connexion"], ["ip" => $clientIp, "ORDER" => ["date_connexion" => "DESC"]]);

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

function verifyEmailBan($email, $nbAttempts)  // return "true" or "false" if user EMAIL is ban or not. Take in param the number of connexion attempts before we ban.
{

    $emailBan = dbInit()->select("connexions", ["succes", "date_connexion"], ["login" => $email, "ORDER" => ["date_connexion" => "DESC"]]);

    $failedConn = 0;

    foreach ($emailBan as $row) {
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
    if (emailExist($email)) {
        $user = dbInit()->get("utilisateurs", ["password", "id"], ["email" => $email]);
        $passCheck = password_verify($password, $user['password']);

        if ($passCheck == 1) {
            connexionsLog($email, $password, '1');
            session_start();
            $_SESSION['userEmail'] = $email;
            $_SESSION["userid"] = $user["id"];
            $_SESSION['loggedIn'] = true;
            return true;
        } else {
            connexionsLog($email, $password, '0');
            return false;
        }
    } else {
        return false;
    }
}

function getAllUsers() // return all users in the "utilisateurs" table
{
    $users = dbInit()->select("utilisateurs", ["id", "name", "lastname", "email", "pro"]);
    return $users;
}

function getUser($id) // return, from the "utilisateurs" table, only the user with the id placed in parameter
{
    $user = dbInit()->get("utilisateurs", ["id", "name", "lastname", "email", "password", "pro"], ["id" => $id]);
    return $user;
}

function adminDisplayUsers()  // display a table with all users with modify and delete buttons.
{
    $array = getAllUsers();

    echo "
        <table border=\"1\">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>E-Mail</th>
            <th>Pro</th>
            <th>Actions</th>
        </tr>";

    foreach ($array as $row) {
        echo "
            <tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['lastname'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['pro'] . "</td>
                <td>
                    <form action=home.php' method='POST'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                    </form>
                    <form action='formuser.php' method='POST'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' name='action' value='modify'>Modify</button>
                        <button type='submit' name='delete'>Delete</button>
                    </form>
                </td>
            </tr>";
    }

    echo "</table>";
}

function addUser($lastname, $firstname, $email, $pro, $password = "") //password allways in last because the admin can add manually a user without setting a password.
{
    if ($password == "") {
        $password = bin2hex(random_bytes(8));
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $data = ["lastname" => $lastname, "firstname" => $firstname, "email" => $email, "password" => $hashedPassword, "pro" => $pro];

    dbInit()->insert("utilisateurs", $data);
    if (dbInit()->error()) {
        return false;
    } else {
        return true;
    }
}

function updateUser($id, $lastname, $firstname, $email, $pro, $password) //password in last to get the same formating than the addUser function. Return false if error or true if not.
{
    $data = [];

    $user = getUser($id);

    if ($lastname !== $user['lastname']) {
        $data['lastname'] = $lastname;
    }
    if ($firstname !== $user['firstname']) {
        $data['firstname'] = $firstname;
    }
    if ($email !== $user['email']) {
        $data['email'] = $email;
    }
    if ($pro !== $user['pro']) {
        $data['pro'] = $pro;
    }
    if (!password_verify($password, $user['password'])) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data['password'] = $hashedPassword;
    }

    dbInit()->update("utilisateurs", $data, ['id' => $id]);
    if (dbInit()->error()) {
        return false;
    } else {
        return true;
    }
}

function removeUser($id)      //Return false if error or true if not.
{
    dbInit()->delete("utilisateur", ["id" => $id]);
    if (dbInit()->error()) {
        return false;
    } else {
        return true;
    }
}

function savePwdToken($email, $selector, $token)
{
    //removing of olds tokens in the ddb
    deletePwdToken($email);

    $expires = date("U") + 1800;
    $hasedToken = password_hash($token, PASSWORD_DEFAULT);

    // adding the new token to the ddb
    dbInit()->insert("pwdReset", ["pwdResetEmail" => $email, "pwdResetSelector" => $selector, "pwdResetToken" => $hasedToken, "pwdResetExpires" => $expires]);
}

function isPwdTokenValid($selector, $token) //return the Email link to the token or false
{
    $result = dbInit()->get("pwdReset", ['pwdResetEmail', 'pwdResetToken', 'pwdResetExpires'], ['pwdResetSelector' => $selector]);
    if ($result) {
        $valid = password_verify($token, $result['pwdResetToken']);

        if ($valid && $result['pwdResetExpires'] > date("U")) {
            return $result['pwdResetEmail'];
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function updatePwd($password, $email)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    dbInit()->update("utilisateurs", ["password" => $hashedPassword], ["email" => $email]);
    if (dbInit()->error()) {
        return false;
    } else {
        return true;
    }
}

function deletePwdToken($email)
{
    dbInit()->delete("pwdReset", ["pwdResetEmail" => $email]);
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
