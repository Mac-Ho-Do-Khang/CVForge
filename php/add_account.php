<?php
    include 'database_interface.php';
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        add_account($_POST['name'], $_POST['email'], $_POST['password'], $_POST['role']);
        header('Location: ../index.php?page=login');
    }
    else {
        var_dump($_POST);
    }
?>