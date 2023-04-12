<?php
session_start();

include "koneksi.php";

if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
  echo "<script>alert('Oops! Keranjang masih kosong!');</script>";
  echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>OgutApps</title>
  <link href="assets/libs/slick-carousel/slick/slick.css" rel="stylesheet" />
  <link href="assets/libs/slick-carousel/slick/slick-theme.css" rel="stylesheet" />
  <link href="assets/libs/tiny-slider/dist/tiny-slider.css" rel="stylesheet">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta content="Codescandy" name="author">

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-M8S4MT3EYG');
  </script>

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon/favicon.ico">


  <!-- Libs CSS -->
  <link href="assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
  <link href="assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">


  <!-- Theme CSS -->
  <link rel="stylesheet" href="assets/css/theme.min.css">


</head>

<body>

  <div class="border-bottom ">
    <div class="py-4 pt-lg-3 pb-lg-0">
      <div class="container">
        <!-- Include Hedaer -->
        <?php include "menu/header.php"; ?>
        <!-- End Header -->
      </div>
    </div>

    <!-- Include Navbar -->
    <?php include "menu/navbar.php"; ?>
    <!-- End Navbar -->

  </div>

  <!-- Login Modal -->
  <?php include "login_modal.php"; ?>
  <!-- End Modal -->


  <main>

    <!-- Popular Products Start-->
    <section class="my-lg-14 my-8">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="mb-8">
              <h1 class="mb-1">Keranjang Belanja</h1>
              <p>Rincian belanja.</p>
            </div>

            <div>
              <div class="table-responsive">
                <table class="table text-nowrap table-with-checkbox">
                  <thead class="table-light">
                    <tr>
                      <th>Gambar</th>
                      <th>Nama produk</th>
                      <th>Jumlah</th>
                      <th>Subharga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) :

                      // Menampilkan produk yang sedang diperulangkan berdasarkan id_produk
                      $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
                      $pecah = $ambil->fetch_assoc();
                      $subharga = $pecah['harga_produk'] * $jumlah;
                    ?>
                      <tr>
                        <td class="align-middle">
                          <img src="foto_produk/<?php echo $pecah['foto_produk']; ?>" class="icon-shape icon-xxl" alt="">
                        </td>
                        <td class="align-middle">
                          <div>
                            <h5 class="fs-6 mb-0"><a href="#" class="text-inherit"><?php echo $pecah['nama_produk']; ?></a></h5>
                            <small>Rp<?php echo number_format($pecah['harga_produk']); ?></small>
                          </div>
                        </td>
                        <!-- <td class="align-middle"><span class="badge bg-success"><?php echo $jumlah; ?>/Pcs</span></td> -->
                        <td class="align-middle"><?php echo $jumlah; ?>/Pcs</td>
                        <td class="align-middle">Rp<?php echo number_format($subharga); ?></td>
                        <td class="align-middle">
                          <a href="hapus_keranjang.php?id=<?php echo $id_produk; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                            <i class="feather-icon icon-trash-2 text-danger"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="index.php" class="btn btn-primary"><i class="feather-icon icon-arrow-left me-1"></i>Continue Shopping</a>
              <a href="checkout.php" class="btn btn-warning"><i class="feather-icon icon-arrow-right me-1"></i>Checkout</a>
            </div>

          </div>
        </div>

      </div>
    </section>
    <!-- Popular Products End-->

  </main>

  <!-- footer -->
  <?php include "menu/footer.php"; ?>
  <!-- End Footer -->

  <!-- Javascript-->

  <!-- Libs JS -->
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.min.js"></script>

  <!-- Theme JS -->
  <script src="assets/js/theme.min.js"></script>
  <script src="assets/libs/jquery-countdown/dist/jquery.countdown.min.js"></script>
  <script src="assets/js/vendors/countdown.js"></script>
  <script src="assets/libs/slick-carousel/slick/slick.min.js"></script>
  <script src="assets/js/vendors/slick-slider.js"></script>
  <script src="assets/libs/tiny-slider/dist/min/tiny-slider.js"></script>
  <script src="assets/js/vendors/tns-slider.js"></script>
  <script src="assets/js/vendors/zoom.js"></script>
  <script src="assets/js/vendors/increment-value.js"></script>

</body>

</html>