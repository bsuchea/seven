
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
                        <input type="search" id="live_search" placeholder="Search ID or Name here..." name="search" class="form-control search-input text-center" aria-controls="dt-basic-checkbox">
                        <!-- <button type="submit" class="btn search-btn btn-primary" aria-controls="dt-basic-checkbox"><i class="fas fa-search"></i></button> -->
                    </form>
                </div>

                <!-- ::: User Profile ::: -->
                <div​ class="app-utilities col-auto">
                <form action="#" method="post"">
                    <button type="submit" name="log_out" id="log_out" class="btn btn-outline-light" title="Log Out"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg></button>
                </form>
                <?php include("assets/contents/Log_out.php");?>

            </div>
        </div>
    </div>
</div>
