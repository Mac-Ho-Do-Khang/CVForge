<?php 
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = "guest";
}
?>
<!-- Change the value to view the page as different roles, as specified in line 41 -->

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
  <link rel="stylesheet" href="css/style.css" />
  <script
    defer
    src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"></script>
  <title>CVForge - CV creator</title>
  <script
    type="module"
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script
    nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
  <section class="hero-section">
    <div class="dark">
      <header class="header">
        <a href="index.php?page=home" title="Return to home page"><img src="content/img/logo.png" class="logo" alt="Logo of CVForge, in which the letter F is replaced by a hammer shape" /></a>
        <nav class="header-nav">
          <ul class="header-nav-list">
            <li><a class="header-nav-link" href="index.php?page=home" title="Return to home page">Home</a></li>

            <?php if ($_SESSION['user'] == "jobseeker"): ?> <!----- Header when logged in as a jobseeker ----->
              <li><a class="header-nav-link" href="index.php?page=myCVs" title="Go to view CVs">My CVs</a></li>
              <li><a class="header-nav-link" href="index.php?page=add" title="Go to add CVs">Add CV</a></li>
              <!-- <li><a class="header-nav-link" href="index.php?page=viewCVs" title="Go to view CVs">View CVs</a></li> -->
              <div class="user-info">
                <ion-icon class="user-icon" name="person-circle"></ion-icon>
                <div class="info">
                  <p><?php echo $_SESSION['user']; ?></p>
                  <p><?php echo $_SESSION['email'] ?></p>
                  <!-- Log out button -->
                  <form action="index.php?page=login" method="post" style="display: inline;">
                    <input type="submit" value="Log out" class="logout-btn" />
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                      session_unset();
                      session_destroy();
                      header('Location: index.php?page=login');
                      exit();
                    }
                    ?>
                  </form>
                </div>
              </div>

            <?php else: ?> <!----- Header when not logged in------>
              <li><a class="header-nav-link" href="index.php?page=login" title="Go to login page">Login</a></li>
              <li>
                <a href="index.php?page=register" class="header-nav-link call-to-action" title="Go to register page">Sign up</a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
      </header>
    </div>
    <div class="header-container">
      <div class="header-container-inner">
        <h1 class="heading">Your career, your story, your identity, your CV</h1>
        <p class="hero-description">
          Post your CV online with ease. Let employers find you anywhere, anytime. Tailored to your personal
          preferences and need.
        </p>
        <a href="#" class="gradient-box-shadow">Start now</a>
      </div>
    </div>

    <div class="featured-in">
      <div class="container">
        <div class="logos">
          <img src="content/img/logos/business-insider.png" alt="Logo of Business Insider" />
          <img src="content/img/logos/forbes.png" alt="Logo of Forbes" />
          <img src="content/img/logos/techcrunch.png" alt="Logo of Techcrunch" />
          <img src="content/img/logos/the-new-york-times.png" alt="Logo of The New York Times" />
          <img src="content/img/logos/usa-today.png" alt="Logo of USA Today" />
        </div>
      </div>
    </div>
  </section>

  <section class="CVs" id="products">
    <div class="container">
      <span class="supheading">Samples</span>
      <h2 class="subheading">
        CVForge has created 5,000+ CVs
      </h2>
    </div>
    <div
      class="container grid-container"
      style="
            --column: 3;
            --r-gap: 9.6rem;
            --c-gap: 5rem;
            --m-bottom: 2.4rem;
          ">
      <div class="CV-img">
        <img src="content/img/samples/sample-CV-1.png" alt="First sample CV of color grey" />
      </div>
      <div class="categories">
        <h3 class="subsubheading">
          CVForge works with many kinds of CVs
        </h3>
        <ul class="list">
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Simple CV creation</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Customizable colors</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Secure data storage</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Shareable CV links
            </span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>PDF upload option</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Quick URL generation</span>
          </li>
          <li class="item">
            <ion-icon class="CV-icon" name="checkmark"></ion-icon>
            <span>Fast CV updates
            </span>
          </li>
        </ul>
      </div>
      <div class="CV-img">
        <img src="content/img/samples/sample-CV-2.png" alt="Second sample CV of color dark blue" />
      </div>
  </section>

  <section class="testimonial-container">
    <h3 class="supheading">Testimonial</h3>
    <h2 class="subheading">
      Hear from our customers
    </h2>
    <div
      class="testimonials grid-container"
      style="--column: 3; --row: 2; --r-gap: 1.6rem; --c-gap: 1.6rem">
      <div class="testimonial-first-img-wrapper">
        <img
          class="testimonial-first-img"
          src="content/img/customers/customer-alice.jpg" alt="Our first testimonials providers, Alice" />
      </div>
      <figure class="testimonial-first-text">
        <blockquote class="testimonial-text">
          "This platform made creating and sharing my CV incredibly easy! The intuitive design and user-friendly interface allowed me to build a professional-looking resume in no time. Plus, the ability to generate a shareable link has been a huge help when applying for jobs. I highly recommend it to anyone looking to streamline their job search!"
        </blockquote>
        <p class="testimonial-author">Alice Palmer</p>
        <p class="testimonial-author-job">CEO, Pérez-Liorca</p>
      </figure>
      <figure class="testimonial-part">
        <blockquote class="testimonial-text">
          "I was impressed with how secure and reliable this website is. This platform truly caters to all my career needs."
        </blockquote>
        <div class="testimonial-author-detail">
          <img
            class="testimonial-img"
            src="content/img/customers/customer-ben.jpg" alt="Our second testimonials providers, Ben" />
          <p class="testimonial-author">Ben Adams</p>
          <p class="testimonial-author-job">Customer, Arazo & Reda</p>
        </div>
      </figure>
      <figure class="testimonial-part">
        <blockquote class="testimonial-text">
          "I can update my CV at any time and highlight my achievements without hassle. It's everything a jobseeker could ask for!"
        </blockquote>
        <div class="testimonial-author-detail">
          <img
            class="testimonial-img"
            src="content/img/customers/customer-hannah.jpg" alt="Our third testimonials providers, Hannah" />
          <p class="testimonial-author">Hannah Wallace</p>
          <p class="testimonial-author-job">Customer, Pérez-Liorca</p>
        </div>
      </figure>
      <figure class="testimonial-part">
        <blockquote class="testimonial-text">
          "This website is a lifesaver for jobseekers like me! It is so easy to create and manage my CV, which is an absolute convenience!"
        </blockquote>
        <div class="testimonial-author-detail">
          <img
            class="testimonial-img"
            src="content/img/customers/customer-steve.jpg" alt="Our fourth testimonials providers, Steve" />
          <p class="testimonial-author">Steve Solaris</p>
          <p class="testimonial-author-job">Customer</p>
        </div>
      </figure>
    </div>
  </section>

  <section class="accordion-section container">
    <h3 class="supheading">FAQs</h3>
    <h2 class="subheading">
      Frequently asked questions
    </h2>
    <div class="accordions">
      <div class="accordion-item">
        <p class="accordion-number">01</p>
        <p class="accordion-text">How do I create a CV on this website?</p>
        <ion-icon name="chevron-forward-outline" class="accordion-chevron-forward"></ion-icon>
        <div class="accordion-hidden-box">
          <p>
            Creating a CV is simple and user-friendly. Follow these steps to get started:
          </p>
          <ul>
            <li>Click on the "Create CV" button on the homepage.</li>
            <li>Fill out the form with your personal details, education, skills, and experience.</li>
            <li>(Optional) Upload a PDF version of your CV if you already have one.</li>
            <li>Save your CV to generate a unique URL for sharing.</li>
          </ul>
        </div>
      </div>

      <div class="accordion-item open">
        <p class="accordion-number">02</p>
        <p class="accordion-text">Can I update my CV after posting it?</p>
        <ion-icon name="chevron-down-outline" class="accordion-chevron-down"></ion-icon>
        <div class="accordion-hidden-box">
          <p>
            Yes, you can edit your CV anytime to keep it up-to-date. Simply:
          </p>
          <ul>
            <li>Log in to your account and go to the "My CVs" section.</li>
            <li>Select the CV you wish to update.</li>
            <li>Make the necessary changes and save them.</li>
            <li>The changes will automatically reflect on your shared CV URL.</li>
          </ul>
        </div>
      </div>


      <div class="accordion-item">
        <p class="accordion-number">03</p>
        <p class="accordion-text">Is my CV visible to everyone?</p>
        <ion-icon name="chevron-forward-outline" class="accordion-chevron-forward"></ion-icon>
        <div class="accordion-hidden-box">
          <p>
            No, you control who can view your CV. We offer multiple privacy options:
          </p>
          <ul>
            <li>Public: Anyone with the CV URL can view your profile.</li>
            <li>Private: Only authenticated viewers with permission can access your CV.</li>
            <li>Password-protected: Share a password alongside the CV URL for added security.</li>
          </ul>
        </div>
      </div>

      <div class="accordion-item">
        <p class="accordion-number">04</p>
        <p class="accordion-text">What happens when I upload a PDF version of my CV?</p>
        <ion-icon name="chevron-forward-outline" class="accordion-chevron-forward"></ion-icon>
        <div class="accordion-hidden-box">
          <p>
            When you upload a PDF CV:
          </p>
          <ul>
            <li>It gets securely stored in our database.</li>
            <li>Viewers accessing your profile can download the PDF for reference.</li>
            <li>You can still add extra details using the form if needed.</li>
          </ul>
        </div>
      </div>
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

  <!-- To be seperated  -->
  <script>
    const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
      const icon = item.querySelector('ion-icon');
      icon.addEventListener('click', () => {
        // Toggle 'open' class on accordion item
        item.classList.toggle('open');

        // Toggle icon attributes
        if (item.classList.contains('open')) {
          icon.setAttribute('name', 'chevron-down-outline');
          icon.classList.remove('accordion-chevron-forward');
          icon.classList.add('accordion-chevron-down');
        } else {
          icon.setAttribute('name', 'chevron-forward-outline');
          icon.classList.remove('accordion-chevron-down');
          icon.classList.add('accordion-chevron-forward');
        }
      });
    });
  </script>
</body>

</html>