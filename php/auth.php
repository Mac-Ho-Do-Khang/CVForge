<?php
    $_SESSION['user'] = '';
    $_SESSION['email'] = '';
    include 'database_interface.php';
    if (authenticate_user($_POST['username'], $_POST['password'])) {
        header('Location: ../index.php?page=home');
    }
    else {
        header('Location: ../index.php?page=login&&error=Wrong%20username%20or%20password');
    }
?>