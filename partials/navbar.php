<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>jamiafaizulquran || Home</title>

<link rel="icon" href="assets/img/Islamic Logo Design with Crescent Moon.png" type="image/png" />


    <!-- Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com/" />
    <link
      href="https://fonts.googleapis.com/css2?family=Abril+Fatface&amp;display=swap"
      rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.gstatic.com/" />
    <link
      href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&amp;display=swap"
      rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.gstatic.com/" />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      rel="stylesheet"
    />


    <!-- Css -->
    <link rel="stylesheet" href="assets/css/animate.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/css/magnific-popup.css" />
    <!-- Removed fontawesome-all.min.css (FA5) -->

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@6.8.4/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="assets/css/jarallax.css" />
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="assets/css/vegas.min.css" />
    <link rel="stylesheet" href="assets/css/nouislider.min.css" />
    <link rel="stylesheet" href="assets/css/nouislider.pips.css" />
    <link rel="stylesheet" href="assets/css/asting.css" />

    <!-- ✅ Font Awesome 4.7.0 -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <!-- Template styles -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
     <style>
        .hp-wrap{
  position:absolute;
  left:-10000px; top:auto;
  width:1px; height:1px; overflow:hidden;
}

    </style>
  </head>
  <body>
    <div class="page-wrapper">
      <div class="site-header__header-one-wrap clearfix">
        <div class="container">
          <div class="site-header__logo-box float-left">
            <div class="site-header__logo">
              <a href="index.html"
                ><img
                  src="assets/img/Islamic Logo Design with Crescent Moon.png"
                  alt=""
                  style="height: 70px"
              /></a>
            </div>
          </div>

          <header class="main-nav__header-one">
            <div class="main-nav__header-one__top clearfix">
              <div class="main-nav__header-one__top-left">
                <ul class="list-unstyled">
                  <li>
                    <div class="icon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <div class="text">
                      <p><a href="tel:92 310 1002018">+92 310 1002018</a></p>
                    </div>
                  </li>
                  <li>
                    <div class="icon">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <div class="text">
                      <p>
                        <a href="mailto:info@jamiafaizulquran.com"
                          >info@jamiafaizulquran.com</a
                        >
                      </p>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="main-nav__header-one__top-right">
                <div class="main-nav__header-one__top-social">
                  <a href="#"><i class="fa fa-facebook-square"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-instagram"></i></a>
                  <a href="#"><i class="fa fa-dribbble"></i></a>
                </div>
              </div>
            </div>
            <nav class="header-navigation stricky">
              <div class="container clearfix">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="main-nav__left main-nav__left-one float-left">
                  <a href="#" class="side-menu__toggler">
                    <i class="fa fa-bars"></i>
                  </a>
                  <?php
                    // Get the current page name without query string
                    $current_page = basename($_SERVER['REQUEST_URI']); 
                    ?>
                  <div class="main-nav__main-navigation clearfix">
                   <ul class="main-nav__navigation-box float-left">
                        <li class="dropdown <?php echo ($current_page == 'index' || $current_page == '') ? 'current' : ''; ?>">
                            <a href="/index">Home</a>
                        </li>
                        <li class="dropdown <?php echo ($current_page == 'about') ? 'current' : ''; ?>">
                            <a href="/about">About Us</a>
                        </li>
                        <li class="dropdown <?php echo ($current_page == 'donations') ? 'current' : ''; ?>">
                            <a href="/donations">Donations</a>
                        </li>
                        <li class="dropdown <?php echo ($current_page == 'supportourmsdjid') ? 'current' : ''; ?>">
                            <a href="/supportourmsdjid">Support Our Masjid</a>
                        </li>
                        <li class="<?php echo ($current_page == 'contact') ? 'current' : ''; ?>">
                            <a href="/contact">Contact</a>
                        </li>
                    </ul>
                  </div>
                  <!-- /.navbar-collapse -->
                </div>
                <div class="main-nav__right main-nav__right-one float-right">
                  <div class="main-nav__right__btn-one">
                    <a href="/donations"
                      ><i class="fa fa-heart"></i>Donate</a
                    >
                  </div>
                </div>
              </div>
            </nav>
          </header>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none">
        <a class="navbar-brand" href="#">jamiafaizulquran</a>

        <!-- Toggler (sirf mobile par dikhega) -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/index">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/about">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/donations">Donations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/supportourmsdjid"
                >Support Our Masjid</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/contact">Contact</a>
            </li>
          </ul>
        </div>
      </nav>