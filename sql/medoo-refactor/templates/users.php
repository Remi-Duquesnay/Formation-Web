    <div>
        <?php

        if (isset($_SESSION["loggedIn"])) : ?>
            <?php
            include_once "templates/modifyUserModal.php";
            include_once "templates/addUserModal.php";
            ?>
            <script type="text/javascript">
                function displayUsersPages(toPage) {
                    $.ajax({
                        url: 'templates/usersTables.php',
                        type: 'POST',
                        data: 'toPage=' + toPage,
                        dataType: 'html',
                        success: function(code_html, statut) {
                            $(userTable).replaceWith(code_html);
                        },

                        error: function(resultat, statut, erreur) {

                        },

                        complete: function(resultat, statut) {

                        }
                    });
                }
                $(document).ready(function() {
                    $("#userTable").load("templates/usersTables.php");
                })
            </script>

            <div id="userTable"></div>
            <?php
            if (isset($_POST['modify'])) {
                echo "<script type='text/javascript'>
            $(window).on('load',function(){ $('#modifyUserModal').modal('show');});
        </script>";
            }
            if (isset($_POST['delete'])) {
                removeUser($_POST['id']);
            }
            ?>
        <?php else : ?>
            <?php
            echo "<script type='text/javascript'>
            $(window).on('load',function(){ $('#loginModal').modal('show');});
        </script>";
            ?>
        <?php endif; ?>
    </div>