
<!-- ::: Check Permission ::: -->
<?php include('config/checklogin.php') ?>

<!-- ::: Header Menu ::: -->
<div class="app-header-inner">
    <div class="container-fluid py-2">
        <div class="app-header-content">
            <div class="row justify-content-between align-items-center">

                <div class="col-auto">
                    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                        <svg width="30" height="30" viewBox="0 0 30 30" role="img">
                            <title>Menu</title>
                            <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                        </svg>
                    </a>
                </div>

                <!-- icon search -->
                <div class="search-mobile-trigger d-sm-none col">
                    <i class="search-mobile-trigger-icon fas fa-search"></i>
                </div>

                <!-- ::: Search ::: -->
                <div class="app-search-box col-6">
                    <form class="app-search-form">
                        <input type="search" placeholder="Search..." name="search" class="form-control search-input" aria-controls="dt-basic-checkbox">
                        <button type="submit" class="btn search-btn btn-primary" aria-controls="dt-basic-checkbox"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                <!-- ::: User Profile ::: -->
                <div​ class="app-utilities col-auto">
                    <div class="app-utility-item app-notifications-dropdown dropdown">

                        <!-- dropdown -->
                        <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" title="Notifications">
                            <div class="app-utility-item app-user-dropdown dropdown">
                                <!-- Img -->
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <img src="assets/images/user.png" alt="user profile">
                                </a>

                                <!-- Profile Items -->
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <li><a class="dropdown-item" href="Account.php">Account</a></li>
                                    <li><a class="dropdown-item" href="Settings.php">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                       <a class="dropdown-item text-center"><?php include('Log_out.php') ?></a>
                                    </li>
                                </ul>
                            </div>
                        </a>

                    </div>
                </div​>

            </div>
        </div>
    </div>
</div>
