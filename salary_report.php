<?php
require_once 'config/checklogin.php';
require_once 'config/db.php';
require_once 'inc/html_head.php';
?>
<body class="app">
<header class="app-header fixed-top">

    <!-- ::: Header Menu ::: -->
    <div class="app-header-inner">
        <?php include('inc/header_menu.php') ?>
    </div>
    </div>
    <div id="app-sidepanel" class="app-sidepanel">
        <?php include('inc/sidebar.php') ?>
    </div><!--//app-sidepanel-->
</header><!--//app-header-->

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">

        <?php if(isset($_SESSION['res'])){ echo $_SESSION['res']; unset($_SESSION['res']);}  ?>
        <div class="container-xl">
            <div class="position-relative mb-3">
                <div class="row g-2 justify-content-between mb-3">
                    <div class="col-auto ">
                        <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">ទំព័ររបាយការណ៍ចំណូល</h1>

                            <div class="mb-2">
                            <button class="btn btn-sm btn-success rounded-5">
                            <a style="color: white; text-decoration: none;" href="reports.php">
                            <svg width="16" height="16" fill="white"
                                     class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                </svg>
                                Back
                            </a>
                            </button>
                    </div>
                    </div>
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-2 bg-body rounded-4 text-center">
                        <form action="#" method="post">
                        <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="form-select" class="form-label">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="form-select" class="form-label">Last Date</label>
                                    <input type="date" id="last_date" name="last_date" class="form-control">
                                </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" name="view_sale" id="view_sale" class="btn btn-info rounded-5">
                                View
                            </button>
                        </div>
                        </form>
                    </div>
                       
                    <!-- Table -->
                    <div class="container p-3 mt-2 shadow p-3 mb-2 rounded-4">
                    <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5 mt-1">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table id="tblproduct" class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Buyer Name</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Amount</th>
                                                <th class="cell">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div> 
                    </div><!--end table-->
                    </div>
                </div>
            </div>
        </div><!--//container-fluid-->
        <footer id="footbarlog" class="app-footer">
        <?php include('inc/footer.php') ?>
        </footer><!--//app-footer-->
    </div><!--//app-content-->



<!-- ::: My Script ::: -->
<?php include('contents/My_Scripts.php') ?>

</body>
</html>

