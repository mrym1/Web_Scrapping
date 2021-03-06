<div class="d-flex justify-content-end px-2">
    <?php echo '<div class="dropdown" >
        <button class="btn btn-secondary bg-dark text-light dropdown-toggle rounded-pill login_btn border border-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img src="/WEB_SCRAPPING/admin/' . $_SESSION['IMAGE'] . '" class="img pic_logo" alt="..."><strong> ' . strtoupper($_SESSION['USERNAME']) . '</strong>
        </button>
        <ul class="dropdown-menu text-center bg-dark text-light w_login" aria-labelledby="dropdownMenuButton1">
          <li><img src="/WEB_SCRAPPING/admin/' . $_SESSION['IMAGE'] . '" class="img  pic_logo1" alt="..."><br><b>' . strtoupper($_SESSION['NAME']) . '</b></li>
          <hr> 
          <li><button type="button" class="btn btn-secondary mx-5 btn_size1 rounded-pill" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="las la-user-cog"></i><strong> SETTING</strong></button>
          <a class="text-info" href="/WEB_SCRAPPING/partials/logout.php">
            <button type="button" class="btn btn-secondary mx-3 btn_size1 rounded-pill"><i class="las la-sign-out-alt"></i><strong> LOGOUT</strong></button></a></li>
        </ul>
      </div>'; ?>
</div>


<div class="l-navbar" id="navbar">
    <nav class="nav">
        <div>
            <div class="nav__brand">
                <i class="las la-bars nav__toggle" id="nav-toggle"></i>
                <a href="#" class="nav__logo nav">Admin Panel&nbsp</a>
            </div>
            <div class="nav__list">
                <a href="/Inventory/php/admin-panel.php" class="nav__link a1">
                    <i class="las la-home nav__icon"></i>
                    <span class="nav__name"><b>Dashboard</b></span>
                </a>
                <a href="#" class="nav__link a1">
                    <i class="las la-users-cog nav__icon"></i>
                    <span class="nav__name"><b>User's</b></span>
                </a>
                <a href="#" class="nav__link a1" >
                    <i class="las la-image nav__icon"></i>
                    <span class="nav__name"><b>Gallery</b></span>
                </a>
                <a href="#" class="nav__link a1" >
                    <i class="las la-blog nav__icon"></i>
                    <span class="nav__name"><b>Our Site</b></span>
                </a>
                <a href="#" class="nav__link a1">
                    <i class="las la-exclamation-circle nav__icon"></i>
                    <span class="nav__name"><b>Problems</b></span>
                </a>
            </div>
        </div>

        <a href="#" class="nav__link a1">
            <i class="las la-arrow-alt-circle-left nav__icon"></i>
            <span class="nav__name"><b> Back</b></span>
        </a>
    </nav>
</div>
<!-- ===== IONICONS ===== -->
<!-- <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script> -->
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">

<!-- ===== MAIN JS ===== -->
<script src="/Inventory/JS/main.js"></script>