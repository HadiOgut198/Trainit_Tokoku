<?php
session_start();

include "koneksi.php";

if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
  echo "<script>alert('Oops! Keranjang masih kosong!');</script>";
  echo "<script>location='index.php';</script>";
}

if (empty($_SESSION['pelanggan']) or !isset($_SESSION['pelanggan'])) {
  echo "<script>alert('Oops! Anda belum login!');</script>";
  echo "<script>location='auth/login.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Checkout</title>
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
    <section class="mb-lg-14 mb-8 mt-8">
      <div class="container">
        <!-- row -->
        <div class="row">
          <!-- col -->
          <div class="col-12">
            <div>
              <div class="mb-8">
                <!-- text -->
                <h1 class="fw-bold mb-0">Checkout</h1>
              </div>
            </div>
          </div>

          <div class="col-lg-12 mb-4">
            <div class="mt-4 mt-lg-0">
              <div class="card shadow-sm">
                <h5 class="px-6 py-4 bg-transparent mb-0">Order Details</h5>
                <ul class="list-group list-group-flush">
                  <?php
                  $totalbelanja = 0;
                  foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) :
                    // Menampilkan produk yang sedang diperulangkan berdasarkan id_produk
                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk' ");
                    $pecah = $ambil->fetch_assoc();
                    $subharga = $pecah['harga_produk'] * $jumlah;
                  ?>
                    <!-- list group item -->
                    <li class="list-group-item px-4 py-3">
                      <div class="row align-items-center">
                        <div class="col-2 col-md-2">
                          <img src="foto_produk/<?php echo $pecah['foto_produk']; ?>" width="90px" alt="Ecommerce" class="img-fluid">
                        </div>

                        <div class="col-5 col-md-5">
                          <h6 class="mb-0"><?php echo $pecah['nama_produk']; ?></h6>
                          <span><small class="text-muted">Rp<?php echo number_format($pecah['harga_produk']); ?></small></span>
                        </div>

                        <div class="col-2 col-md-2 text-center text-muted">
                          <span><?php echo $jumlah; ?>/Pcs</span>
                        </div>

                        <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                          <span class="fw-bold">Rp<?php echo number_format($subharga); ?></span>
                        </div>
                      </div>
                    </li>
                    <?php $totalbelanja += $subharga; ?>
                  <?php endforeach ?>

                  <!-- list group item -->
                  <li class="list-group-item px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between fw-bold">
                      <div>Subtotal Pembelian</div>
                      <div>Rp<?php echo number_format($totalbelanja); ?></div>
                    </div>
                  </li>

                </ul>

              </div>


            </div>
          </div>

        </div>
        <div>
          <!-- row -->
          <div class="row">
            <div class="col-lg-7 col-md-12">
              <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item py-4">

                  <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="fs-5 text-inherit collapsed h4" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                      <i class="feather-icon icon-map-pin me-2 text-muted"></i>Alamat pengiriman
                    </a>

                    <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">Add a new address
                    </a>
                  </div>

                  <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                    <div class="mt-5">
                      <div class="row">

                        <form method="POST">
                          <div class="col-lg-12 col-12 mb-4">
                            <div class="card card-body p-6 ">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">Nama pelanggan</label>
                                    <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" class="form-control" placeholder="FUllname">
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" readonly value="<?php echo $_SESSION['pelanggan']['email_pelanggan']; ?>" class="form-control" placeholder="Email">
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="number" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>" class="form-control" placeholder="Telepon">
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="mb-3">
                                    <label class="form-label">Ongkos kirim</label>
                                    <select name="id_ongkir" class="form-select">
                                      <option selected="">-- Pilih --</option>
                                      <?php
                                      $ambil = $koneksi->query("SELECT * FROM ongkir");
                                      while ($perongkir = $ambil->fetch_assoc()) {
                                      ?>
                                        <option value="<?php echo $perongkir['id_ongkir'] ?>">
                                          <?php echo $perongkir['nama_kota']; ?> |
                                          Rp<?php echo number_format($perongkir['tarif']); ?>
                                        </option>
                                        <!-- <option value="2">Serang Rp10.000</option> -->
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-12">
                                  <label for="DeliveryInstructions" class="form-label sr-only">Alamat pengiriman</label>
                                  <textarea name="alamat_pengiriman" class="form-control" rows="3" placeholder="Masukan text..."></textarea>
                                  <p class="form-text">Silahkan masukan alamat lengkap pengiriman (termasuk kode post) Anda.</p>
                                </div>

                              </div>

                              <div class="mt-4">
                                <button name="checkout" class="btn btn-primary"><i class="feather-icon icon-arrow-right me-1"></i>Checkout Now</button>
                              </div>

                            </div>
                          </div>
                        </form>

                        <?php
                        if (isset($_POST['checkout'])) {
                          $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                          $id_ongkir = $_POST['id_ongkir'];
                          $tgl_pembelian = date('Y-m-d');
                          $alamat_pengiriman = $_POST['alamat_pengiriman'];

                          $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
                          $arrayongkir = $ambil->fetch_assoc();
                          $nama_kota = $arrayongkir['nama_kota'];
                          $tarif = $arrayongkir['tarif'];

                          $total_pembelian = $totalbelanja + $tarif;

                          // Menyimpan data ke tabel pembelian
                          $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tgl_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman)
                          VALUES ('$id_pelanggan','$id_ongkir','$tgl_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

                          // Mendapatkan id_pembelian barusan terjadi
                          $id_pembelian_barusan = $koneksi->insert_id;

                          foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                            // Mendapatkan data produk berdasarkan id_produk
                            $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                            $perproduk = $ambil->fetch_assoc();

                            $nama = $perproduk['nama_produk'];
                            $harga = $perproduk['harga_produk'];
                            $berat = $perproduk['berat_produk'];

                            $subberat = $perproduk['berat_produk'] * $jumlah;
                            $subharga = $perproduk['harga_produk'] * $jumlah;

                            $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
                            VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

                            // Script update stok produk
                            $koneksi->query("UPDATE produk SET stok_produk = stok_produk -$jumlah
                            WHERE id_produk = '$id_produk'");
                          }

                          // Mengkosongkan keranjang belanja
                          unset($_SESSION['keranjang']);

                          // Tampilan dialihkan ke halaman nota_pembelian, nota dari pembelian barusan.
                          echo "<script>alert('Checkout pembelian perhasil');</script>";
                          echo "<script>location='nota_pembelian.php?id=$id_pembelian_barusan';</script>";
                        }
                        ?>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
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


<!-- Mirrored from freshcart.codescandy.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 17:36:13 GMT -->

</html>