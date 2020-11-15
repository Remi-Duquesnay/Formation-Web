<?php

include "../includes/functions.inc.php";

/* $nbByPage = $_POST['nbByPage']; */
$nbByPage = '10';

if (isset($_POST['currentPage'])) {
    $currentPage = $_POST['currentPage'];
} else {
    $currentPage = '1';
}

if (isset($_POST['toPage'])) {
    $toPage = $_POST['toPage'];
} else {
    $toPage = '1';
}


$from = ($toPage - 1) * $nbByPage;
$array = getPagesOfUsers($from, $nbByPage);

$nbOfUsers = countUsers();
$nbPages = ceil($nbOfUsers / $nbByPage);

?>

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
        <tbody>

            <?php foreach ($array as $row) :
                switch ($row['pro']) {
                    case '0':
                        $status = "Particulier";
                        break;
                    case '1':
                        $status = "Professionel";
                        break;
                }
            ?>
                <tr>
                    <td class='text-center px-1'><?php echo $row['id'] ?></td>
                    <td class='text-center px-1'><?php echo $row['lastname'] ?></td>
                    <td class='text-center px-1'><?php echo $row['firstname'] ?></td>
                    <td class='text-center px-1'><?php echo $row['email'] ?></td>
                    <td class='text-center px-1'><?php echo $status ?></td>
                    <td class='text-center px-1'>
                        <form class='mb-0' action='' method='POST'>
                            <input type='hidden' name='id' value='<?php echo $row['id'] ?>'>
                            <button class='btn btn-primary' type='submit' name='modify'><i class='icofont-edit'></i></button>
                            <button class='btn btn-danger' type='submit' name='delete'><i class='icofont-ui-delete'></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li> -->
            <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                <?php if ($i == $toPage) : ?>
                    <li class="page-item active"><a class="page-link"><?php echo $i ?><span class="sr-only">(current)</span></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" onclick='displayUsersPages("<?php echo $i ?>")'><?php echo $i ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>
            <!-- <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li> -->
        </ul>
    </nav>

</div>
