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
                if(isset($_POST['view_purchase'])) {
                    // get sale report
                    $saleReportData = $con->prepare("SELECT tbl_purchase.*, tbl_suppliers.*, tbl_purchase_detail.purchase_id, tbl_purchase_detail.purchase_qty, SUM(tbl_purchase_detail.item_id)total_item, SUM(tbl_purchase_detail.purchase_qty)total_qty 
                                    FROM ((tbl_purchase
                                    INNER JOIN tbl_purchase_detail ON tbl_purchase.purchase_id = tbl_purchase_detail.purchase_id)
                                    INNER JOIN tbl_suppliers ON tbl_suppliers.suppliers_id = tbl_purchase.suppliers_id)
                                    WHERE tbl_purchase.purchase_date BETWEEN ? AND ? 
                                    GROUP BY tbl_purchase_detail.purchase_id
                                    ORDER BY purchase_date ASC");
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
                            <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large" class="app-page-title mb-2">??????????????????????????????????????????????????????????????????</h1>

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

                        <div class="col-auto mt-5 mr-5">
                        <a href="#" target="_blank">
                        <button class="btn btn-sm btn-outline-success rounded-3" title="Print">  
                        Print
                        <svg width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                        </svg>  
                        </button>
                        </a>

                        <a href="#">
                        <button class="btn btn-sm btn-outline-info rounded-3" title="Export Excel">
                            Export
                            <svg width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewB="0 0 16 16">
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
                            </svg>
                        </button>
                        </a>
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
                                    <button type="submit" name="view_purchase" id="view_purchase" class="btn btn-info rounded-5">
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
                                                            <th class="cell">Suppliers Name</th>
                                                            <th class="cell">Quantity</th>
                                                            <th class="cell">Amount($)</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php 
                                                            if(isset($_POST['view_purchase'])) {
                                                                foreach ($saleReportData as $item) : 
                                                        ?>
                                                            <tr>
                                                                <th class="cell"><?= $item['purchase_date'] ?></th>
                                                                <th class="cell"><?= $item['suppliers_name'] ?></th>
                                                                <th class="cell"><?= $item['purchase_qty'] ?></th>
                                                                <th class="cell">$<?= $item['purchase_total'] ?></th>
                                                            </tr>
                                                        <?php 
                                                                $totalQTY += $item['purchase_qty']; 
                                                                $total += $item['purchase_total']; 
                                                                endforeach; 
                                                                if($total > 0) {
                                                        ?>

                                                        <!-- total -->
                                                        <tr>
                                                            <th class="cell text-center" colspan="2" style="color: green;">SubTotal</th>
                                                            <th class="cell" style="color: green;"><?= $totalQTY ?></th>
                                                            <th class="cell" style="color: green;">$<?= $total ?>.00</th>
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
