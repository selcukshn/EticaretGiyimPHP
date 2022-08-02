<?php
require_once("init.php");

use session\session;

if (session::have_session("User")) {
    $User = $db->select("Name,Surname,Email,Phone", "user")->where("Email=?", [session::get_session("User")])->get_row();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo isset($title) ? $title : "Şahin Giyim" ?></title>
    <link href="<?php echo URL ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo URL ?>/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo URL ?>/css/price-range.css" rel="stylesheet">
    <link href="<?php echo URL ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL ?>/css/main.css" rel="stylesheet">
    <link href="<?php echo URL ?>/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo URL ?>/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo URL ?>/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo URL ?>/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo URL ?>/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo URL ?>/images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="<?php echo URL ?>"><img src="<?php echo URL ?>/images/home/logo.png" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-star"></i> İstek listem</a></li>
                                <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Sepet</a></li>
                                <?php
                                if (isset($User)) { ?>
                                    <li><a href="<?php echo URL ?>/admin/" target="_blank"><i class="fa fa-user"></i> Admin</a></li>
                                    <li><a href="#"><i class="fa fa-user"></i> Hesabım</a></li>
                                    <li><a href="<?php echo URL ?>/logout.php"><i class="fa fa-sign-out"></i>Çıkış yap</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo URL ?>/login.php"><i class="fa fa-lock"></i> Giriş yap</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="<?php echo URL ?>" class="active">Anasayfa</a></li>
                                <li><a href="#">Kadın</a></li>
                                <li><a href="#">Erkek</a></li>
                                <!-- <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                        <li><a href="product-details.html">Product Details</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
                                        <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> -->
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contact-us.html">İletişim</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Ara" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->