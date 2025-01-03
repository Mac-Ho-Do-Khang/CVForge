<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="CVForge. Easily create, share, and manage professional CVs online. Jobseekers can build CVs using customizable templates or upload PDFs. Secure your profile with privacy options and share it with a unique URL." />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="content/img/fev-icon.png" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/register.css" />
    <script
        defer
        src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
    <!-- <script defer src="script.js"></script> -->
    <title>CVForge - Register</title>
</head>

<body>
    <header class="header">
        <a href="index.php?page=home" title="Return to home page">
            <img src="content/img/logo.png" class="logo" alt="Logo of CVForge, in which the letter F is replaced by a hammer shape" />
        </a>
        <nav class="header-nav">
            <ul class="header-nav-list">
                <li><a class="header-nav-link" href="index.php?page=home" title="Return to home page">Home</a></li>
                <li>
                    <a class="header-nav-link call-to-action" href="index.php?page=login" title="Go to login page">Login</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class="call-to-action" id="register">
        <div class="container">
            <div class="cta grid-container" style="--column: 2">
                <div class="cta-box">
                    <h2 class="subheading">
                        Start your journey with a simple sign-up.
                    </h2>
                    <p class="cta-text">
                        Take the first step toward your dream job. It's free and easy. Sign up in minutes. Showcase your skills for a lifetime.
                    </p>

                    <form action='php/add_account.php' class="cta-form" name="form" method="post">
                        <div
                            class="grid-container"
                            style="--column: 2; --c-gap: 3.2rem; --r-gap: 2.4rem">
                            <div>
                                <label for="email"> Email:</label>
                                <input
                                    type="email"
                                    id="email"
                                    name='email'
                                    placeholder="CVForge@example.com"
                                    required />
                            </div>
                            <div>
                                <label for="password"> Password:</label>
                                <input
                                    type="password"
                                    id="password"
                                    name='password'
                                    placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                                    required>
                            </div>
                            <div>
                                <label for="name"> Full name:</label>
                                <input name="name" type="text" id="name"
                                    placeholder="CVForge is here" required />
                            </div>
                            <!-- <div>
                                <label for="where">Select your role</label>
                                <select name="select" id="where" name="role" required>
                                    <option value="0">Choose one</option>
                                    <option value="1">Job seeker</option>
                                    <option value="2">Viewer</option>
                                </select>
                            </div> -->
                            <button class="btn btn-full">Sign up</button>
                            <div class="register-error">
                                <p></p>
                            </div>
                    </form>

                </div>
            </div>
            <div class="cta-img"></div>

        </div>
    </section>

</body>

</html>