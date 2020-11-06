<?php

include "includes/functions.inc.php";

test("plop", "plopi", "plopi@plop.fr", 1);

function test($name, $lastname, $email, $pro, $password = "")
{
    if($password == ""){
        $password = bin2hex(random_bytes(8));
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $data = ["name" => $name, "lastname" => $lastname, "email" => $email, "password" => $hashedPassword, "pro" => $pro];


    dbInit()->insert("utilisateurs", $data);
    if (dbInit()->error()) {
        return false;
    } else {
        return true;
    }
}
