<?php

session_start();
include "koneksi.php";

if (!isset($_SESSION['admin'])) {
  echo "<script>alert('Oops! Anda belum login');</script>";
  echo "<script>location='auth/login.php';</script>";
  // header('location:auth/login.php');
  // exit();
}

?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="template/assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Dashboard | Admin</title>
  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="template/assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="template/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="template/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="template/assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="template/assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Font Icon -->
  <link rel="stylesheet" href="template/assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="template/assets/vendor/js/helpers.js"></script>
  <script src="template/assets/js/config.js"></script>

  <script src="template/assets/vendor/libs/jquery/jquery.js"></script>

</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <!-- Include Sidebar -->
      <?php include('layouts/sidebar.php'); ?>

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?php include('layouts/navbar.php'); ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <!-- <div class="container-xxl flex-grow-1 container-p-y"> -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data /</span> Tables</h5>
            <?php
            if (isset($_GET['halaman'])) {
              // Halaman Produk
              if ($_GET['halaman'] == "produk") {
                include 'produk/index.php';
              }
              // Tambah data produk
              elseif ($_GET['halaman'] == "tambah_produk") {
                include 'produk/tambah_produk.php';
              }
              // Edit data produk
              elseif ($_GET['halaman'] == "edit_produk") {
                include 'produk/edit_produk.php';
              }
              // Hapus data produk
              elseif ($_GET['halaman'] == "hapus_produk") {
                include 'produk/hapus_produk.php';
              }
              // Detail data produk
              elseif ($_GET['halaman'] == "detail_produk") {
                include 'produk/detail.php';
              }
              // Hapus foto_produk
              elseif ($_GET['halaman'] == "hapus_fotoproduk") {
                include 'produk/hapus_fotoproduk.php';
              }

              // Kategori
              elseif ($_GET['halaman'] == "kategori") {
                include 'kategori/index.php';
              }

              // Halaman Pembelian
              elseif ($_GET['halaman'] == "pembelian") {
                include 'pembelian/index.php';
              }

              // Detail pembelian
              elseif ($_GET['halaman'] == "detail_pembelian") {
                include 'pembelian/detail_pembelian.php';
              }

              // Pembayaran
              elseif ($_GET['halaman'] == "pembayaran") {
                include 'pembayaran/index.php';
              }

              // Halaman Pelanggan
              elseif ($_GET['halaman'] == "pelanggan") {
                include 'pelanggan.php';
              }

              // Laporan Pembelian
              elseif ($_GET['halaman'] == "laporan") {
                include 'laporan.php';
              }

              // Halaman Logout
              elseif ($_GET['halaman'] == "logout") {
                include 'logout.php';
              }
            } else {
              include 'home.php';
            }
            ?>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <?php include('layouts/footer.php'); ?>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->

      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

  </div>
  <!-- / Layout wrapper -->

  <div class="buy-now">
    <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" class="btn btn-danger btn-buy-now">
      Upgrade to Pro
    </a>
  </div>

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <!-- <script src="template/assets/vendor/libs/jquery/jquery.js"></script> -->
  <script src="template/assets/vendor/libs/popper/popper.js"></script>
  <script src="template/assets/vendor/js/bootstrap.js"></script>
  <script src="template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="template/assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="template/assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="template/assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="template/assets/js/dashboards-analytics.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>