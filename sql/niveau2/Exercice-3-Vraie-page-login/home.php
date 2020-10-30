<?php

function dbh()
{
    $dbUser = 'root';
    $dbPass = '';

    $conn = new PDO('mysql:host=localhost;dbname=niveau2', $dbUser, $dbPass);

    return $conn;
}

function getAllUsers(){
    $conn = dbh();

    $sql = "SELECT * FROM Utilisateurs";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}

function displayUsers(){
    $array = getAllUsers();

    echo "<table border=\"1\"><tr><th>ID</th><th>Name</th><th>Lastname</th><th>E-Mail</th><th>Pro</th><th>Actions</th></tr>";

    foreach($array as $row){
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['lastname'] . "</td><td>" . $row['email'] . "</td><td>" . $row['pro'] . "</td><td><form action=\"home.php\" method=\"POST\"><input type=\"hidden\" name=\"id\" value=\"".$row['id']."\"></form><form action=\"formuser.php\" method=\"POST\"><input type=\"hidden\" name=\"id\" value=\"".$row['id']."\"><button type=\"submit\" name=\"modify\">Modify</button><button type=\"submit\" name=\"delete\">Delete</button></form></td></tr>";
    }

    echo "</table>";
}







session_start();

if(isset($_POST["delete"])){
    $conn = dbh();

    $id = $_POST['id'];

    $sql = "DELETE FROM Utilisateurs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id));

    $conn = null;
}

if(isset($_SESSION["userid"] )){
    displayUsers();
}else{
    header("Location: login.php");
}
