<?php
session_start();
include "koneksi.php";

// Jika tidak ada session pelanggan (yang belum login)
if (empty($_SESSION['pelanggan']) or !isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Oops! Anda belum login!');</script>";
    echo "<script>location='auth/login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Riwayat Belanja</title>
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
                            <h1 class="mb-1">Riwayat Belanja</h1>
                            <p>Shopping history. <strong><?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?></strong></p>
                        </div>

                        <div>
                            <div class="table-responsive">
                                <table class="table text-nowrap table-with-checkbox">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Status pembelian</th>
                                            <th>Pengiriman</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Mendapatkan id_pelanggan yang login dari session
                                        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                                        $no = 1;
                                        $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
                                        while ($pecah = $ambil->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td class="align-middle"><?php echo $no; ?></td>

                                                <td class="align-middle">
                                                    <a class="text-inherit"><?php echo $pecah['tgl_pembelian']; ?></a>
                                                </td>

                                                <td class="align-middle">
                                                    <?php if ($pecah['status_pembelian'] == "pending") : ?>
                                                        <span class="badge bg-light-danger text-dark-danger">
                                                            <i class="bi bi-clock me-1"></i><?php echo $pecah['status_pembelian']; ?>
                                                        </span>
                                                    <?php else : ?>
                                                        <span class="badge bg-light-primary text-dark-primary">
                                                            <i class="bi bi-truck me-1"></i><?php echo $pecah['status_pembelian']; ?>
                                                            <?php if (!empty($pecah['resi_pengiriman'])) : ?>
                                                                | No Resi: FC<?php echo $pecah['resi_pengiriman']; ?>
                                                            <?php endif ?>
                                                        </span>
                                                    <?php endif ?>
                                                </td>

                                                <td class="align-middle"><i class="bi bi-geo-alt me-1"></i><?php echo $pecah['nama_kota']; ?></td>

                                                <td class="align-middle">Rp<?php echo number_format($pecah['total_pembelian']); ?></td>

                                                <td class="align-middle">
                                                    <a href="nota_pembelian.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-sm btn-info"><i class="bi bi-file-earmark-text me-1"></i>Nota</a>
                                                    <?php if ($pecah['status_pembelian'] == "pending") : ?>
                                                        <a href="pembayaran.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-credit-card me-1"></i>Bayar Sekarang</a>
                                                    <?php else : ?>
                                                        <a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-eye me-1"></i>Lihat Pembayaran</a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- <div class="d-flex justify-content-between mt-4">
                            <a href="index.php" class="btn btn-primary"><i class="feather-icon icon-arrow-left me-1"></i>Continue Shopping</a>
                            <a href="checkout.php" class="btn btn-warning"><i class="feather-icon icon-arrow-right me-1"></i>Checkout</a>
                        </div> -->

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