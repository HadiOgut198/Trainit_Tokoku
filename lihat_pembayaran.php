<?php
session_start();
include "koneksi.php";

$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran 
    LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian
    WHERE pembelian.id_pembelian = '$id_pembelian'");
$detbay = $ambil->fetch_assoc();

// Jika belum ada data pembayaran atau status pending
if (empty($detbay)) {
    echo "<script>alert('Oops! Belum ada data pembayaran!');</script>";
    echo "<script>location='riwayat_belanja.php'</script>";
    exit();
}

// Jika data pelanggan yang bayar tidak sesuai dengan yang login
if ($_SESSION['pelanggan']['id_pelanggan'] !== $detbay['id_pelanggan']) {
    echo "<script>alert('Maaf, Anda tidak boleh melihat pembayaran orang lain!');</script>";
    echo "<script>location='riwayat_belanja.php'</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Riwayat Pembayaran</title>
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
        <section class="my-lg-14 my-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-8">
                            <h1 class="mb-1">Riwayat Pembayaran</h1>
                            <p>Riwayat pembayaran Anda.</p>
                        </div>
                        <div class="mb-5 card mt-6">
                            <div class="card-body p-6">
                                <h2 class="h5 mb-4">Pembayaran</h2>
                                <div class="card mb-2">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <div>Nama Pelanggan :</div>
                                            </div>
                                            <span><?php echo $detbay['nama'] ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <div>Bank :</div>
                                            </div>
                                            <span><?php echo $detbay['bank']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <div class="fw-bold">Jumlah :</div>
                                            </div>
                                            <span class="fw-bold">Rp<?php echo number_format($detbay['jumlah_pembayaran']); ?></span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-8">
                                    <h5 class="mb-3">Bukti Pembayaran</h5>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 mb-8">
                                            <div class="mb-4">
                                                <a href="#!">
                                                    <div class="img-zoom">
                                                        <img src="bukti_pembayaran/<?php echo $detbay['bukti']; ?>" alt="" class="img-fluid w-100" width="80px">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="riwayat_belanja.php" class="btn btn-danger"><i class="bi bi-arrow-left-circle me-1"></i>Kembali</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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