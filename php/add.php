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
    <style>
        /* Style for the loading overlay */
        .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5rem;
        color: #555;
        display: none; /* Initially hidden */
        }

        /* Simple spinner */
        .spinner {
        border: 6px solid #ccc;
        border-top: 6px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="dark">
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
                                // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                //     session_unset();
                                //     session_destroy();
                                //     header('Location: index.php?page=login');
                                //     exit();
                                // }
                                ?>
                            </form>
                        </div>
                    </div>
                </ul>
            </nav>
        </header>
    </div>

    <!-- <div class="add-tabs">
        <button class="add-tablink" onclick="openPage('CV-create', this)" id="defaultOpen">Create a CV</button>
        <button class="add-tablink" onclick="openPage('CV-upload', this)">Upload a CV</button>
    </div> -->
    <div class="loading-screen">
        <div class="spinner"></div>
        <p>Loading data, please wait...</p>
    </div>


    <section id="CV-create" class="add-tabcontent">
        <div class="CV-form-container">
            <form id="formCV" class="CV-form">
                <div class="CV-form-title">Primary information</div>
                <!-- Objective -->
                <div class="CV-form-part Objective">
                    <div class="CV-form-icon-label">
                        <ion-icon name="accessibility"></ion-icon>
                        <label>Objective (*)</label>
                    </div>
                    <textarea id="txtIntroduction" type="text" placeholder="Lorem ipsum dolor sit amet..." required></textarea>
                </div>
                <!-- Name -->
                <div class="CV-form-part Name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="person"></ion-icon>
                        <label>Full Name (*)</label>
                    </div>
                    <input id="txtName" name="name" type="text" placeholder="John M. Doe" required>
                </div>
                <!-- Job -->
                <div class="CV-form-part Job">
                    <div class="CV-form-icon-label">
                        <ion-icon name="briefcase"></ion-icon>
                        <label>Current Job (*)</label>
                    </div>
                    <input id="txtJob" name="job" type="text" placeholder="Graphic Designer" required>
                </div>
                <!-- Email -->
                <div class="CV-form-part Email">
                    <div class="CV-form-icon-label">
                        <ion-icon name="mail"></ion-icon>
                        <label>Email (*)</label>
                    </div>
                    <input id="txtEmail" name="email" type="text" placeholder="john@example.com" required>
                </div>
                <!-- Phone -->
                <div class="CV-form-part Phone">
                    <div class="CV-form-icon-label">
                        <ion-icon name="call"></ion-icon>
                        <label>Phone Number (*)</label>
                    </div>
                    <div id="phones-container">
                        <div class="with-trashbin">
                            <div class="phone-container">
                                <input type="text" placeholder="919-263-1770" required>
                            </div>

                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-phone-button">+</button>
                    </div>
                </div>
                <!-- Address -->
                <div class="CV-form-part Addresses">
                    <div class="CV-form-icon-label">
                        <ion-icon name="location"></ion-icon>
                        <label>Address (*)</label>
                    </div>
                    <div id="addresses-container">
                        <div class="with-trashbin">
                            <div class="address-container">
                                <input type="text" placeholder="123 Any Street" required>
                                <select class="country" name="country" onchange="fetchStates(event)">
                                    <option value="">---Country---</option>
                                </select>
                                <select class="state" name="state" onchange="fetchCities(event)">
                                    <option value="">---State---</option>
                                </select>
                              <select class="city" name="city">

                                    <option value="">---City---</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-address-button">+</button>
                    </div>
                </div>
                <!-- Skills -->
                <div class="CV-form-part Skills">
                    <div class="CV-form-icon-label">
                        <ion-icon name="settings"></ion-icon>
                        <label>Skills (*)</label>
                    </div>
                    <div id="skills-container">
                        <div class="with-trashbin">
                            <div class="skill-container">
                                <input type="text" name="field" placeholder="Your skill">
                                <input type="number" name="start" placeholder="Years of experience" min=1 required>
                            </div>

                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-skill-button">+</button>
                    </div>
                </div>
                <!-- Educations -->
                <div class="CV-form-part Educations">
                    <div class="CV-form-icon-label">
                        <ion-icon name="school"></ion-icon>
                        <label>Education (*)</label>
                    </div>
                    <div id="educations-container">
                        <div class="with-trashbin">
                            <div class="education-container">
                                <input type="text" name="university" placeholder="University" required>
                                <input type="text" name="major" placeholder="Major" required>
                                <input type="text" name="degree" placeholder="Degree" required>
                                <input type="text" name="gpa" placeholder="GPA" required>
                                <div class="year-container">
                                    <input type="number" name="start" placeholder="Start Year" min=1980 max=2024 required>
                                    <input type="number" name="end" placeholder="End Year" min=1980 max=2024 required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-education-button">+</button>
                    </div>
                </div>
                <!-- Experiences -->
                <div class="CV-form-part Experiences">
                    <div class="CV-form-icon-label">
                        <ion-icon name="briefcase"></ion-icon>
                        <label>Experience (*)</label>
                    </div>
                    <div id="experiences-container">
                        <div class="with-trashbin">
                            <div class="experience-container">
                                <input type="text" name="job" placeholder="Job Title" required>
                                <input type="text" name="company" placeholder="Company" required>
                                <input type="text" name="employer" placeholder="Employer" required>
                                <div class="year-container">
                                    <input type="number" name="start" min=1980 max=2024 placeholder="Start Year" required>
                                    <input type="number" name="end" min=1980 max=2024 placeholder="End Year" required>
                                </div>
                                <textarea name="description" placeholder="Description of responsibilities" required></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-experience-button">+</button>
                    </div>
                </div>
                <!-- References -->
                <div class="CV-form-part Objective">
                    <div class="CV-form-icon-label">
                        <ion-icon name="link"></ion-icon>
                        <label>References (Optional)</label>
                    </div>
                    <div class="reference-container">
                        <input id="txtRefEmail" type="text" placeholder="john@example.com">
                        <input id="txtRefPhone" type="text" placeholder="919-263-1770">
                    </div>
                </div>
                <!-- Additional information -->
                <div class="CV-form-part Objective">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information-circle"></ion-icon>
                        <label>Additional information (Optional)</label>
                    </div>
                    <textarea id="txtOther" type="text" placeholder="Lorem ipsum dolor sit amet..."></textarea>
                </div>

                <div class="CV-form-title">Additional setting</div>
                <!-- Form name -->
                <div class="CV-form-part Form-name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="albums"></ion-icon>
                        <label>Form Name (Optional)</label>
                    </div>
                    <input id="txtTitle" type="text" placeholder="Untitled">
                </div>
                <!-- Password -->
                <div class="CV-form-part Name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="lock-closed"></ion-icon>
                        <label>Password (Optional)</label>
                    </div>
                    <input id="txtPassword" type="text" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                </div>
                <!-- Allowed email -->
                <div class="CV-form-part Allowers">
                    <div class="CV-form-icon-label">
                        <ion-icon name="people"></ion-icon>
                        <label>Who can view your CV?</label>
                    </div>
                    <div id="allowers-selector">
                        <select id="selAccessLevel" onchange="">
                            <option value="1">Only me</option>
                            <option value="2">Everyone</option>
                            <option value="3">Specified</option>
                        </select>
                    </div>
                    <div id="allowers-container">
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-allower-button">+</button>
                    </div>
                </div>

                <!-- Error prompt -->
                <div class="CV-form-part form-error-notify">
                    <p id="txtError"></p>
                </div>  

                <div class="submit-button-wrapper">
                    <button id="btnPrepareCV" class="btn btn-full" type="button" onClick="validateInput()">Prepare CV</button>
                </div>
            </form>
            
        </div>

        <div id="conCVreview" class="CV-view-container" style="display: none">
            <!-- https://www.w3schools.com/howto/howto_js_slideshow.asp  -->
            <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade" style="display: block">
                    <?php include "php/component/CV.php"?>
                </div>
                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>

            <!-- The dots/circles -->
            <div id="conDot" class="dots" style="text-align:center">
            </div>
        </div>

        <div id="conCreateCV" class="submit-button-wrapper" style='display: none'>
            <button type="button" class="btn btn-full create-CV-btn" onclick="result = validateInput(); if (!result) sendInputToServer() ;">Create CV</button>
        </div>

    </section>

    <section id="CV-upload" class="add-tabcontent" style="display:none;">
        <div class="CV-upload-form-container">
            <form action="index.php?page=login" class="CV-upload-form CV-form">
                <div class="CV-form-title">Upload file</div>
                <input type="file" id="myFile" name="filename" class="CV-upload-upload">

                <div class="CV-form-title">Additional setting</div>
                <!-- Form name -->
                <div class="CV-form-part Form-name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="information-circle"></ion-icon>
                        <label>Form Name (Optional)</label>
                    </div>
                    <input id="txtTitle" type="text" placeholder="Untitled">
                </div>
                <!-- Password -->
                <div class="CV-form-part Name">
                    <div class="CV-form-icon-label">
                        <ion-icon name="lock-closed"></ion-icon>
                        <label>Password (Optional)</label>
                    </div>
                    <input id="txtPassword" type="text" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                </div>
                <!-- Allowed email -->
                <div class="CV-form-part Allowers">
                    <div class="CV-form-icon-label">
                        <ion-icon name="people"></ion-icon>
                        <label>Who can view your CV? (Optional)</label>
                    </div>
                    <div id="allowers-container">
                        <!-- <div class="allower-container">
                            <input type="text" placeholder="Email...">
                        </div> -->
                    </div>
                    <div class="add-button-wrapper">
                        <button type="button" class="add-button" id="add-allower-button">+</button>
                    </div>
                </div>
                <div class="CV-upload-submit-wrapper">
                    <input type="submit" class="btn btn-full CV-upload-submit" value="Upload">
                </div>
            </form>
        </div>
    </section>

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

    <!--------------- To be seperated --------------->
    <!-- Handle the tabs  -->
    <script>
        // https://www.w3schools.com/howto/howto_js_full_page_tabs.asp
        function openPage(pageName, elmnt) {
            // Hide all elements with class="tabcontent" by default */
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("add-tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the background color of all tablinks/buttons
            tablinks = document.getElementsByClassName("add-tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
                tablinks[i].style.color = "#eaeae8";
                tablinks[i].style.fontWeight = "500";
            }

            // Show the specific tab content
            document.getElementById(pageName).style.display = "block";

            // Add the specific color to the button used to open the tab content
            elmnt.style.backgroundColor = "#eaeae8";
            elmnt.style.color = "#0D1B2A";
            elmnt.style.fontWeight = "600";
        }

        // Get the element with id="defaultOpen" and click on it
        //document.getElementById("defaultOpen").click();
    </script>

    <!-- Dynamically add phones  -->
    <script>
        const add_phone_button = document.getElementById('add-phone-button');
        const phones_container = document.getElementById('phones-container');

        add_phone_button.addEventListener('click', () => {
            const newInputWrapper = document.createElement('div');
            newInputWrapper.classList.add('with-trashbin');
            const phoneContainer = document.createElement('div');
            phoneContainer.classList.add('phone-container');

            const phoneInput = document.createElement('input');
            phoneInput.type = 'text';
            phoneInput.placeholder = '919-263-1770';
            phoneInput.required = true;

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                phones_container.removeChild(newInputWrapper);
            });

            // Append input and trash icon to their respective containers
            phoneContainer.appendChild(phoneInput);
            newInputWrapper.appendChild(phoneContainer);
            newInputWrapper.appendChild(trashIcon);
            // Append the new input wrapper to the phones container
            phones_container.appendChild(newInputWrapper);
        });
    </script>
    <!-- Dynamically add addresses  -->
    <script>
        const add_address_button = document.getElementById('add-address-button');
        const addresses_container = document.getElementById('addresses-container');

        add_address_button.addEventListener('click', () => {
            const newAddressWrapper = document.createElement('div');
            newAddressWrapper.classList.add('with-trashbin');
            const addressContainer = document.createElement('div');
            addressContainer.classList.add('address-container');

            const addressInput = document.createElement('input');
            addressInput.type = 'text';
            addressInput.placeholder = '123 Any Street';
            addressInput.required = true;

            const countrySelect = document.createElement('select');
            countrySelect.name = 'country';
            countrySelect.classList.add("country");
            countrySelect.addEventListener('change', (event) => fetchStates(event)); // Add event listener
            countrySelect.innerHTML = `<option value="">---Country---</option>`;

            const stateSelect = document.createElement('select');
            stateSelect.name = 'state';
            stateSelect.classList.add("state");
            stateSelect.addEventListener('change', (event) => fetchCities(event)); // Add event listener
            stateSelect.innerHTML = `<option value="">---State---</option>`;

            const citySelect = document.createElement('select');
            citySelect.name = 'city';
            citySelect.classList.add("city");
            citySelect.innerHTML = `<option value="">---City---</option>`;

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                addresses_container.removeChild(newAddressWrapper);
            });

            // Append all elements to their respective containers
            addressContainer.appendChild(addressInput);
            addressContainer.appendChild(countrySelect);
            addressContainer.appendChild(stateSelect);
            addressContainer.appendChild(citySelect);
            newAddressWrapper.appendChild(addressContainer);
            newAddressWrapper.appendChild(trashIcon);
            // Append the new address wrapper to the addresses container
            addresses_container.appendChild(newAddressWrapper);

            // Populate the new country's dropdown
            fetchCountries(addressContainer);
        });
    </script>
    <!-- Dynamically add skills  -->
    <script>
        const add_skill_button = document.getElementById('add-skill-button');
        const skills_container = document.getElementById('skills-container');

        add_skill_button.addEventListener('click', () => {
            const newSkillWrapper = document.createElement('div');
            newSkillWrapper.classList.add('with-trashbin');
            const skillContainer = document.createElement('div');
            skillContainer.classList.add('skill-container');

            const skillInput = document.createElement('input');
            skillInput.type = 'text';
            skillInput.name = 'field';
            skillInput.placeholder = 'Your skill';

            const experienceInput = document.createElement('input');
            experienceInput.type = 'number';
            experienceInput.min = 1;
            experienceInput.name = 'start';
            experienceInput.placeholder = 'Years of experience';
            experienceInput.required = true;

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                skills_container.removeChild(newSkillWrapper);
            });

            skillContainer.appendChild(skillInput);
            skillContainer.appendChild(experienceInput);
            newSkillWrapper.appendChild(skillContainer);
            newSkillWrapper.appendChild(trashIcon);
            skills_container.appendChild(newSkillWrapper);
        });
    </script>
    <!-- Dynamically add educations  -->
    <script>
        const add_education_button = document.getElementById('add-education-button');
        const educations_container = document.getElementById('educations-container');

        add_education_button.addEventListener('click', () => {
            const newEducationWrapper = document.createElement('div');
            newEducationWrapper.classList.add('with-trashbin');
            const educationContainer = document.createElement('div');
            educationContainer.classList.add('education-container');

            const universityInput = document.createElement('input');
            universityInput.type = 'text';
            universityInput.name = 'university';
            universityInput.placeholder = 'University Name';
            universityInput.required = true;

            const degreeInput = document.createElement('input');
            degreeInput.type = 'text';
            degreeInput.name = 'degree';
            degreeInput.placeholder = 'Degree';
            degreeInput.required = true;

            const majorInput = document.createElement('input');
            majorInput.type = 'text';
            majorInput.name = 'major';
            majorInput.placeholder = 'Major';
            majorInput.required = true;

            const gpaInput = document.createElement('input');
            gpaInput.type = 'text';
            gpaInput.name = 'gpa';
            gpaInput.placeholder = 'GPA';
            gpaInput.required = true;

            const yearContainer = document.createElement('div');
            yearContainer.classList.add('year-container');

            const startYearInput = document.createElement('input');
            startYearInput.type = 'number';
            startYearInput.name = 'start';
            startYearInput.min = 1980;
            startYearInput.max = 2024;
            startYearInput.placeholder = 'Start Year';
            startYearInput.required = true;

            const endYearInput = document.createElement('input');
            endYearInput.type = 'number';
            endYearInput.name = 'end';
            endYearInput.min = 1980;
            endYearInput.max = 2024;
            endYearInput.placeholder = 'End Year';
            endYearInput.required = true;

            yearContainer.appendChild(startYearInput);
            yearContainer.appendChild(endYearInput);

            educationContainer.appendChild(universityInput);
            educationContainer.appendChild(majorInput);
            educationContainer.appendChild(degreeInput);
            educationContainer.appendChild(gpaInput);
            educationContainer.appendChild(yearContainer);

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                educations_container.removeChild(newEducationWrapper);
            });

            newEducationWrapper.appendChild(educationContainer);
            newEducationWrapper.appendChild(trashIcon);
            educations_container.appendChild(newEducationWrapper);
        });
    </script>
    <!-- Dynamically add experiences  -->
    <script>
        const add_experience_button = document.getElementById('add-experience-button');
        const experiences_container = document.getElementById('experiences-container');

        add_experience_button.addEventListener('click', () => {
            const newExperienceWrapper = document.createElement('div');
            newExperienceWrapper.classList.add('with-trashbin');
            const experienceContainer = document.createElement('div');
            experienceContainer.classList.add('experience-container');

            const jobInput = document.createElement('input');
            jobInput.type = 'text';
            jobInput.name = 'job';
            jobInput.placeholder = 'Job Title';
            jobInput.required = true;

            const companyInput = document.createElement('input');
            companyInput.type = 'text';
            companyInput.name = 'company';
            companyInput.placeholder = 'Company';
            companyInput.required = true;

            const employerInput = document.createElement('input');
            employerInput.type = 'text';
            employerInput.name = 'employer';
            employerInput.placeholder = 'Employer';
            employerInput.required = true;

            const yearContainer = document.createElement('div');
            yearContainer.classList.add('year-container');

            const startYearInput = document.createElement('input');
            startYearInput.type = 'number';
            startYearInput.name = 'start';
            startYearInput.placeholder = 'Start Year';
            startYearInput.min = 1980;
            startYearInput.max = 2024;
            startYearInput.required = true;

            const endYearInput = document.createElement('input');
            endYearInput.type = 'number';
            endYearInput.name = 'end';
            endYearInput.placeholder = 'End Year';
            endYearInput.min = 1980;
            endYearInput.max = 2024;
            endYearInput.required = true;

            yearContainer.appendChild(startYearInput);
            yearContainer.appendChild(endYearInput);

            const descriptionTextarea = document.createElement('textarea');
            descriptionTextarea.name = 'description';
            descriptionTextarea.placeholder = 'Description of responsibilities';
            descriptionTextarea.rows = 3;
            descriptionTextarea.required = true;

            experienceContainer.appendChild(jobInput);
            experienceContainer.appendChild(companyInput);
            experienceContainer.appendChild(employerInput);
            experienceContainer.appendChild(yearContainer);
            experienceContainer.appendChild(descriptionTextarea);

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                experiences_container.removeChild(newExperienceWrapper);
            });

            newExperienceWrapper.appendChild(experienceContainer);
            newExperienceWrapper.appendChild(trashIcon);
            experiences_container.appendChild(newExperienceWrapper);
        });
    </script>
    <!-- Dynamically add allowers  -->
    <script>
        const add_allower_button = document.getElementById('add-allower-button');
        const allowers_container = document.getElementById('allowers-container');

        add_allower_button.addEventListener('click', () => {
            const newAllowerWrapper = document.createElement('div');
            newAllowerWrapper.classList.add('with-trashbin');
            const allowerContainer = document.createElement('div');
            allowerContainer.classList.add('allower-container');

            const emailInput = document.createElement('input');
            emailInput.type = 'text';
            emailInput.name = 'field';
            emailInput.placeholder = 'Email...';

            allowerContainer.appendChild(emailInput);

            const trashIcon = document.createElement('ion-icon');
            trashIcon.name = 'trash';
            trashIcon.addEventListener('click', () => {
                allowers_container.removeChild(newAllowerWrapper);
            });

            newAllowerWrapper.appendChild(allowerContainer);
            newAllowerWrapper.appendChild(trashIcon);
            allowers_container.appendChild(newAllowerWrapper);
        });
    </script>

    <!-- Slideshow  -->
    <script>
        let slideIndex = 1;
        let color_list = ["#000", "#283618", "#9b2226", "#774936", "#343a40", "#003566"];
        // Create the list of dot
        let dot_container = document.getElementById("conDot");
        for (let i = 0; i < color_list.length; i++){
            let child = document.createElement("span");
            child.classList.add('dot');
            child.style.setProperty("--dot-color", color_list[i]);
            child.addEventListener('click',() => {currentSlide(i + 1)});
            dot_container.appendChild(child);
        }
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            // let slides = document.getElementsByClassName("mySlides");
            let slides = color_list;
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            // for (i = 0; i < slides.length; i++) {
            //     slides[i].style.display = "none";
            // }
            // for (i = 0; i < dots.length; i++) {
            //     dots[i].className = dots[i].className.replace(" active", "");
            // }
            // slides[slideIndex - 1].style.display = "block";
            // dots[slideIndex - 1].className += " active";
            document.getElementById("conRevCV").style.setProperty("--color", color_list[slideIndex - 1]);
        }
    </script>
    <!----------------------------------------------->
    
    

    <!-- Multilevel dependent dropdown menu  -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const geonamesUsername = "xitrumbumbum"; // Replace with your free GeoNames username

        let mapInitialized = false; // Flag to check if the map has been initialized

        async function fetchCountries(container) {
            try {
                const response = await fetch(`http://api.geonames.org/countryInfoJSON?username=${geonamesUsername}`);
                const data = await response.json();

                // Update only the country dropdown within the specified container
                const countrySelect = container.querySelector(".country");
                countrySelect.innerHTML = '<option value="">---Country---</option>';
                data.geonames.forEach(country => {
                    countrySelect.innerHTML += `<option value="${country.geonameId}">${country.countryName}</option>`;
                });
            } catch (error) {
                console.error("Error fetching countries:", error);
            }
        }

        async function fetchStates(event) {
            const container = event.target.closest(".address-container");
            const countrySelect = container.querySelector(".country");
            const stateSelect = container.querySelector(".state");
            const citySelect = container.querySelector(".city");

            stateSelect.innerHTML = '<option value="">---State---</option>';
            citySelect.innerHTML = '<option value="">---City---</option>';

            const countryId = countrySelect.value;
            if (!countryId) return;

            try {
                const response = await fetch(`http://api.geonames.org/childrenJSON?geonameId=${countryId}&username=${geonamesUsername}`);
                const data = await response.json();
                data.geonames.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.geonameId}">${state.name}</option>`;
                });
            } catch (error) {
                console.error("Error fetching states:", error);
            }
        }

        async function fetchCities(event) {
            const container = event.target.closest(".address-container");
            const stateSelect = container.querySelector(".state");
            const citySelect = container.querySelector(".city");

            citySelect.innerHTML = '<option value="">---City---</option>';

            const stateId = stateSelect.value;
            if (!stateId) return;

            try {
                const response = await fetch(`http://api.geonames.org/childrenJSON?geonameId=${stateId}&username=${geonamesUsername}`);
                const data = await response.json();
                data.geonames.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.lat},${city.lng}">${city.name}</option>`;
                });
            } catch (error) {
                console.error("Error fetching cities:", error);
            }
        }

        // Call fetchCountries for each address-container during initialization
        document.querySelectorAll(".address-container").forEach(container => {
            fetchCountries(container); // Pass each container individually
            // console.log("HUHU");
        });
    </script>

    <!-- Visibility -->
    <script>
        const selector = document.querySelector("#allowers-selector select");
        const allowersContainer = document.getElementById("allowers-container");
        const addButtonWrapper = document.querySelector(".Allowers .add-button-wrapper");

        // Initially hide the elements
        allowersContainer.style.display = "none";
        addButtonWrapper.style.display = "none";

        // Add an event listener for the change event
        selector.addEventListener("change", function() {
            if (selector.value === "3" && selector.options[selector.selectedIndex].text === "Specified") {
                // Show the elements when "Specified" is selected
                allowersContainer.style.display = "block";
                addButtonWrapper.style.display = "flex";
            } else {
                // Hide the elements otherwise
                allowersContainer.style.display = "none";
                addButtonWrapper.style.display = "none";
            }
        });
    </script>
    <!----------------------------------------------->
    <script>
        let title = "Untitled2";
        let name = "ABC John S";
        let job = "Random freelancer";
        let email = "example@gmail.com";
        let introduction = "Don't care";
        let other = "Nothing overhere";
        let ref_email = "cdf@example.com";
        let ref_phone = "012312415151";
        //number
        let phone = [{number: "12136229124"}];
        //home, country, state, city
        let address = [{home: "Beta 231 Green Street", country: "code", state: "code", city: "long lat"},
        
        ];
        //name, year
        let skill = [{name: "Super Engineer", year:1}, {name: "Gamer", year:2}];
        //university, major, degree, gpa, start_year, end_year
        let education = [{university: "Oxford", major: "English", degree: "Phd of Proficiency",  gpa:"3.6", start_year:"2000", end_year:"2004"},
        {university: "Oxford", major: "Japanese", degree: "Phd of Fluency", gpa:"4.0", start_year:"2000", end_year:"2004"}]; 
        //job, company, employer,  description, start_year, end_year,
        let experience = [{job: "Translator", company:"White House", employer: "Obama", description:"Translate for president", start_year:"2005", end_year:"2009"},
        {job: "Teacher", company:"Uni of Teaching", employer: "Principal A" ,description:"Create new teaching model. Teaching students", start_year:"2009", end_year:"2010", }]; 
        
        let password = "123";
        let color = "#283618";
        let access_level = 2;
        let allower = ["mail1@gmail.com"];
         
        const email_regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const phone_regex = /^\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/;
        
        
        //Check whether edit or not
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get("cvid")){
            let edit_xmtpp = new XMLHttpRequest();
            edit_xmtpp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    dataToForm(this.responseText);
                }
            }
            edit_xmtpp.open("GET", "php/add_logic.php?cvid=" + urlParams.get("cvid"), true);
            edit_xmtpp.send();
    
        }

        function dataToForm(json_data){
            let data = JSON.parse(json_data);
            title = data.title;
            name = data.name;
            job = data.job;
            email = data.email;
            introduction = data.introduction;
            other = data.other;
            ref_email = data.ref_email;
            ref_phone = data.ref_phone;

            phone = data.phone;
            address = data.address;
            skill = data.skill;
            education = data.education;
            experience = data.experience;

            password = data.password;
            color = data.color;
            access_level = data.access_level;
            allower = data.allower;

            document.getElementById("txtIntroduction").value = introduction;
            document.getElementById("txtName").value = name;
            document.getElementById("txtJob").value = job;
            document.getElementById("txtEmail").value = email;
            for (let i = 0; i < phone.length; i++){
                let ele = phone[i];
                document.getElementsByClassName("phone-container")[document.getElementsByClassName("phone-container").length - 1].children[0].value = ele.number;
                if (i != phone.length - 1){
                    document.getElementById("add-phone-button").click();
                }
            }
        
            for (let i = 0; i < skill.length; i++){
                let ele = skill[i];
                let input_container = document.getElementsByClassName("skill-container")[document.getElementsByClassName("skill-container").length - 1];
                input_container.children[0].value = ele.name;
                input_container.children[1].value = ele.year;
                if (i != skill.length - 1){
                    document.getElementById("add-skill-button").click();
                }
            }
            dataToAddress();
            for (let i = 0; i < education.length; i++){
                let ele = education[i];
                let input_container = document.getElementsByClassName("education-container")[document.getElementsByClassName("education-container").length - 1];
                input_container.children[0].value = ele.university;
                input_container.children[1].value = ele.degree ;
                input_container.children[2].value = ele.major;
                input_container.children[3].value = ele.gpa;
                input_container.children[4].children[0].value = ele.start_year;
                input_container.children[4].children[1].value = ele.end_year;
                if (i != education.length - 1){
                    document.getElementById("add-education-button").click();
                }
            }
            for (let i = 0; i < experience.length; i++){
                let ele = experience[i];
                let input_container = document.getElementsByClassName("experience-container")[document.getElementsByClassName("experience-container").length - 1];
                input_container.children[0].value = ele.job;
                input_container.children[1].value = ele.company ;
                input_container.children[2].value = ele.employer;
                input_container.children[3].children[0].value = ele.start_year;
                input_container.children[3].children[1].value = ele.end_year;
                input_container.children[4].value = ele.description;
                if (i != experience.length - 1){
                    document.getElementById("add-experience-button").click();
                }
            }


            //Optional section
            document.getElementById("txtRefEmail").value = ref_email;
            document.getElementById("txtRefPhone").value = ref_phone;
            document.getElementById("txtOther").value = other;

            //Additional Setting sectiosn.
            document.getElementById("txtTitle").value = title;
            document.getElementById("txtPassword").value = password;
            document.getElementById("selAccessLevel").value = access_level;
            if (access_level == 3){
                document.getElementById("allowers-container").style.display = "block";
                document.querySelector(".Allowers .add-button-wrapper").style.display = "flex";
                for (let i = 0; i < allower.length; i++){
                    document.getElementById("add-allower-button").click();
                }
                let input_container = document.getElementsByClassName("allower-container");
                for (let i = 0; i < allower.length; i++){
                    let ele = allower[i];
                    input_container[i].children[0].value = ele.email;
                }
            }

            //Input data to form and CV review
            dataToCV(json_data)
            color = document.getElementById("conRevCV").style.setProperty("--color", color);
            
            //Reveal all hidden contents from the start, change button text
            document.getElementById("conCVreview").style.display = "block";
            document.getElementById("conCreateCV").style.display = "flex";
            document.getElementById("conCreateCV").children[0].innerHTML = "Edit CV";

            
        }
        async function dataToAddress(){
            document.querySelector('.loading-screen').style.display = 'flex';
            for (let i = 0; i < address.length; i++){
                let ele = address[i];
                let input_container = document.getElementsByClassName("address-container")[document.getElementsByClassName("address-container").length - 1];   
                await fetchCountries(input_container);
                input_container.children[0].value = ele.home;
                input_container.children[1].value = ele.country;
                await fetchStates({target: input_container});
                input_container.children[2].value = ele.state;
                await fetchCities({target: input_container});
                input_container.children[3].value = ele.city;
                
                if (i != address.length - 1){
                    document.getElementById("add-address-button").click();
                }

            }
            document.querySelector('.loading-screen').style.display = 'none';
        }
        function validateInput(){
            let error_list = [];
            let input_component_list = [];
            //Check if introduction exist
            introduction = document.getElementById("txtIntroduction").value;
            if (!introduction){ 
                error_list.push("Introduction is required.");
            };

            //Check if name exist
            name = document.getElementById("txtName").value;
            if (!name){ 
                error_list.push("Name is required.");
            };
            
            //Check if job exist.
            job = document.getElementById("txtJob").value;
            if (!job){ 
                error_list.push("Current job is required.");
            };

            //Check if email is valid and exist
            email = document.getElementById("txtEmail").value;
            if (!email.toLowerCase().match(email_regex))
            {
                error_list.push("Email is not valid.");
            } else if (!email){
                error_list.push("Email is required.");
            };

            phone = [];
            input_component_list =  document.getElementsByClassName("phone-container");
            for (let i = 0; i < input_component_list.length; i++){ 
                let ele = input_component_list[i];
                let phone_number = ele.children[0].value;
                if (phone_number && phone_number.toLowerCase().match(phone_regex)){
                    phone.push({number: phone_number});
                } else {
                    error_list.push("A phone number entry has an invalid phone number.")
                    break;
                }
            }
            console.log(phone);

            //RECHECK whether country, state and city necessary
            address = [];
            input_component_list =  document.getElementsByClassName("address-container");
            for (let i = 0; i < input_component_list.length; i++){ 
                let ele = input_component_list[i];
                let address_home = ele.children[0].value;
                let country = ele.children[1].value;
                let state = ele.children[2].value;
                let city = ele.children[3].value;
                if (address_home){
                    address.push({home: address_home, country: country, state: state, city: city});
                } else {
                    error_list.push("An address entry is not fully filled or has an invalid number.")
                    break;
                }
            }
            console.log(address);
            
            skill = [];
            input_component_list =  document.getElementsByClassName("skill-container");
            for (let i = 0; i < input_component_list.length; i++){ 
                let ele = input_component_list[i];
                let skill_name = ele.children[0].value;
                let year = ele.children[1].value;
                if (skill_name && year){
                    skill.push({name: skill_name, year: year});
                } else {
                    error_list.push("An skill entry is not fully filled or has an invalid number.")
                    break;
                } 
            }
            console.log(skill);
            

            education = [];
            input_component_list = document.getElementsByClassName("education-container");
            for (let i = 0; i < input_component_list.length; i++){ 
                let ele = input_component_list[i];
                let uni = ele.children[0].value;
                let major = ele.children[1].value;
                let degree = ele.children[2].value;
                let gpa = ele.children[3].value;
                let start_year = ele.children[4].children[0].value;
                let end_year = ele.children[4].children[1].value;
                if (uni && degree && major && gpa && start_year && end_year){
                    let entry = {university: uni, major: major ,degree: degree, gpa: gpa, start_year: start_year, end_year: end_year};
                    education.push(entry);
                } else {
                    error_list.push("An education entry is not fully filled or has an invalid number.")
                    break;
                }
            }
            console.log(education);

            experience = [];
            input_component_list =  document.getElementsByClassName("experience-container");
            for (let i = 0; i < input_component_list.length; i++){ 
                let ele = input_component_list[i];
                let job = ele.children[0].value;
                let company = ele.children[1].value;
                let employer = ele.children[2].value;
                let start_year = ele.children[3].children[0].value;
                let end_year = ele.children[3].children[1].value;
                let description = ele.children[4].value;
                if (job && company && employer && description && start_year && end_year){
                    let entry = {job: job, company: company, employer: employer, description: description, start_year: start_year, end_year: end_year};
                    experience.push(entry);
                } else {
                    error_list.push("An experience entry is not fully filled or has an invalid number.")
                }
            }
            console.log(experience);

            title = document.getElementById("txtTitle").value ? document.getElementById("txtTitle").value : "Untitled";
            password = document.getElementById("txtPassword").value ? document.getElementById("txtPassword").value : "";
            color = "";

            other = document.getElementById("txtOther").value ? document.getElementById("txtOther").value : "";
            ref_email = document.getElementById("txtRefEmail").value ? document.getElementById("txtRefEmail").value : "";
            if (ref_email){
                if (!ref_email.toLowerCase().match(email_regex))
                {
                    error_list.push("Reference's email is not valid.");
                };
            }
            ref_phone = document.getElementById("txtRefPhone").value ? document.getElementById("txtRefPhone").value : "";
            if (ref_phone){
                if (!ref_phone.toLowerCase().match(phone_regex))
                {
                    error_list.push("Reference's phone is not a valid number.");
                };
            }

            access_level = document.getElementById("selAccessLevel").value;

            if (access_level == "3"){
                allower = [];
                input_component_list = document.getElementsByClassName("allower-container");
                console.log(input_component_list.length);
                for (let i = 0; i < input_component_list.length; i++){ 
                    let ele = input_component_list[i];
                    let allower_email = ele.children[0].value;
                    console.log(allower_email);
                    if (allower_email.toLowerCase().match(email_regex)){
                        if (allower_email){
                            allower.push(allower_email);
                        } 
                    } else {
                        error_list.push("Allower's email is not valid.");
                        break;
                    }
                }
                console.log(allower);
            }

            if (error_list.length > 0){
                document.getElementById("txtError").innerHTML = error_list.join("<br />");
                document.getElementById("conCVreview").style.display = "none";
                document.getElementById("conCreateCV").style.display = "none";
                console.log(error_list);
                return 1;
            } else {
                document.getElementById("txtError").innerHTML = "                   ";
                document.getElementById("conCVreview").style.display = "block";
                document.getElementById("conCreateCV").style.display = "flex";
                const data = {title: title, name: name, job: job, email: email,
                introduction: introduction, other: other, ref_email: ref_email, ref_phone: ref_phone,
                phone: phone, address: address, skill: skill, education: education, experience: experience,
                password: password, color: color, access_level: access_level, allower: allower
                }
                const json_data = JSON.stringify(data); 
                dataToCV(json_data);
                return 0;
            }
        }
        function sendInputToServer(){
            color = document.getElementById("conRevCV").style.getPropertyValue("--color");
            const data = {title: title, name: name, job: job, email: email,
                introduction: introduction, other: other, ref_email: ref_email, ref_phone: ref_phone,
                phone: phone, address: address, skill: skill, education: education, experience: experience,
                password: password, color: color, access_level: access_level, allower: allower, id: (urlParams.get("cvid")) ? urlParams.get("cvid") : ""
            }
            const json_data = JSON.stringify(data);
            let xmtpp = new XMLHttpRequest();
            xmtpp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    window.location.href = "index.php?page=myCVs";
                }
            }
            xmtpp.open("POST", "php/add_logic.php", true);
            xmtpp.setRequestHeader("Content-Type", "application/json");
            xmtpp.send(json_data);
        }
     
    </script>
</body>

</html>