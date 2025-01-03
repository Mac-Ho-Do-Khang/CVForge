<?php
session_start();
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
    <meta name="description" content="CVForge. Easily create, share, and manage professional CVs online. Jobseekers can build CVs using customizable templates or upload PDFs. Secure your profile with privacy options and share it with a unique URL." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="content/img/fev-icon.png" />
    <link rel="stylesheet" href="css/myCVs.css" />
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
                            <?php
                            ?>
                        </form>
                    </div>
                </div>
            </ul>
        </nav>
    </header>

    <div class="cv-view-area">
        <div id="conTab" class="cv-tab">
            <button class="add-a-CV" onclick="window.location.href = 'index.php?page=add';" >Add CV</button>
        </div>

        <div id="conViewCVData" style="display: flex" class="cv-tabcontent">
            <div class="view-CV-container">
                <?php require "php/component/CV.php";?>
                <h1 id="txtNoCV">You don't have any CV. Create one by clicking on 'Add CV'.</h1>
            </div>
            <div class="view-CV-details" >
                <ion-icon name="link"></ion-icon>
                <p id="txtLink">http://abc.com/CV0001</p>
                <ion-icon name="calendar"></ion-icon>
                <p id="txtCreateDate">June 10, 2024</p>
                <ion-icon name="lock-closed"></ion-icon>
                <p id="txtPassword">Abc123-456-789</p>
                <ion-icon name="people-circle"></ion-icon>
                <ul id="conAllower" class="mails">
                    <li>john@html.com</li>
                    <li>mary@css.com</li>
                    <li>garry@js.com</li>
                    <li>mark@php.com</li>
                </ul>
                <button class="btn btn-full edit-CV" onclick="editCV()" >Edit</button>
                <button class="btn btn-full edit-CV" onclick="deleteCV()" >Delete</button>
            </div>
            
        </div>
        

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

    <!----------------------- To be seperated  ----------------------->
    <!-- Handle the cv-tabs  -->
    <script>
        // https://www.w3schools.com/howto/howto_js_vertical_tabs.asp 
        function openCV(evt) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="cv-tabcontent" and hide them
            // tabcontent = document.getElementsByClassName("cv-tabcontent");
            // for (i = 0; i < tabcontent.length; i++) {
            //     tabcontent[i].style.display = "none";
            // }

            // Get all elements with class="cv-tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("cv-tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current cv-tab, and add an "active" class to the link that opened the cv-tab
            evt.currentTarget.className += " active";

            fillCVdata(evt.currentTarget.getAttribute("data-cvid"));
        }

    </script>
    <!--Backend logic -->
    <script>
        //Initializing tab and user cv's data
        let cv_data = [];
        const add_cv_button_html = document.getElementById("conTab").innerHTML;
        let xmtpp = new XMLHttpRequest();
        xmtpp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                // console.log(this.response);
                cv_data = JSON.parse(this.response);
                
                const tab_container = document.getElementById("conTab");
                for (let i = 0; i < cv_data.length; i++){
                    const row = cv_data[i];
                    const button = document.createElement('button');
                    // Add classes
                    button.className = 'cv-tablinks';

                    // Set attributes
                    button.setAttribute('data-cvid', row.id);
                    button.setAttribute('onclick', `openCV(event, '${row.title}')`);
                    if (row == cv_data[0])
                        button.setAttribute('id', 'defaultOpen');

                    // Set the inner text
                    button.innerText = row.title;
                    tab_container.appendChild(button);
                }
                // Get the element with id="defaultOpen" and click on it if user has a CV
                if (document.getElementById("defaultOpen")){
                    document.getElementById("defaultOpen").click();
                    document.getElementById("txtNoCV").style.display = "none";
                } else{
                    document.getElementById("conRevCV").style.display = "none";
                    document.getElementsByClassName("view-CV-details")[0].style.visibility = "hidden";
                }
                
            }   
        }
        xmtpp.open("GET", "php/myCVs_logic.php?action=init", true);
        xmtpp.send();
    

        function fillCVdata(cv_id){
            let data = cv_data.filter(function(ele){return ele.id == cv_id})[0];
            console.log(data);
            //Change review CV dynamically
            dataToCV(JSON.stringify(data));

            //Change CV details
            document.getElementById("txtLink").innerHTML = window.location.origin + "/" + cv_id;
            document.getElementById("txtCreateDate").innerHTML = data.create_time;
            if (data.password)
                document.getElementById("txtPassword").innerHTML = data.password;
            else
            document.getElementById("txtPassword").innerHTML = "No password is set."

            const allower_container = document.getElementById("conAllower");
            while (allower_container.firstChild) {
                allower_container.removeChild(allower_container.lastChild);
            }
            switch (data.access_level){
                case "1": //private
                    if (true){
                        let component = document.createElement("li");
                        component.innerHTML = "Private";
                        allower_container.appendChild(component);
                        break;
                    }
                case "2": //public
                    if (true){
                        let component = document.createElement("li");
                        component.innerHTML = "Public";
                        allower_container.appendChild(component);
                        break;
                    }
                case "3": //selected few
                    for (let i = 0; i < data.allower.length; i++){
                        let ele = data.allower[i];
                        let component = document.createElement("li");
                        component.innerHTML = ele.email;
                        allower_container.appendChild(component);
                    }
                    break;
            } 
        }

        function editCV(){
            window.location.href = "index.php?page=add&cvid=" + document.getElementsByClassName(" active")[0].getAttribute("data-cvid") ;
        }

        function deleteCV(){
            const cv_id = document.getElementsByClassName(" active")[0].getAttribute("data-cvid");
            let delete_xmtpp = new XMLHttpRequest();
            delete_xmtpp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    let delete_pos = 0;
                    for (let i = 0; i < cv_data.length; i++){
                        if (cv_id == cv_data[i].id){
                            delete_pos = i;
                            break;
                        }
                    }
                    const cv_tabs = document.getElementsByClassName("cv-tablinks");
                    document.getElementById("conTab").removeChild(cv_tabs[delete_pos]);
                    cv_data = cv_data.filter(function(ele){return ele.id != cv_id});
                    if (cv_tabs.length > 0){
                        cv_tabs[0].click();
                        document.getElementById("txtNoCV").style.display = "none"; 
                    } else{
                        document.getElementById("conRevCV").style.display = "none";
                        document.getElementsByClassName("view-CV-details")[0].style.visibility = "hidden";
                        document.getElementById("txtNoCV").style.display = "block";
                    }
                }   
            }
            delete_xmtpp.open("GET", "php/myCVs_logic.php?action=delete&cvid=" + cv_id, true);
            delete_xmtpp.send();
        }
    </script>
</body>

</html>