<div class="row w-100 align-items-center gx-lg-2 gx-0">
    <div class="col-xxl-2 col-lg-3">
        <!-- Logo web dekstop version -->
        <div class="navbar-brand d-none d-lg-block">
            <img src="assets/images/logo/freshcart-logo.svg" alt="eCommerce HTML Template">
        </div>
        <!-- And -->

        <!-- Navbar Mobile -->
        <?php include "header_mobile.php"; ?>
        <!-- End -->
    </div>

    <!-- Menu Header -->
    <div class="col-xxl-6 col-lg-5 d-none d-lg-block">
        <form action="pencarian.php" method="GET" class="d-flex">
            <div class="input-group me-2 ">
                <input type="text" name="keyword" class="form-control rounded" placeholder="Pencarian...">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-info">
                    <i class="feather-icon icon-search me-1"></i>Cari
                </button>
            </div>
        </form>
    </div>

    <!-- <div class="col-md-2 col-xxl-3 d-none d-lg-block">
        <button type="button" class="btn  btn-outline-gray-400 text-muted" data-bs-toggle="modal" data-bs-target="#locationModal">
            <i class="feather-icon icon-map-pin me-2"></i>Location
        </button>
    </div> -->

    <div class="col-md-2 col-xxl-1 text-end d-none d-lg-block">
        <div class="list-inline">
            <div class="list-inline-item">
                <a href="" class="text-muted" data-bs-toggle="modal" data-bs-target="#userModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            </div>

            <div class="list-inline-item">
                <a href="#" class="text-muted position-relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">1</span>
                </a>
            </div>

        </div>
    </div>
    <!-- End -->

</div>