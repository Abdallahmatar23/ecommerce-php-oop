<?php

use App\Core\Session\Session;
?>
<!doctype html>
<html class="no-js" lang="en">

<!--   03:20:39 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Drophut - Single Product eCommerce Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL ?>assets/store/assets/img/favicon.ico">

    <!-- CSS 
    ========================= -->


    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/store/assets/css/plugins.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/store/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/store/assets/css/custom.css">

</head>

<body>

    <!--header area start-->
    <!--Offcanvas menu area start-->
    <div class="off_canvars_overlay">

    </div>

    <!--Offcanvas menu area end-->

    <header>
        <div class="main_header">
            <!--header top start-->
            <div class="header_top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="support_info">
                                <p>Email: <a href="<?= BASE_URL ?>mailto:">support@drophunt.com</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="top_right text-right">
                                <ul>
                                    <li><a href="<?= BASE_URL ?>page/my-account ">Account</a></li>
                                    <li><a href="<?= BASE_URL ?>page/checkout ">Checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--header top start-->
            <!--header middel start-->
            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="logo">
                                <a href="<?= BASE_URL ?>home"><img src="assets/store/assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-6">
                            <div class="middel_right">
                                <div class="search_container">
                                    <form action="#">
                                        <div class="search_box">
                                            <input placeholder="Search product..." type="text">
                                            <button type="submit">Search</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="middel_right_info">

                                    <?php if (Session::check('user')) : ?>
                                        <div class="header_wishlist">
                                            <a href="<?= BASE_URL ?>my-account"><img src="assets/img/user.png" alt=""></a>
                                        </div>
                                        <div class="header_wishlist">
                                            <a class="button" href="<?= BASE_URL ?>auth/logout">Logout</a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mini_cart_wrapper">
                                        <a href="javascript:void(0)"><img src="<?= BASE_URL ?>assets/store/assets/img/shopping-bag.png" alt=""></a>
                                        <span class="cart_quantity"><?= $totalQty ?></span>
                                        <!--mini cart-->
                                        <div class="mini_cart">
                                           

                                            <?php if (isset($cart_items)): ?>

                                                <?php foreach ($cart_items as $cart_item):  ?>
                                                    <div class="cart_item">
                                                        <div class="cart_img">
                                                            <a href="#"><img src="<?= BASE_URL ?><?= $cart_item->getProduct()->getImage() ?>" alt=""></a>
                                                        </div>
                                                        <div class="cart_info">
                                                            <a href="#"><?= $cart_item->getProduct()->getName() ?></a>
                                                            <p>Qty: <?= $cart_item->getQty() ?> X <span> $<?= $cart_item->getProduct()->getPrice() ?> </span></p>
                                                        </div>
                                                        <div class="cart_remove">
                                                            <a href="#"><i class="ion-android-close"></i></a>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>



                                                <div class="mini_cart_table">
                                                    <div class="cart_total">
                                                        <span>Sub total:</span>
                                                        <span class="price">$<?= $total ?></span>
                                                    </div>
                                                    <div class="cart_total mt-10">
                                                        <span>total:</span>
                                                        <span class="price">$<?= $total ?></span>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <h4 class="text-center bg-warning m-2 p-2"> cart is not exists</h4>
                                            <?php endif; ?>

                                            <div class="mini_cart_footer">
                                                <div class="cart_button">
                                                    <a href="<?= BASE_URL ?>page/cart">View cart</a>
                                                </div>
                                                <div class="cart_button">
                                                    <a href=" <?= BASE_URL ?>page/checkout">Checkout</a>
                                                </div>

                                            </div>

                                        </div>

                                        <!--mini cart end-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--header middel end-->
            <!--header bottom satrt-->
            <div class="main_menu_area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="main_menu menu_position">
                                <nav>
                                    <ul>
                                        <li><a href="<?= BASE_URL ?>home">home</a></li>
                                        <li><a href="<?= BASE_URL ?>product-details">Product</a></li>

                                        <li><a class="active" href="<?= BASE_URL ?>#">pages <i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                <li><a href="<?= BASE_URL ?>page/about">About Us</a></li>
                                                <li><a href="<?= BASE_URL ?>page/contact">contact</a></li>
                                                <li><a href="<?= BASE_URL ?>page/privacy-policy">privacy policy</a></li>
                                                <li><a href="<?= BASE_URL ?>page/faq">Frequently Questions</a></li>
                                                <li><a href="<?= BASE_URL ?>login">login</a></li>
                                                <li><a href="<?= BASE_URL ?>register">register</a></li>
                                                <li><a href="<?= BASE_URL ?>page/forget-password">Forget Password</a></li>
                                                <li><a href="<?= BASE_URL ?>404">Error 404</a></li>
                                                <li><a href="<?= BASE_URL ?>page/cart">cart</a></li>
                                                <li><a href="<?= BASE_URL ?>page/tracking">tracking</a></li>
                                                <li><a href="<?= BASE_URL ?>page/checkout">checkout</a></li>
                                            </ul>
                                        </li>
                                        <!-- <li><a  href="<?= BASE_URL ?>blog">blog<i class="fa fa-angle-down"></i></a>
                                            <ul class="sub_menu pages">
                                                <li><a  href="<?= BASE_URL ?>blog">blog</a></li>
                                                <li><a  href="<?= BASE_URL ?>blog-details">blog details</a></li>
                                            </ul>
                                        </li> -->
                                        <li><a href="<?= BASE_URL ?>contact"> Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--header bottom end-->
        </div>
    </header>
    <!--header area end-->