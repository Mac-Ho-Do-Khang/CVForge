<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login&&error=Login%20first");
    exit();
}
if ($_SESSION['user'] !== "jobseeker") {
    header("Location: index.php?page=login&&error=Login%20first");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CVForge. Easily create, share, and manage professional CVs online. Jobseekers can build CVs using customizable templates or search PDFs. Secure your profile with privacy options and share it with a unique URL." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="content/img/fev-icon.png" />
    <link rel="stylesheet" href="css/viewCVs.css" />
    <link rel="stylesheet" href="css/add.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script
        defer
        src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
    <script
        type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script
        nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>CVForge - Login</title>
</head>

<body>
    <header class="header">
        <a href="index.php?page=home" title="Return to home page">
            <img src="content/img/logo.png" class="logo" alt="Logo of CVForge, in which the letter F is replaced by a hammer shape" />
        </a>
        <nav class="header-nav">
            <ul class="header-nav-list">
                <li><a class="header-nav-link" href="index.php?page=home" title="Return to home page">Home</a></li>
                <li><a class="header-nav-link" href="index.php?page=myCVs" title="Go to view CVs">My CVs</a></li>
                <li><a class="header-nav-link" href="index.php?page=add" title="Go to add CVs">Add CV</a></li>
                <div class="user-info">
                    <ion-icon class="user-icon" name="person-circle"></ion-icon>
                    <div class="info">
                        <p><?php echo $_SESSION['user']; ?></p>
                        <p><?php echo $_SESSION['email'] ?></p>
                        <!-- Log out button -->
                        <form action="index.php?page=login" method="post" style="display: inline;">
                            <input type="submit" value="Log out" class="logout-btn" />
                        </form>
                    </div>
                </div>
            </ul>
        </nav>
    </header>

    <div id="formPassword" class="CV-search-container">
        <form class="CV-search" onsubmit="event.preventDefault();">
            <!-- Password -->
            <div class="CV-search-part Name">
                <div class="CV-search-icon-label">
                    <ion-icon name="lock-closed"></ion-icon>
                    <label>Password</label>
                </div>
                <input id="txtPassword" onkeyup="enterInput(event, this.value)" type="text" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
            </div>
            <!-- Submit button -->
            <div class="submit-button-wrapper">
                <input  type="button" onclick='checkPassword(event, document.getElementById("txtPassword").value);' value="Search" class="btn btn-full">
            </div>
            <!-- Error prompt -->
            <div class="CV-form-part form-error-notify">
                <p id="txtError"></p>
            </div>
        </form>
    </div>
    <div id="conCV" class="CV-view-search" style="display: none">
        <?php require "php/component/CV.php" ?>
    </div>

    <footer>
        <div
            class="grid-container"
            style="--column: 5; --c-gap: 6.4rem; --r-gap: 9.6rem">
            <!------------ Logo ------------>
            <div class="logo-section">
                <a href="#" title="Return to the beginning of home page"><img src="content/img/logo.png" class="logo" alt="Logo of CVForge, in which the letter F is replaced by a hammer shape" /></a>
                <ul class="social-networks">
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-facebook"></ion-icon></a>
                    </li>
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-tiktok"></ion-icon></a>
                    </li>
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-skype"></ion-icon></a>
                    </li>
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-discord"></ion-icon></a>
                    </li>
                    <li>
                        <a href="#" title="Return to the beginning of home page"><ion-icon class="social-icon" name="logo-twitter"></ion-icon></a>
                    </li>
                </ul>
                <p class="copyright">
                    Copyright &copy; by Group 1, Inc. All rights reserved.
                </p>
            </div>
            <!------------ Contacts ------------>
            <div class="contacts">
                <p class="footer-heading">Contact us</p>
                <ul class="footer-nav">
                    <li class="address">
                        268 Ly Thuong Kiet Street, Ward 14, District 10, HCMC
                    </li>
                    <li><a href="tel:919-263-1770">2252297</a></li>
                    <li>
                        <a href="mailto:XiTrumbumbum@cvforge.com">khang.mackhang@hcmut.edu.vn</a>
                    </li>
                </ul>
            </div>
            <!------------ Company ------------>
            <nav>
                <p class="footer-heading">Company</p>
                <ul class="footer-nav">
                    <li><a href="#" title="Return to the beginning of home page">About CVForge</a></li>
                    <li><a href="#" title="Return to the beginning of home page">For Businesses</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Celestial Partners</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Careers</a></li>
                </ul>
            </nav>
            <!------------ Account ------------>
            <nav>
                <p class="footer-heading">Account</p>
                <ul class="footer-nav">
                    <li><a href="#" title="Return to the beginning of home page">Create account</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Sign in</a></li>
                    <li><a href="#" title="Return to the beginning of home page">iOS app</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Android app</a></li>
                </ul>
            </nav>
            <!------------ Resources ------------>
            <nav>
                <p class="footer-heading">Resources</p>
                <ul class="footer-nav">
                    <li><a href="#" title="Return to the beginning of home page">CV Directory</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Help Center</a></li>
                    <li><a href="#" title="Return to the beginning of home page">Privacy & Terms</a></li>
                </ul>
            </nav>
        </div>
    </footer>
</body>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    //User access check
    let access_xmtpp = new XMLHttpRequest();
    access_xmtpp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            if (this.responseText == "AccessDeny"){
                window.location.href = "index.php?page=error&errMessage=accessDeny";
                exit();
            } else if (this.responseText == "NoCV"){
                window.location.href = "index.php?page=error&errMessage=noCV";
                exit();
            }
        }
    }
    access_xmtpp.open("GET", "php/viewCVs_logic.php?action=accessCheck&cvid=" + urlParams.get("cvid"), true);
    access_xmtpp.send();
    

    //Initialize data
    let data = [];
    let xmtpp = new XMLHttpRequest();  
 
    xmtpp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            data = JSON.parse(this.responseText);
            if (data.password == ""){
                document.getElementById("formPassword").style.display = "none";
                openViewCV();
            } else {
                document.getElementById("formPassword").style.display = "flex";
                document.getElementById("conCV").style.display = "none";
            }
            
        }
    }
    xmtpp.open("GET", "php/viewCVs_logic.php?action=init&cvid=" + urlParams.get("cvid"), true);
    xmtpp.send();

    function enterInput(event, value){
        if (event.key == "Enter"){
            checkPassword(event, value);
        }
    }

    function checkPassword(event, value){
        console.log(value + "/" + data.password );
        if (value == data.password){
            openViewCV();
            document.getElementById("txtError").innerHTML = "";
        } else {
            document.getElementById("conCV").style.display = "none";
            document.getElementById("txtError").innerHTML = "Wrong password!";
        }
    }

    function openViewCV(){
        if (document.getElementById("conCV").style.display == "none"){
            document.getElementById("conCV").style.display = "flex";
            dataToCV(JSON.stringify(data));
        }
    }
</script> 

</html>