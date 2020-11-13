<?php

include "../includes/functions.inc.php";

/* $nbByPage = $_POST['nbByPage']; */
$nbByPage = '10';

if(isset($_POST['currentPage'])){
    $currentPage = $_POST['currentPage'];
}else{
    $currentPage = '1';
}

if(isset($_POST['toPage'])){
    $toPage = $_POST['toPage'];
}else{
    $toPage = '1';
}


$from = ($toPage-1) * $nbByPage;
$array = getPagesOfUsers($from, $nbByPage);
$nbOfUsers = countUsers();
$nbPages = ceil ($nbOfUsers / $nbByPage);

echo "
    <div class='table-responsive container' id='userTable'>
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

echo "</tbody></table>";
for ($i = 1; $i <= $nbPages; $i++) {
    if($i == $toPage){
        echo "<span class='currentPage'>" . $i . "</span>";
    }else{
        echo "<span onclick='displayUsersPages(".$i.")'>" . $i . "</span>";
    }
    
}

echo "</div>";
