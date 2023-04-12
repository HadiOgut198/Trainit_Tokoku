<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Oops! Anda belum login!');</script>";
    echo "<script>location='auth/login.php';</script>";
}

$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
        ON pembelian.id_pelanggan = pelanggan.id_pelanggan
    WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();

?>

<!-- Jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php karena dia tidak berhak melihat nota orang lain. -->
<!-- Pelanggan yang beli harus pelanggan yang login. -->
<?php
// Mendapatkan id_pelanggan yang beli
$id_pelanggan_yang_beli = $detail['id_pelanggan'];
// Mendapatkan id_pelanggan yang sedang login
$id_pelanggan_yang_login = $_SESSION['pelanggan']['id_pelanggan'];

if ($id_pelanggan_yang_beli !== $id_pelanggan_yang_login) {
    echo "<script>alert('Anda tidak boleh mengakses nota ini!');</script>";
    echo "<script>location='riwayat_belanja.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Nota Pembelian</title>
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
                <div class="alert alert-warning p-2" role="alert">
                    Anda mendapatkan pengiriman GRATIS. <a href="" class="alert-link">Mulai pembayaran sekarang!</a>
                    Pembayaran sebesar <strong>Rp<?php echo number_format($detail['total_pembelian']); ?></strong> ke <strong>Bank BCA 123-4556-12 A/N HadiOgut</strong>.
                </div>

                <div class="row ">
                    <div class="col-xl-12 col-12 mb-5">
                        <div class="card h-100 card-lg">
                            <div class="card-body p-6">
                                <div class="d-md-flex justify-content-between">
                                    <div class="d-flex align-items-center mb-2 mb-md-0">
                                        <h2 class="mb-0">Order ID: #OGT<?php echo $detail['id_pembelian']; ?></h2>
                                        <span class="badge bg-light-warning text-dark-warning ms-2"><?php echo $detail['status_pembelian']; ?></span>
                                    </div>
                                    <div class="d-md-flex">
                                        <div class="ms-md-3">
                                            <a href="#" class="btn btn-warning">Download Invoice</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <div class="row">
                                        <!-- address -->
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Pelanggan</h6>
                                                <p class="mb-1 lh-lg">
                                                    Nama: <?php echo $detail['nama_pelanggan']; ?><br>
                                                    Email: <?php echo $detail['email_pelanggan']; ?><br>
                                                    Telepon: <?php echo $detail['telepon_pelanggan']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- address -->
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Pengiriman</h6>
                                                <p class="mb-1 lh-lg">Kota: <?php echo $detail['nama_kota']; ?><br>
                                                    Ongkos Kirim: Rp<?php echo number_format($detail['tarif']); ?> <br>
                                                    Alamat: <?php echo $detail['alamat_pengiriman']; ?></p>
                                            </div>
                                        </div>
                                        <!-- address -->
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Order Details</h6>
                                                <p class="mb-1 lh-lg">No. Pembelian: <span class="text-dark"><?php echo $detail['id_pembelian']; ?></span><br>
                                                    Tangggal Pembelian: <span class="text-dark"><?php echo $detail['tgl_pembelian']; ?></span><br>
                                                    Total Pembelian: <span class="text-dark">Rp<?php echo number_format($detail['total_pembelian']); ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <!-- Table -->
                                        <table class="table mb-0 text-nowrap table-centered">
                                            <!-- Table Head -->
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Produk</th>
                                                    <th>Harga</th>
                                                    <th>Berat</th>
                                                    <th>Jumlah</th>
                                                    <th>Subberat</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$_GET[id]'");
                                                while ($pecah = $ambil->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-inherit">
                                                                <div class="d-flex align-items-center">
                                                                    <!-- <div>
                                                        <img src="foto_produk/<?php echo $pecah['foto_produk']; ?>" alt="" class="icon-shape icon-lg">
                                                    </div> -->
                                                                    <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                        <h5 class="mb-0 h6">
                                                                            <?php echo $pecah['nama']; ?>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td><span class="text-body">Rp<?php echo number_format($pecah['harga']); ?></span></td>
                                                        <td><?php echo $pecah['berat']; ?>/gr</td>
                                                        <td><?php echo $pecah['jumlah']; ?>/pcs</td>
                                                        <td><?php echo $pecah['subberat']; ?>/gr</td>
                                                        <td>Rp<?php echo number_format($pecah['subharga']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>
                                                        <a href="riwayat_belanja.php" class="btn btn-danger">Kembali</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- <div class="alert alert-danger p-2" role="alert">
                You’ve got FREE delivery. Start <a href="#!" class="alert-link">checkout now!</a>
            </div> -->
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


<!-- Mirrored from freshcart.codescandy.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 17:36:13 GMT -->

</html>