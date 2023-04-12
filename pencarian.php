<?php
session_start();
include "koneksi.php";

$keyword = $_GET['keyword'];

$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'
OR deskripsi_produk LIKE '%$keyword%'");
while ($pecah = $ambil->fetch_assoc()) {
    $semuadata[] = $pecah;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Pencarian</title>
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
                        <div class="card mb-4 bg-light border-0">
                            <div class="card-body p-9">
                                <h6 class="mb-0 fs-1">Hasil pencarian : <?php echo $keyword; ?></h6>
                            </div>
                        </div>

                        <!-- <div class="d-lg-flex justify-content-between align-items-center">
                            <div class="mb-3 mb-lg-0">
                                <p class="mb-0"> <span class="text-dark">24 </span> Produk</p>
                            </div>
                        </div> -->

                        <div class="row g-4 row-cols-xl-3 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                            <!-- Jika pencarian tidak ditemukan atatu data tidak ada -->
                            <?php if (empty($semuadata)) : ?>
                                <div class="col-md-6">
                                    <div class=" mb-6 mb-lg-0">
                                        <h5>Produk tidak ditemukan!</h5>
                                        <p class="mb-8">Maaf. Produk yang ada cari tidak ditemukan<br>
                                            Silahkan cari produk yang lain.</p>
                                        <!-- btn -->
                                        <a href="index.php" class="btn btn-warning"><i class="bi bi-arrow-clockwise me-1"></i>Refresh</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <img src="assets/images/svg-graphics/error.svg" alt="" class="img-fluid">
                                    </div>
                                </div>

                            <?php endif ?>

                            <?php foreach ($semuadata as $key => $data) : ?>
                                <div class="col">
                                    <div class="card card-product">
                                        <div class="card-body">
                                            <div class="text-center position-relative ">
                                                <div class=" position-absolute top-0 start-0">
                                                    <span class="badge bg-danger">Sale</span>
                                                </div>
                                                <a href="shop-single.html">
                                                    <img src="foto_produk/<?php echo $data['foto_produk']; ?>" alt="Grocery Ecommerce Template" class="mb-3 img-fluid">
                                                </a>
                                                <div class="card-product-action">
                                                    <a class="btn-action" href="detail_produk.php?id=<?php echo $data['id_produk']; ?>">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                                                    <a href="beli.php?id=<?php echo $data['id_produk']; ?>" class="btn-action"><i class="feather-icon icon-shopping-cart me-1"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-small mb-1">
                                                <div class="text-decoration-none text-muted">
                                                    <small>Seafood</small>
                                                </div>
                                            </div>
                                            <h2 class="fs-6">
                                                <div class="text-inherit text-decoration-none"><?php echo $data['nama_produk']; ?></div>
                                            </h2>
                                            <div>
                                                <small class="text-warning">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-half"></i>
                                                </small>
                                                <span class="text-muted small">4.5(149)</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div>
                                                    <span class="text-dark">Rp<?php echo number_format($data['harga_produk']); ?></span>
                                                    <span class="text-decoration-line-through text-muted">Rp250.000</span>
                                                </div>
                                                <div>
                                                    <a href="beli.php?id=<?php echo $data['id_produk']; ?>" class="btn btn-danger btn-sm"><i class="feather-icon icon-shopping-cart me-1"></i>Beli</a>
                                                    <a href="detail_produk.php?id=<?php echo $data['id_produk']; ?>" class="btn btn-primary btn-sm"><i class="feather-icon icon-eye me-1"></i>Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
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