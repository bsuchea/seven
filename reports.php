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
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-5 bg-body rounded-5 border border-success">
                    <div class="row text-center">
                        <div style="background-color:#15a362 ;" class="col border rounded-5 ml-2 p-2">
                            <div class="text-center">
                                    <a href="sale_report.php">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files"
                                         fill="white" >
	  								<path fill-rule="evenodd"
                                          d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
	  								<path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/></svg>
                                    </a>
                            </div>
                            <a style="text-decoration: none; color:white;" href="sale_report.php">Sale Report</a>
                        </div>
                        <div style="background-color:#15a362 ;" class="col border rounded-5 ml-2 mr-2 p-2">
                            <div class="text-center">
                                    <a href="purchase_report.php">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files"
                                         fill="white" >
	  								<path fill-rule="evenodd"
                                          d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
	  								<path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/></svg>
                                    </a>
                            </div>
                            <a style="text-decoration: none; color:white;" href="purchase_report.php">Purchase Report</a>
                        </div>
                        <div style="background-color:#15a362 ;" class="col border rounded-5 mr-2 p-2">
                            <div class="text-center">
                                    <a href="salary_report.php">
                                    <svg width="20" height="20" fill="white" class="bi bi-currency-dollar"
                                     viewBox="0 0 16 16">
  									<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/></svg>
                                    </a>                            
                            </div>
                            <a style="text-decoration: none; color:white;" href="salary_report.php">Salary Report</a>
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
