<?php
/**
 * Store Header — Refactored
 *
 * Variables available from Controller::view() via Controller::loadCart():
 *   $cart_items  array<CartItem>  (may be empty)
 *   $totalQty    int
 *   $total       float
 *
 * Session shape: ['id' => int, 'role' => string]
 */

use App\Core\Session\Session;

$isLoggedIn = Session::check('user');
$isAdmin    = $isLoggedIn && (Session::get('user')['role'] !== 'user');

// Active-link helper — marks the current page
$currentUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$currentUri = str_replace('ecommerce/public/', '', $currentUri);

function navActive(string $segment, string $current): string {
    return str_starts_with($current, $segment) ? 'active' : '';
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Drophut — eCommerce Store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon"
          href="<?= BASE_URL ?>assets/store/assets/img/favicon.ico">

    <!-- Store CSS -->
    <link rel="stylesheet"
          href="<?= BASE_URL ?>assets/store/assets/css/plugins.css">
    <link rel="stylesheet"
          href="<?= BASE_URL ?>assets/store/assets/css/style.css">
    <link rel="stylesheet"
          href="<?= BASE_URL ?>assets/store/assets/css/custom.css">

    <!--
        Ionicons is already bundled inside plugins.css in the original template.
        Font Awesome is also bundled. No extra CDN requests needed.
        If they are NOT bundled, uncomment the lines below:

        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    -->

    <style>
        /* ── Inline fixes that belong in custom.css eventually ────────────── */

        /* Prevent layout shift when mini-cart is empty */
        .mini_cart { min-width: 280px; }

        /* Cart badge */
        .cart_quantity {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #e23;
            color: #fff;
            border-radius: 50%;
            font-size: 11px;
            width: 18px;
            height: 18px;
            line-height: 18px;
            text-align: center;
            font-weight: 700;
        }
        .mini_cart_wrapper { position: relative; }

        /* Active nav link */
        .main_menu nav ul li > a.active,
        .offcanvas_main_menu li > a.active { color: #e23; font-weight: 700; }

        /* Offcanvas user info */
        .offcanvas-user-area {
            padding: 12px 20px;
            border-top: 1px solid #eee;
            margin-top: 10px;
        }
        .offcanvas-user-area a {
            display: block;
            padding: 6px 0;
            color: #333;
            font-size: 14px;
            text-decoration: none;
        }
        .offcanvas-user-area a:hover { color: #e23; }

        /* Mini-cart empty state */
        .mini_cart .cart_empty {
            padding: 20px;
            text-align: center;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- =====================================================================
     OFFCANVAS OVERLAY
====================================================================== -->
<div class="off_canvars_overlay"></div>

<!-- =====================================================================
     OFFCANVAS MENU (mobile)
====================================================================== -->
<div class="Offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Toggle open button (rendered inside header below,
                     but the overlay + close button live here) -->
                <div class="canvas_open">
                    <a href="javascript:void(0)">
                        <i class="ion-navicon"></i>
                    </a>
                </div>

                <div class="Offcanvas_menu_wrapper">

                    <!-- Close -->
                    <div class="canvas_close">
                        <a href="javascript:void(0)">
                            <i class="ion-android-close"></i>
                        </a>
                    </div>

                    <!-- Support line -->
                    <div class="support_info">
                        <p>Support: <a href="mailto:support@drophunt.com">support@drophunt.com</a></p>
                    </div>

                    <!-- Auth links (top of offcanvas) -->
                    <div class="top_right text-right">
                        <ul>
                            <?php if ($isLoggedIn): ?>
                                <li><a href="<?= BASE_URL ?>order/myOrders">My Orders</a></li>
                                <li><a href="<?= BASE_URL ?>auth/logout">Logout</a></li>
                            <?php else: ?>
                                <li><a href="<?= BASE_URL ?>login">Login</a></li>
                                <li><a href="<?= BASE_URL ?>register">Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Main offcanvas nav -->
                    <div id="menu" class="text-left">
                        <ul class="offcanvas_main_menu">

                            <li>
                                <a class="<?= navActive('home', $currentUri) ?>"
                                   href="<?= BASE_URL ?>home">Home</a>
                            </li>

                            <li>
                                <a class="<?= navActive('product', $currentUri) ?>"
                                   href="<?= BASE_URL ?>product/index">Shop</a>
                            </li>

                            <li>
                                <a class="<?= navActive('page/cart', $currentUri) ?>"
                                   href="<?= BASE_URL ?>page/cart">
                                    Cart
                                    <?php if ($totalQty > 0): ?>
                                        <span style="background:#e23;color:#fff;border-radius:50%;
                                                     padding:1px 6px;font-size:11px;margin-left:4px;">
                                            <?= $totalQty ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">Pages <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="<?= BASE_URL ?>page/about">About Us</a></li>
                                    <li><a href="<?= BASE_URL ?>page/contact">Contact Us</a></li>
                                    <li><a href="<?= BASE_URL ?>page/checkout">Checkout</a></li>
                                    <li><a href="<?= BASE_URL ?>login">Login</a></li>
                                    <li><a href="<?= BASE_URL ?>register">Register</a></li>
                                    <li><a href="<?= BASE_URL ?>page/forget-password">Forgot Password</a></li>
                                </ul>
                            </li>

                            <li>
                                <a class="<?= navActive('page/contact', $currentUri) ?>"
                                   href="<?= BASE_URL ?>page/contact">Contact Us</a>
                            </li>

                            <?php if ($isAdmin): ?>
                                <li>
                                    <a href="<?= BASE_URL ?>admin/index">Admin Dashboard</a>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </div><!-- /#menu -->

                    <!-- Offcanvas footer socials -->
                    <div class="Offcanvas_footer">
                        <span>
                            <a href="mailto:support@drophunt.com">
                                <i class="fa fa-envelope-o"></i> support@drophunt.com
                            </a>
                        </span>
                        <ul>
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>

                </div><!-- /.Offcanvas_menu_wrapper -->
            </div>
        </div>
    </div>
</div><!-- /.Offcanvas_menu -->


<!-- =====================================================================
     MAIN HEADER
====================================================================== -->
<header>
    <div class="main_header">

        <!-- ── Header Top Bar ─────────────────────────────────────────── -->
        <div class="header_top">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-md-6">
                        <div class="support_info">
                            <p>
                                <i class="fa fa-envelope-o" style="margin-right:4px;"></i>
                                <a href="mailto:support@drophunt.com">support@drophunt.com</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="top_right text-right">
                            <ul>
                                <?php if ($isLoggedIn): ?>
                                    <?php if ($isAdmin): ?>
                                        <li>
                                            <a href="<?= BASE_URL ?>admin/index">
                                                <i class="fa fa-tachometer" style="margin-right:4px;"></i>
                                                Dashboard
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <a href="<?= BASE_URL ?>order/myOrders">
                                            <i class="fa fa-list-alt" style="margin-right:4px;"></i>
                                            My Orders
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL ?>auth/logout">
                                            <i class="fa fa-sign-out" style="margin-right:4px;"></i>
                                            Logout
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="<?= BASE_URL ?>login">
                                            <i class="fa fa-sign-in" style="margin-right:4px;"></i>
                                            Login
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL ?>register">
                                            <i class="fa fa-user-plus" style="margin-right:4px;"></i>
                                            Register
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?= BASE_URL ?>page/checkout">
                                        <i class="fa fa-credit-card" style="margin-right:4px;"></i>
                                        Checkout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- /.header_top -->


        <!-- ── Header Middle (Logo + Cart) ───────────────────────────── -->
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">

                    <!-- Logo -->
                    <div class="col-lg-3 col-md-5 col-sm-6 col-6">
                        <div class="logo">
                            <a href="<?= BASE_URL ?>home">
                                <img src="<?= BASE_URL ?>assets/store/assets/img/logo/logo.png"
                                     alt="Drophut">
                            </a>
                        </div>
                    </div>

                    <!-- Search + Cart icons -->
                    <div class="col-lg-9 col-md-7 col-sm-6 col-6">
                        <div class="middel_right">

                            <!--
                                SEARCH: no backend search route exists yet.
                                The form is kept for UX, but submits nowhere.
                                To enable: add a ProductController::search() method
                                and point action to BASE_URL . 'product/search'.
                            -->
                            <div class="search_container">
                                <form action="#" method="GET">
                                    <div class="search_box">
                                        <input placeholder="Search products…" type="text" name="q"
                                               title="Search is not yet implemented">
                                        <button type="submit">Search</button>
                                    </div>
                                </form>
                            </div>

                            <div class="middel_right_info">

                                <!-- Account icon (only when logged in) -->
                                <?php if ($isLoggedIn): ?>
                                    <div class="header_wishlist">
                                        <a href="<?= BASE_URL ?>order/myOrders"
                                           title="My Orders">
                                            <img src="<?= BASE_URL ?>assets/store/assets/img/user.png"
                                                 alt="My Account"
                                                 onerror="this.style.display='none'">
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- Mini Cart -->
                                <div class="mini_cart_wrapper">

                                    <a href="<?= BASE_URL ?>page/cart"
                                       title="View Cart">
                                        <img src="<?= BASE_URL ?>assets/store/assets/img/shopping-bag.png"
                                             alt="Cart">
                                    </a>
                                    <span class="cart_quantity"><?= $totalQty ?></span>

                                    <!-- Drop-down mini cart -->
                                    <div class="mini_cart">

                                        <?php if ($isLoggedIn && !empty($cart_items)): ?>

                                            <?php foreach ($cart_items as $cartItem): ?>
                                                <div class="cart_item">
                                                    <div class="cart_img">
                                                        <a href="<?= BASE_URL ?>product/details/<?= $cartItem->getProduct()->getId() ?>">
                                                            <img src="<?= BASE_URL ?><?= htmlspecialchars($cartItem->getProduct()->getImage()) ?>"
                                                                 alt="<?= htmlspecialchars($cartItem->getProduct()->getName()) ?>"
                                                                 style="width:60px;height:60px;object-fit:cover;">
                                                        </a>
                                                    </div>
                                                    <div class="cart_info">
                                                        <a href="<?= BASE_URL ?>product/details/<?= $cartItem->getProduct()->getId() ?>">
                                                            <?= htmlspecialchars($cartItem->getProduct()->getName()) ?>
                                                        </a>
                                                        <p>
                                                            Qty: <?= $cartItem->getQty() ?> &times;
                                                            <span>$<?= number_format($cartItem->getProduct()->getPrice(), 2) ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="cart_remove">
                                                        <a href="<?= BASE_URL ?>cart/handle/remove/<?= $cartItem->getProduct()->getId() ?>"
                                                           title="Remove">
                                                            <i class="ion-android-close"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>

                                            <div class="mini_cart_table">
                                                <div class="cart_total">
                                                    <span>Subtotal:</span>
                                                    <span class="price">$<?= number_format($total, 2) ?></span>
                                                </div>
                                                <div class="cart_total mt-10">
                                                    <span>Total:</span>
                                                    <span class="price">$<?= number_format($total, 2) ?></span>
                                                </div>
                                            </div>

                                        <?php elseif ($isLoggedIn): ?>

                                            <div class="cart_empty">
                                                <i class="ion-bag" style="font-size:28px;display:block;margin-bottom:8px;"></i>
                                                Your cart is empty.
                                            </div>

                                        <?php else: ?>

                                            <div class="cart_empty">
                                                <i class="fa fa-lock" style="font-size:24px;display:block;margin-bottom:8px;"></i>
                                                <a href="<?= BASE_URL ?>login">Login</a> to view your cart.
                                            </div>

                                        <?php endif; ?>

                                        <div class="mini_cart_footer">
                                            <div class="cart_button">
                                                <a href="<?= BASE_URL ?>page/cart">View Cart</a>
                                            </div>
                                            <div class="cart_button">
                                                <a href="<?= BASE_URL ?>page/checkout">Checkout</a>
                                            </div>
                                        </div>

                                    </div><!-- /.mini_cart -->

                                </div><!-- /.mini_cart_wrapper -->

                            </div><!-- /.middel_right_info -->
                        </div><!-- /.middel_right -->
                    </div>

                </div>
            </div>
        </div><!-- /.header_middle -->


        <!-- ── Main Navigation (Desktop) ─────────────────────────────── -->
        <div class="main_menu_area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="main_menu menu_position">
                            <nav>
                                <ul>

                                    <!-- Home -->
                                    <li>
                                        <a class="<?= navActive('home', $currentUri) ?>"
                                           href="<?= BASE_URL ?>home">Home</a>
                                    </li>

                                    <!-- Shop -->
                                    <li>
                                        <a class="<?= navActive('product', $currentUri) ?>"
                                           href="<?= BASE_URL ?>product/index">Shop</a>
                                    </li>

                                    <!--
                                        Categories: NOT implemented (no categories table/model).
                                        Uncomment and implement CategoryController::index() to enable.

                                    <li>
                                        <a href="#">Categories <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="...">Electronics</a></li>
                                        </ul>
                                    </li>
                                    -->

                                    <!-- Pages dropdown (only implemented pages) -->
                                    <li class="menu-item-has-children">
                                        <a href="#">Pages <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li>
                                                <a href="<?= BASE_URL ?>page/about">About Us</a>
                                            </li>
                                            <li>
                                                <a href="<?= BASE_URL ?>page/contact">Contact Us</a>
                                            </li>
                                            <li>
                                                <a href="<?= BASE_URL ?>page/forget-password">Forgot Password</a>
                                            </li>
                                            <!--
                                                The following pages are NOT implemented.
                                                Add their controller methods before re-enabling:
                                                  - PageController::faq()        → /page/faq
                                                  - PageController::tracking()   → /page/tracking
                                                  - PageController::privacy()    → /page/privacy-policy

                                            <li><a href="<?= BASE_URL ?>page/faq">FAQ</a></li>
                                            <li><a href="<?= BASE_URL ?>page/tracking">Order Tracking</a></li>
                                            <li><a href="<?= BASE_URL ?>page/privacy-policy">Privacy Policy</a></li>
                                            -->
                                        </ul>
                                    </li>

                                    <!-- Contact -->
                                    <li>
                                        <a class="<?= navActive('page/contact', $currentUri) ?>"
                                           href="<?= BASE_URL ?>page/contact">Contact</a>
                                    </li>

                                    <!-- Account area (logged-in) -->
                                    <?php if ($isLoggedIn): ?>
                                        <li class="menu-item-has-children">
                                            <a href="#">
                                                <i class="fa fa-user-circle-o" style="margin-right:4px;"></i>
                                                Account
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <ul class="sub_menu pages">
                                                <li>
                                                    <a href="<?= BASE_URL ?>order/myOrders">
                                                        <i class="fa fa-list-alt" style="margin-right:4px;"></i>
                                                        My Orders
                                                    </a>
                                                </li>
                                                <?php if ($isAdmin): ?>
                                                    <li>
                                                        <a href="<?= BASE_URL ?>admin/index">
                                                            <i class="fa fa-tachometer" style="margin-right:4px;"></i>
                                                            Admin Dashboard
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <li>
                                                    <a href="<?= BASE_URL ?>auth/logout">
                                                        <i class="fa fa-sign-out" style="margin-right:4px;"></i>
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <a href="<?= BASE_URL ?>login">
                                                <i class="fa fa-sign-in" style="margin-right:4px;"></i>
                                                Login
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.main_menu_area -->

    </div><!-- /.main_header -->
</header>
<!-- /.header area end -->