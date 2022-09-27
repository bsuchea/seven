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
        </div>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">

            <!-- session -->
            <?php 
                if (isset($_SESSION['res'])) {
                    echo $_SESSION['res'];
                    unset($_SESSION['res']);
                }  
            ?>

            <!-- get data -->
            <?php 

                $total = 0;
                $totalQTY = 0;

                // if click on view sale
                if(isset($_POST['view_sale'])) {
                    // get sale report
                    $saleReportData = $con->prepare("SELECT tbl_sale.sale_id, tbl_sale.buyer_name,
                                    tbl_sale.buyer_phone, tbl_sale.sale_cost, tbl_sale.sale_date, 
                                    tbl_sale.description, tbl_sale_detail.qty as qty 
                                    FROM tbl_sale INNER JOIN tbl_sale_detail 
                                    ON tbl_sale.sale_id = tbl_sale_detail.sale_id
                                    WHERE tbl_sale.sale_date BETWEEN ? AND ? ORDER BY sale_date ASC");
                    $saleReportData->bindParam(1, $_POST['start_date']);
                    $saleReportData->bindParam(2, $_POST['last_date']);
                    $saleReportData->execute();
                }

            ?>

            <!-- container -->
            <div class="container-xl">
                <div class="position-relative mb-3">
                    <div class="row g-2 justify-content-between mb-3">
                        
                        <!-- btn back -->
                        <div class="col-auto ">
                            <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large" class="app-page-title mb-2">ទំព័ររបាយការណ៍លក់ទំនិញ</h1>

                            <div class="mb-2">
                                <button class="btn btn-sm btn-success rounded-5">
                                    <a style="color: white; text-decoration: none;" href="reports.php">
                                        <svg width="16" height="16" fill="white" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                        </svg>
                                        Back
                                    </a>
                                </button>
                            </div>
                        </div>

                        <!-- form -->
                        <div class="container bg-white p-3 mt-3 shadow p-3 mb-2 bg-body rounded-4 text-center">
                            <form action="#" method="post">
                                <!-- inputs -->
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
                                <!-- btn view -->
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
                                    <div class="app-card app-card-orders-table shadow-sm mb-0 mt-1">
                                        <div class="app-card-body">
                                            <div class="table-responsive">
                                                <table id="tblproduct" class="table app-table-hover mb-0 text-left">
                                                    <thead>
                                                        <tr>
                                                            <th class="cell">Date</th>
                                                            <th class="cell">Buyer Name</th>
                                                            <th class="cell">Quantity</th>
                                                            <th class="cell">Amount($)</th>
                                                            <th class="cell text-center">Actions</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php 
                                                            if(isset($_POST['view_sale'])) {
                                                                foreach ($saleReportData as $item) : 
                                                        ?>
                                                            <tr>
                                                                <th class="cell"><?= $item['sale_date'] ?></th>
                                                                <th class="cell"><?= $item['buyer_name'] ?></th>
                                                                <th class="cell"><?= $item['qty'] ?></th>
                                                                <th class="cell">$<?= $item['sale_cost'] ?></th>
                                                                <th class="cell text-center">
                                                                    <!-- show -->
                                                                    <!-- <a href="view_sale_report_items.php?id=<?= $item['sale_id'] ?>" target="_blank" class="ml-1" title="View Detail">
                                                                        <svg width="20" height="20" fill="green" class="bi bi-card-text" viewB="0 0 16 16">
                                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                                        </svg>
                                                                    </a> -->
                                                                    <!-- print -->
                                                                    <a href="sale_report_print.php?id=<?= $item['sale_id'] ?>" target="_blank" id="print_sale_report" title="Print">
                                                                        <svg width="20" height="20" fill="green" class="bi bi-printer" viewB="0 0 16 16">
                                                                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                                                        </svg>
                                                                    </a>
                                                                </th>
                                                            </tr>
                                                        <?php 
                                                                $totalQTY += $item['qty']; 
                                                                $total += $item['sale_cost']; 
                                                                endforeach; 
                                                                if($total > 0) {
                                                        ?>

                                                        <!-- total -->
                                                        <tr>
                                                            <th class="cell text-center" colspan="2" style="color: green;">SubTotal</th>
                                                            <th class="cell" style="color: green;"><?= $totalQTY ?></th>
                                                            <th class="cell" style="color: green;">$<?= $total ?></th>
                                                        </tr>

                                                        <?php }} ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end table-->

                    </div>
                </div>
            </div>
        </div>

        <!--//container-fluid-->
        <footer id="footbarlog" class="app-footer">
            <?php include('inc/footer.php') ?>
        </footer>
        <!--//app-footer-->
    </div>
    <!--//app-content-->



    <!-- ::: My Script ::: -->
    <?php include('contents/My_Scripts.php') ?>

    <script>
        $(document).ready(function(){
            $("#start_date").val(new Date().toISOString().slice(0, 10));
            $("#last_date").val(new Date().toISOString().slice(0, 10));
        });
    </script>

</body>

</html>
