<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Title -->
    <title>Samtab</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>assets/webpage/favicon/favicon-32x32.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/css/bootstrap.min.css">
    
    <!-- Font awesome CSS --> 
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/css/font-awesome.min.css">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/css/animate.min.css">
    
    <!-- OwlCarousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/css/owl.carousel.css">
    
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/flaticon/flaticon.css">
    
    <!-- SlickNav CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/css/slicknav.min.css">
    
    <!-- Featherlight  CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/css/featherlight.css">
    
    <!-- Featherlight Gallery CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/css/featherlight.gallery.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/css/style.css">
    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/webpage/css/responsive.css">
	
    <script src="<?php echo base_url();?>assets/webpage/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>/assets/commonargalon.js"></script>

</head>
<body>
    
    
    
    
    <!-- Header Area Start -->
    <header class="bleezy-header-area">
        <div class="header-right-overlay"></div>
        <div class="mobile-top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p><a href="#">Login</a></p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="cart-top-menu">
                            <div class="login dropdown">
                                <a href="#" class="dropdown-toggle cart-icon" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                   <i class="fa fa-shopping-bag"></i> Cart(02)
                                </a>
                                <div class="dropdown-menu cart-dropdown" aria-labelledby="dropdownMenu2">
                                    <h3>Recently added item(s)</h3>
                                    <ul>
                                        <li>
                                            <div class="cart-btn-product">
                                                <a class="product-remove" href="#">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                <div class="cart-btn-pro-img">
                                                    <a href="#">
                                                        <img src="<?php echo base_url();?>assets/webpage/img/pro.png" alt="product" />
                                                    </a>
                                                </div>
                                                <div class="cart-btn-pro-cont">
                                                    <h4><a href="#">Wireless IP Camera</a></h4>
                                                    <span class="item-cat">
                                                        1x$30.00
                                                    </span>
                                                    <span class="price">
                                                        $30.00
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="cart-btn-product">
                                                <a class="product-remove" href="#">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                <div class="cart-btn-pro-img">
                                                    <a href="#">
                                                        <img src="<?php echo base_url();?>assets/webpage/img/pro-2.png" alt="product" />
                                                    </a>
                                                </div>
                                                <div class="cart-btn-pro-cont">
                                                    <h4><a href="#">Door Lock System</a></h4>
                                                    <span class="item-cat">
                                                        1x$130.00
                                                    </span>
                                                    <span class="price">
                                                        $130.00
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="cart-btn">
                                        <a href="#" class="cart-btn-1">View Cart</a>
                                        <a href="#" class="cart-btn-2">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="site-logo">
                        <a href="">
                            <img src="<?php echo base_url();?>assets/webpage/img/site-logo.png" alt="site logo" />
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="header-right">
                        <div class="header-right-top">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="single-top-right">
                                        <p>Call Us: <a href="#">(+91) 123456789</a></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="single-top-right">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="single-top-right">
                                        <p class="right-float"><a href="#">Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-container">
                            <div class="row">
                                <div class="col-md-11 col-sm-11">
                                    <!-- Responsive Menu -->
                                    <div class="bleezy-responsive-menu"></div>
                                    <!-- Responsive Menu -->
                                    <div class="mainmenu">
                                        <nav>
                                            <ul id="bleezy_navigation">
                                                <li class="current-page-item"><a href="">Home</a></li>
                                                <li><a href="">How it work</a></li>
                                                <li><a href="">Features</a></li>
                                                <li><a href="">Blog</a></li>
                                                <li><a href="">Contact</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->
    