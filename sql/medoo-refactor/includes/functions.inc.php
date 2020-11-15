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
    $users = dbInit()->select("utilisateurs", ["id", "lastname", "firstname", "email", "pro"]);
    return $users;
}

function getPagesOfUsers($from, $nb)
{
    $users = dbInit()->select("utilisateurs", ["id", "lastname", "firstname", "email", "pro"],['LIMIT' => [$from, $nb]]);
    return $users;
}

function getUser($id) // return, from the "utilisateurs" table, only the user with the id placed in parameter
{
    $user = dbInit()->get("utilisateurs", ["id", "lastname", "firstname", "email", "password", "pro"], ["id" => $id]);
    return $user;
}

function countUsers()
{
    $nbUsers = dbInit()->count('utilisateurs');
    return $nbUsers;
}

/* function adminDisplayUsers()  // display a table with all users with modify and delete buttons.
{

    $array = getAllUsers();

    echo "
    <div class='table-responsive container'>
        <div class='d-flex justify-content-end'>
            <button type='button' class='btn btn-success mt-4 mb-3' data-toggle='modal' data-target='#addUserModal'>Ajouter un utilisateur</i></button>
        </div>
        <table class='table table-bordered table-hover table-striped'>
            <thead class='thead-dark'>
                <tr>
                    <th class='text-center px-1' scope='col'>ID</th>
                    <th class='text-center px-1' scope='col'>Name</th>
                    <th class='text-center px-1' scope='col'>Lastname</th>
                    <th class='text-center px-1' scope='col'>E-Mail</th>
                    <th class='text-center px-1' scope='col'>Status</th>
                    <th class='text-center px-1' scope='col'>Actions</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($array as $row) {
        switch ($row['pro']) {
            case '0':
                $status = "Particulier";
                break;
            case '1':
                $status = "Professionel";
                break;
        }
        echo "
        
            <tr>
                <td class='text-center px-1'>" . $row['id'] . "</td>
                <td class='text-center px-1'>" . $row['lastname'] . "</td>
                <td class='text-center px-1'>" . $row['firstname'] . "</td>
                <td class='text-center px-1'>" . $row['email'] . "</td>
                <td class='text-center px-1'>" . $status . "</td>
                <td class='text-center px-1'>
                    <form class='mb-0' action='' method='POST'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button class='btn btn-primary' type='submit' name='modify'><i class='icofont-edit'></i></button>
                        <button class='btn btn-danger' type='submit' name='delete'><i class='icofont-ui-delete'></i></button>
                    </form>
                </td>
            </tr>";
    }

    echo "</tbody></table></div>";
} */

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

    if (!empty($lastname) && $lastname !== $user['lastname']) {
        $data['lastname'] = $lastname;
    }
    if (!empty($firstname) && $firstname !== $user['firstname']) {
        $data['firstname'] = $firstname;
    }
    if (!empty($email) && $email !== $user['email']) {
        $data['email'] = $email;
    }
    if ($pro !== $user['pro']) {
        $data['pro'] = $pro;
    }
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data['password'] = $hashedPassword;
    }

    dbInit()->debug()->update("utilisateurs", $data, ['id' => $id]);
    if (dbInit()->error()) {
        return false;
    } else {
        return true;
    }
}

function removeUser($id)      //Return false if error or true if not.
{
    dbInit()->delete("utilisateurs", ["id" => $id]);
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
