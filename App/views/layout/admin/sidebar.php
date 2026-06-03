<?php
$currentUrl = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

function isActive(string $segment, string $currentUrl): string
{
    return str_contains($currentUrl, $segment) ? 'active' : '';
}

function menuOpen(array $segments, string $currentUrl): bool
{
    foreach ($segments as $s) {
        if (str_contains($currentUrl, $s)) return true;
    }
    return false;
}

$productOpen = menuOpen(['product'], $currentUrl);
$orderOpen   = menuOpen(['order'],   $currentUrl);
$userOpen    = menuOpen(['user'],    $currentUrl);
$contactOpen = menuOpen(['contact'], $currentUrl);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — <?= BASE_URL ?></title>

  <link href="<?= BASE_URL ?>assets/admin/assets/img/favicon.png" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/admin/assets/css/style.css" rel="stylesheet">

  <style>
    /*
     * FIX: NiceAdmin main.js adds data-bs-parent to ALL collapse items,
     * turning the sidebar into a strict accordion (only one open at a time).
     * We override that by removing the parent constraint via CSS + JS fix below.
     * The .nav-content items must control their own open/close state independently.
     */
    .sidebar-nav .nav-content {
      transition: none !important; /* prevent flash on page load */
    }
  </style>
</head>
<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="<?= BASE_URL ?>admin/index" class="logo d-flex align-items-center">
      <img src="<?= BASE_URL ?>assets/admin/assets/img/logo.png" alt="">
      <span class="d-none d-lg-block">NiceAdmin</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?= BASE_URL ?>assets/admin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= BASE_URL ?>auth/logout">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>
        </ul>
      </li>

    </ul>
  </nav>

</header>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link <?= $productOpen || $orderOpen || $userOpen || $contactOpen ? 'collapsed' : '' ?>"
         href="<?= BASE_URL ?>admin/index">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- ===== PRODUCTS ===== -->
    <li class="nav-item">
      <a class="nav-link <?= $productOpen ? '' : 'collapsed' ?>"
         data-bs-toggle="collapse"
         data-bs-target="#products-nav"
         href="javascript:void(0)"
         aria-expanded="<?= $productOpen ? 'true' : 'false' ?>">
        <i class="bi bi-box"></i>
        <span>Products</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="products-nav"
          class="nav-content collapse <?= $productOpen ? 'show' : '' ?>">
        <li>
          <a class="<?= isActive('product/products', $currentUrl) ?>"
             href="<?= BASE_URL ?>product/products">
            <i class="bi bi-circle"></i><span>All Products</span>
          </a>
        </li>
        <li>
          <a class="<?= isActive('product/create', $currentUrl) ?>"
             href="<?= BASE_URL ?>product/create">
            <i class="bi bi-circle"></i><span>Add Product</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- ===== ORDERS ===== -->
    <li class="nav-item">
      <a class="nav-link <?= $orderOpen ? '' : 'collapsed' ?>"
         data-bs-toggle="collapse"
         data-bs-target="#orders-nav"
         href="javascript:void(0)"
         aria-expanded="<?= $orderOpen ? 'true' : 'false' ?>">
        <i class="bi bi-cart"></i>
        <span>Orders</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="orders-nav"
          class="nav-content collapse <?= $orderOpen ? 'show' : '' ?>">
        <li>
          <a class="<?= isActive('order/orders', $currentUrl) ?>"
             href="<?= BASE_URL ?>order/orders">
            <i class="bi bi-circle"></i><span>All Orders</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- ===== USERS ===== -->
    <li class="nav-item">
      <a class="nav-link <?= $userOpen ? '' : 'collapsed' ?>"
         data-bs-toggle="collapse"
         data-bs-target="#users-nav"
         href="javascript:void(0)"
         aria-expanded="<?= $userOpen ? 'true' : 'false' ?>">
        <i class="bi bi-people"></i>
        <span>Users</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="users-nav"
          class="nav-content collapse <?= $userOpen ? 'show' : '' ?>">
        <li>
          <a class="<?= isActive('user/users', $currentUrl) ?>"
             href="<?= BASE_URL ?>user/users">
            <i class="bi bi-circle"></i><span>All Users</span>
          </a>
        </li>
        <li>
          <a class="<?= isActive('user/create', $currentUrl) ?>"
             href="<?= BASE_URL ?>user/create">
            <i class="bi bi-circle"></i><span>Add User</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- ===== CONTACT ===== -->
    <li class="nav-item">
      <a class="nav-link <?= $contactOpen ? '' : 'collapsed' ?>"
         data-bs-toggle="collapse"
         data-bs-target="#contact-nav"
         href="javascript:void(0)"
         aria-expanded="<?= $contactOpen ? 'true' : 'false' ?>">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="contact-nav"
          class="nav-content collapse <?= $contactOpen ? 'show' : '' ?>">
        <li>
          <a class="<?= isActive('contact/contacts', $currentUrl) ?>"
             href="<?= BASE_URL ?>contact/contacts">
            <i class="bi bi-circle"></i><span>Messages</span>
          </a>
        </li>
      </ul>
    </li>

  </ul>

</aside>
<!-- End Sidebar -->

<?php
/*
 * IMPORTANT — put this script at the BOTTOM of the page (before </body>),
 * AFTER bootstrap.bundle.min.js and main.js have loaded.
 *
 * NiceAdmin main.js finds every .nav-content and adds data-bs-parent="#sidebar-nav"
 * which converts the sidebar into a strict accordion (only one section open at a time).
 * This fix runs AFTER main.js and removes that attribute so each section
 * can open/close independently.
 *
 * We also call bootstrap.Collapse.getOrCreateInstance() to register the
 * current page's open section so Bootstrap knows its state without needing
 * a user click first.
 */
?>

<!-- Vendor JS Files -->
<script src="<?= BASE_URL ?>assets/admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/assets/vendor/chart.js/chart.umd.js"></script>
<script src="<?= BASE_URL ?>assets/admin/assets/vendor/echarts/echarts.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/assets/vendor/quill/quill.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= BASE_URL ?>assets/admin/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= BASE_URL ?>assets/admin/assets/vendor/php-email-form/validate.js"></script>
<script src="<?= BASE_URL ?>assets/admin/assets/js/main.js"></script>

<script>
/*
 * Run AFTER main.js.
 *
 * Step 1: Remove data-bs-parent that main.js injected — this breaks
 *         accordion locking so multiple menus can be open at once.
 *
 * Step 2: For the currently-open section (PHP added class="show"),
 *         call getOrCreateInstance() so Bootstrap registers it properly
 *         and doesn't close it on first toggle.
 */
document.addEventListener('DOMContentLoaded', function () {

  // Step 1 — strip accordion parent from all sidebar collapse targets
  document.querySelectorAll('#sidebar-nav .nav-content').forEach(function (el) {
    el.removeAttribute('data-bs-parent');
  });

  // Step 2 — register each open section with Bootstrap Collapse
  document.querySelectorAll('#sidebar-nav .nav-content.show').forEach(function (el) {
    bootstrap.Collapse.getOrCreateInstance(el, { toggle: false });
  });

});
</script>