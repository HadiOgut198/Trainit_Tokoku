<nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 py-lg-4">
  <div class="container px-0 px-md-3">
    <div class="dropdown me-3 d-none d-lg-block">
      <button class="btn btn-primary px-6 " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="me-1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
          </svg></span> All Departments
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="">Dairy, Bread & Eggs</a></li>
        <li><a class="dropdown-item" href="">Snacks & Munchies</a></li>
        <li><a class="dropdown-item" href="">Fruits & Vegetables</a></li>
        <li><a class="dropdown-item" href="">Cold Drinks & Juices</a></li>
        <li><a class="dropdown-item" href="">Breakfast & Instant Food</a></li>
        <li><a class="dropdown-item" href="">Bakery & Biscuits</a></li>
        <li><a class="dropdown-item" href="">Chicken, Meat & Fish</a></li>
      </ul>
    </div>
    <div class="offcanvas offcanvas-start p-4 p-lg-0" id="navbar-default">
      <div class="d-flex justify-content-between align-items-center mb-2 d-block d-lg-none">
        <a href="index.html"><img src="assets/images/logo/freshcart-logo.svg" alt="eCommerce HTML Template"></a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="d-block d-lg-none my-4">
        <form action="#">
          <div class="input-group ">
            <input class="form-control rounded" type="search" placeholder="Search for products">
            <span class="input-group-append">
              <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                  <circle cx="11" cy="11" r="8"></circle>
                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
              </button>
            </span>
          </div>
        </form>
        <div class="mt-2">
          <button type="button" class="btn  btn-outline-gray-400 text-muted w-100 " data-bs-toggle="modal" data-bs-target="#locationModal">
            <i class="feather-icon icon-map-pin me-2"></i>Pick Location
          </button>
        </div>
      </div>
      <div class="d-block d-lg-none mb-4">
        <a class="btn btn-primary w-100 d-flex justify-content-center align-items-center" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          <span class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
              <rect x="3" y="3" width="7" height="7"></rect>
              <rect x="14" y="3" width="7" height="7"></rect>
              <rect x="14" y="14" width="7" height="7"></rect>
              <rect x="3" y="14" width="7" height="7"></rect>
            </svg></span> All Departments
        </a>
        <div class="collapse mt-2" id="collapseExample">
          <div class="card card-body">
            <ul class="mb-0 list-unstyled">
              <li><a class="dropdown-item" href="">Dairy, Bread & Eggs</a></li>
              <li><a class="dropdown-item" href="">Snacks & Munchies</a></li>
              <li><a class="dropdown-item" href="">Fruits & Vegetables</a></li>
              <li><a class="dropdown-item" href="">Cold Drinks & Juices</a></li>
              <li><a class="dropdown-item" href="">Breakfast & Instant Food</a></li>
              <li><a class="dropdown-item" href="">Bakery & Biscuits</a></li>
              <li><a class="dropdown-item" href="">Chicken, Meat & Fish</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Menu Dekstop -->
      <div class="d-none d-lg-block">
        <ul class="navbar-nav align-items-center ">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Home
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="index.php">Beranda</a></li>
            </ul>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="keranjang.php">Keranjang</a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="checkout.php">Checkout</a>
          </li>

          <!-- Jika sudah login (ada session pelanggan) -->
          <?php if (isset($_SESSION['pelanggan'])) : ?>
            <li class="nav-item ">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>

            <li class="nav-item ">
              <a class="nav-link" href="riwayat_belanja.php">Riwayat Belanja</a>
            </li>
            <!-- Selain itu belum login (belum ada session) -->
          <?php else : ?>
            <li class="nav-item ">
              <a class="nav-link" href="auth/login.php">Login</a>
            </li>

            <li class="nav-item ">
              <a class="nav-link" href="auth/register.php">Registrasi</a>
            </li>
          <?php endif ?>

        </ul>
      </div>
      <!-- End -->

      <!-- Menu Mobile -->
      <div class="d-block d-lg-none h-100" data-simplebar="">
        <ul class="navbar-nav ">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Home
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="">Home 1</a></li>
              <li><a class="dropdown-item" href="">Home 2</a></li>
              <li><a class="dropdown-item" href="">Home 3</a></li>
              <li><a class="dropdown-item" href="">Home 4 <span class="badge bg-light-info text-dark-info ms-1">New</span></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="">Keranjang</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="">Checkout</a>
          </li>

        </ul>
      </div>
      <!-- End -->

    </div>
  </div>

</nav>