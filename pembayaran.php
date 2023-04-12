<?php
session_start();
include "koneksi.php";

// Jika tidak ada session pelanggan (yang belum login)
if (empty($_SESSION['pelanggan']) or !isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Oops! Anda belum login!');</script>";
    echo "<script>location='auth/login.php';</script>";
    exit();
}

// Mendapatkan id_pembmelian dari URL
$idpem = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$idpem'");
$detpem = $ambil->fetch_assoc();

// Mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem['id_pelanggan'];
// Mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];
if ($id_pelanggan_login !== $id_pelanggan_beli) {
    echo "<script>alert('Anda tidak boleh mengakses data ini!');</script>";
    echo "<script>location='riwayat_belanja.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Pembayaran</title>
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
                    <!-- col -->
                    <div class="offset-lg-2 col-lg-8 col-12">
                        <div class="mb-8">
                            <h1 class="h3">Konfirmasi Pembayaran</h1>
                            <!-- <p>Silahkan kirim bukti pembayaran Anda disini.</p> -->
                            <div class="alert alert-warning p-2" role="alert">
                                <i class="bi bi-megaphone me-1"></i>Total tagihan <strong>Rp<?php echo number_format($detpem['total_pembelian']); ?></strong>. Silahkan kirim bukti pembayaran Anda disini.
                            </div>
                        </div>
                        <!-- form -->
                        <form method="POST" class="row" enctype="multipart/form-data">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="fname">Nama lengkap<span class="text-danger">*</span></label>
                                <input type="text" id="fname" class="form-control" name="nama" placeholder="Nama penyetor" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="lname">Bank<span class="text-danger">*</span></label>
                                <input type="text" id="bank" class="form-control" name="bank" placeholder="Enter Your Last name" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="emailContact">Jumlah<span class="text-danger">*</span></label>
                                <input type="number" name="jumlah_pembayaran" class="form-control" placeholder="Jumlah pembayaran" required>
                            </div>

                            <!-- <div class="col-md-6 mb-3">
                                <label class="form-label" for="lname">Tanggal<span class="text-danger">*</span></label>
                                <input type="date" id="tanggal_pembayaran" class="form-control" name="tanggal_pembayaran" placeholder="Tanggal" required>
                            </div> -->

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="phone">Foto bukti</label>
                                <input type="file" id="bukti" name="bukti" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <button name="kirim" class="btn btn-warning"><i class="bi bi-credit-card me-1"></i>Bayar sekarang</button>
                            </div>
                        </form>

                        <?php
                        // Jika ada tombol kirim
                        if (isset($_POST["kirim"])) {
                            // Upload dulu foto bukti pembayaran
                            $namabukti = $_FILES["bukti"]["name"];
                            $lokasibukti = $_FILES["bukti"]["tmp_name"];
                            $namafiks = date("YmdHis") . $namabukti;
                            move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

                            $nama = $_POST["nama"];
                            $bank = $_POST["bank"];
                            $jumlah_pembayaran = $_POST["jumlah_pembayaran"];
                            $tanggal_pembayaran = date("Y-m-d");

                            // Simpan pembayaran
                            $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah_pembayaran,tanggal_pembayaran,bukti) 
                            VALUES ('$idpem','$nama','$bank','$jumlah_pembayaran','$tanggal_pembayaran','$namafiks') ");

                            // Update data pembelian dari pending menjadi sudah kirim pembayaran
                            $koneksi->query("UPDATE pembelian SET status_pembelian = 'Sudah kirim pembayaran'
                                WHERE id_pembelian = '$idpem'");

                            echo "<script>alert('Terimakasih sudah mengirimkan bukti pembayaran');</script>";
                            echo "<script>location='riwayat_belanja.php';</script>";
                        }
                        ?>

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