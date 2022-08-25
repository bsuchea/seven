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
        <?php if (isset($_SESSION['res'])) {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
        } ?>
        <div class="container-xl">
            <div class="position-relative mb-3">
                <div class="row g-2 justify-content-between mb-1">
                    <div class="col-auto">
                        <h1 style="font-family: 'Kh Dangrek'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">ទំព័ររបាយការណ៍</h1>
                       
                    </div>
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-5 bg-body rounded-4 border border-success">
                    <div class="row text-center">
                        <div class="col border ml-2 p-2">
                            <a style="text-decoration: none; color:#15a362;" href="sale_report.php"> Sale Report</a>
                        </div>
                        <div class="col border ml-2 mr-2 p-2">
                            <a style="text-decoration: none; color:#15a362;" href="purchase_report.php"> Purchase Report</a>
                        </div>
                        <div class="col border mr-2 p-2">
                            <a style="text-decoration: none; color:#15a362;" href="salary_report.php"> Salary Report</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

</div>
</div>
<footer id="footbarlog" class="app-footer">
        <?php include('inc/footer.php') ?>
    </footer><!--//app-footer-->
</div>


<!-- ::: My Script ::: -->
<?php include('contents/My_Scripts.php') ?>
</body>
</html>
