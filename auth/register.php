<?php
session_start();
include "../koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Registrasi</title>
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
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico">


  <!-- Libs CSS -->
  <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
  <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">


  <!-- Theme CSS -->
  <link rel="stylesheet" href="../assets/css/theme.min.css">


</head>

<body>

  <!-- navigation -->
  <div class="border-bottom shadow-sm">
    <nav class="navbar navbar-light py-2">
      <div class="container justify-content-center justify-content-lg-between">
        <a class="navbar-brand" href="../index.html">
          <img src="../assets/images/logo/freshcart-logo.svg" alt="" class="d-inline-block align-text-top">
        </a>
        <span class="navbar-text">
          Sudah punya akun? <a href="login.php">Login sekarang</a>
        </span>
      </div>
    </nav>
  </div>


  <main>
    <!-- section -->
    <section class="my-lg-14 my-8">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
            <img src="../assets/images/svg-graphics/signin-g.svg" alt="" class="img-fluid">
          </div>

          <!-- col -->
          <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
            <form method="POST">
              <div class="row g-3">
                <div class="col-6">
                  <input type="text" class="form-control" name="nama" placeholder="Nama lengkap" required>
                </div>

                <div class="col-6">
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>

                <div class="col-6">
                  <div class="password-field position-relative">
                    <input type="password" name="password" id="fakePassword" placeholder="Password" class="form-control" required>
                    <span><i id="passwordToggler" class="bi bi-eye-slash"></i></span>
                  </div>
                </div>

                <div class="col-6">
                  <input type="number" class="form-control" name="telepon" placeholder="Telepon" required>
                </div>

                <div class="col-12">
                  <textarea class="form-control" name="alamat" rows="3" placeholder="Masukan alamat"></textarea>
                </div>

                <div class="d-flex justify-content-between">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                  </div>
                  <div> Forgot password? <a href="">Reset It</a></div>
                </div>

                <div class="col-12 d-grid">
                  <button name="register" class="btn btn-primary">Registrasi</button>
                </div>
                <div>Sudah punya akun?<a href="login.php"> Login sekarang</a></div>
              </div>
            </form>

            <?php
            if (isset($_POST['register'])) {
              // Mengambil isian nama, email, password, telepon, alamat
              $nama = $_POST['nama'];
              $email = $_POST['email'];
              $password = $_POST['password'];
              $telepon = $_POST['telepon'];
              $alamat = $_POST['alamat'];

              // Cek apakah email sudah digunakan
              $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
              $yangcocok = $ambil->num_rows;
              if ($yangcocok == 1) {
                echo "<script>alert('Registrasi gagal! Email ini sudah digunakan');</script>";
                echo "<script>location='register.php';</script>";
              } else {
                // Query insert ke tabel pelanggan
                $koneksi->query("INSERT INTO pelanggan
                            (nama_pelanggan,email_pelanggan,password_pelanggan,telepon_pelanggan,alamat_pelanggan)
                        VALUES('$nama','$email','$password','$telepon','$alamat') ");

                echo "<script>alert('Registrasi berhasil. Anda akan diarahkan ke halaman login');</script>";
                echo "<script>location='login.php';</script>";
              }
            }
            ?>

          </div>
        </div>
      </div>
    </section>

  </main>




  <!-- Footer -->
  <!-- footer -->
  <footer class="footer">
    <div class="container">
      <div class="border-top py-4">
        <div class="row align-items-center">
          <div class="col-lg-7 mt-4 mt-md-0">
            <ul class="list-inline mb-0 text-lg-end text-center">
              <li class="list-inline-item mb-2 mb-md-0 text-dark">Get deliveries with FreshCart</li>
              <li class="list-inline-item ms-4">
                <a href="#!"> <img src="../assets/images/appbutton/appstore-btn.svg" alt="" style="width: 140px;"></a>
              </li>
              <li class="list-inline-item">
                <a href="#!"> <img src="../assets/images/appbutton/googleplay-btn.svg" alt="" style="width: 140px;"></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Javascript-->
  <!-- Libs JS -->
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>

  <!-- Theme JS -->
  <script src="../assets/js/theme.min.js"></script>
  <script src="../assets/js/vendors/password.js"></script>

</body>

</html>