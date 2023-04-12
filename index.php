<?php
session_start();
include "koneksi.php";
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
    <!-- Include Slide -->
    <?php include "slide.php"; ?>
    <!-- End Slide -->

    <!-- Category Section Start-->
    <?php include "slide_categories.php"; ?>
    <!-- Category Section End-->

    <section>
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 mb-3 mb-lg-0">
            <div>
              <div class="py-10 px-8 rounded" style="background:url(assets/images/banner/grocery-banner.png)no-repeat; background-size: cover; background-position: center;">
                <div>
                  <h3 class="fw-bold mb-1">Fruits & Vegetables
                  </h3>
                  <p class="mb-4">Get Upto <span class="fw-bold">30%</span> Off</p>
                  <a href="#!" class="btn btn-dark">Shop Now</a>
                </div>
              </div>

            </div>

          </div>
          <div class="col-12 col-md-6 ">

            <div>
              <div class="py-10 px-8 rounded" style="background:url(assets/images/banner/grocery-banner-2.jpg)no-repeat; background-size: cover; background-position: center;">
                <div>
                  <h3 class="fw-bold mb-1">Freshly Baked
                    Buns
                  </h3>
                  <p class="mb-4">Get Upto <span class="fw-bold">25%</span> Off</p>
                  <a href="#!" class="btn btn-dark">Shop Now</a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Popular Products Start-->
    <section class="my-lg-14 my-8">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-6">

            <h3 class="mb-0">Popular Products</h3>

          </div>
        </div>

        <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">

          <?php
          $ambil = $koneksi->query("SELECT * FROM produk");
          while ($perproduk = $ambil->fetch_assoc()) {
          ?>

            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <a href="">
                      <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="Grocery Ecommerce Template" class="mb-3 img-fluid"></a>
                    <div class="card-product-action">
                      <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                        <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"></i>
                      </a>
                      <a href="" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i>
                      </a>

                      <a href="" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Cart"><i class="feather-icon icon-shopping-cart"></i>
                      </a>
                    </div>
                  </div>

                  <div class="text-small mb-1">
                    <a href="#" class="text-decoration-none text-muted">
                      <small>Instant Food</small>
                    </a>
                  </div>

                  <h2 class="fs-6">
                    <a href="" class="text-inherit text-decoration-none">
                      <?php echo $perproduk['nama_produk']; ?>
                    </a>
                  </h2>

                  <div class="text-warning">
                    <small>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span class="text-muted small">4.5 (39)</span>
                  </div>

                  <div class="d-flex justify-content-between mt-4">
                    <div>
                      <span class="text-dark">Rp<?php echo number_format($perproduk['harga_produk']); ?></span>
                    </div>

                  </div>

                  <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-danger btn-sm">
                    <i class="feather-icon icon-shopping-cart me-1"></i>Beli
                  </a>

                  <a href="detail_produk.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary btn-sm">
                    Details
                  </a>

                </div>
              </div>
            </div>

          <?php } ?>

        </div>
      </div>
    </section>
    <!-- Popular Products End-->

  </main>


  <!-- Modal View Produk -->
  <?php include "modal_view_produk.php"; ?>


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


<!-- Mirrored from freshcart.codescandy.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 17:36:13 GMT -->

</html>