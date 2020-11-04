<?php

include "includes/functions.inc.php";

session_start();

if(isset($_POST["delete"])){
    removeUser($_POST['id']);
}

if(isset($_SESSION["userid"] )){
    displayUsers();
}else{
    header("Location: login.php");
}
