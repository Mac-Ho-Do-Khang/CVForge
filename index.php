<?php
    // Set 'home' as the default page if no 'page' parameter is provided
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    switch ($page) {
        case 'home':
            include 'php/home.php';
            break;

        case 'myCVs':
            include 'php/myCVs.php';
            break;

        case 'viewCVs':
            include 'php/viewCVs.php';
            break;

        case 'add':
            include 'php/add.php';
            break;

        case 'login':
            include 'php/login.php';
            break;

        case 'logout':
            include 'php/logout.php';
            break;

        case 'register':
            include 'php/register.php';
            break;

        case 'auth':
            include 'php/auth.php';
            break;

        case 'add_account.php':
            include 'php/add_account.php';
            break;

        default:
            include 'php/404.php';  // 404 error page if no valid page is found
            break;
    }
    ?>
