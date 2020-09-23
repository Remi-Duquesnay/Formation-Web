<?php
include "impot.php";
    
    $nameErr = $revenuErr = "";
    $valid = true;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if(empty($_GET["name"])){
            $nameErr = "Le nom est requis<br>";
            echo "<span style=\"color:red\">".$nameErr."</span>";
            $valid = false;
        }
        if(empty($_GET["revenu"])){
            $revenuErr = "Le revenu est requis<br>";
            echo "<span style=\"color:red\">".$revenuErr."</span>";
            $valid = false;
        }

        if($valid == false){            
            echo "<a href=\"index.php\">Retour</a>";
        }

        if($valid == true){
            $name = $_GET["name"];
            $revenu = $_GET["revenu"]; 
            $test = new impot($name, $revenu);
            $test->afficheImpot();
        }
        
    }
?>