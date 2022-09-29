<?php
require_once 'config/checklogin.php';
require_once 'config/db.php';
require_once 'inc/html_head.php';
?>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<style>
    .total-box {
        display: flex;
        justify-content: end;
        align-items: center;
    }
</style>

<body class="app">

    <?php
            //show staff name
            $LogID = $_SESSION["Loged_id"];
            $status = 1;

            //Sql Select User Logedin
            $sql_select_logedin = $con->prepare("SELECT * FROM tbl_user WHERE tbl_user.status = ? 
            AND tbl_user.user_id = ?");

            $sql_select_logedin->bindParam(1, $status);
            $sql_select_logedin->bindParam(2, $LogID);

            $sql_select_logedin->execute();
            $row_select_logedin = $sql_select_logedin->fetch(PDO::FETCH_BOTH);
            //end show staff name
                
        // if has sale id
        if (!isset($_GET['id']) or $_GET['id'] == '') {
            header('Location: sale.php');
        }

        // variable
        $i = 1;
        $totalQTY = 0;
        $totalAmount = 0;

        // get sale data
        $saleReportData = $con->prepare("SELECT * FROM tbl_sale WHERE sale_id = ?");
        $saleReportData->bindParam(1, $_GET['id']);
        $saleReportData->execute();
        $sale_report_data = $saleReportData->fetch(PDO::FETCH_BOTH);

        // get sale detail
        $saleDetail = $con->prepare("SELECT tbl_sale_detail.*, tbl_item.* FROM tbl_sale_detail
            INNER JOIN tbl_item ON tbl_sale_detail.item_id = tbl_item.item_id
            WHERE tbl_sale_detail.sale_id = ? ORDER BY item_name ASC");
        $saleDetail->bindParam(1, $_GET['id']);
        $saleDetail->execute();

    ?>


    <div class="page-content container">

        <!-- header -->
        <div class="page-header text-blue-d2">

        </div>

        <!-- container -->
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    
                    <!-- logo -->
                    <div class="row">
                        <div class="col-12">
                        <div class="app-branding text-center">
                            <a style="text-decoration:none; font-family:'Bauhaus 93';" id="color" class="app-logo"
                                    href="dashboard.php"><img class="logo-icon me-2 rounded-circle" src="assets/images/Logo.jpg"
                                        alt="logo"><span class="logo-text" style="font-size: 25px ;">Seven Esport</span></a>
                        </div><!--//app-branding-->
                        </div>
                    </div>
                    <!-- .row -->

                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <!-- buyer -->
                    <div class="row">
                        <!-- buyer info -->
                        <div class="col-sm-6">
                        <div class="mt-1 mb-1 text-secondary-m1 text-600 text-125" style="font-family: 'Kantumruy Pro ExtraLight';">
                                    <h5><strong>ព័ត៌មានអតិថិជន</strong></h5>
                                    
                                </div>
                            <div>
                                <svg width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewB="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                                <span class="text-sm text-grey-m2 align-middle" style="font-family: 'Kantumruy Pro ExtraLight';"><strong>ឈ្មោះអតិថិជន : </strong></span>
                                <span class="text-600 text-110 text-blue align-middle"><?= $sale_report_data['buyer_name'] ?></span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1"><svg width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewB="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg><span style="font-family:'Kantumruy Pro ExtraLight';"><strong> លេខអតិថិជន : </strong></span> <?= $sale_report_data['buyer_phone']?></div>
                            </div>
                        </div>
                        

                        <!-- price -->
                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-1 text-secondary-m1 text-600 text-125 " style="font-family: 'Kantumruy Pro ExtraLight';">
                                    <h5><strong>ព័ត៌មានហាង</strong></h5>
                                    
                                </div>
                                                                
                                <div class="my-2" style="font-family: Kantumruy Pro ExtraLight;">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewB="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                <span class="text-600 text-90"><strong> បុគ្គលិក : <?= $row_select_logedin['user_fullname'] ?></span></strong></div>

                                <div class="my-2" style="font-family: Kantumruy Pro ExtraLight;">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewB="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                    </svg>
                                <span class="text-600 text-90"><strong>លេខបុគ្គលិក : <?= $row_select_logedin['user_phone'] ?></span> </strong></div>

                                <div class="my-2" style="font-family: Kantumruy Pro ExtraLight;">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-calendar-fill" viewB="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                <span class="text-600 text-90"><strong>កាលបរិច្ឆេទ : </span> <?= $sale_report_data['sale_date'] ?></strong></div>

                            </div>
                        </div>
                
                    </div>

                    <div class="mt-4">

                        <!-- table -->
                        <div class="row text-600 text-black bgc-default-tp1 py-25 bg-info border border-info rounded-3 p-3">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-9 col-sm-5">Product Name</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                            <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                            <div class="col-2">Amount</div>
                        </div>

                        <div class="text-95 text-secondary-d3">

                            <?php foreach($saleDetail as $items): ?>
                                <div class="row mb-2 mb-sm-0 py-25 p-3 border border-info rounded-3">
                                    <div class="d-none d-sm-block col-1"><?= $i++ ?></div>
                                    <div class="col-9 col-sm-5"><?= $items['item_name'] ?></div>
                                    <div class="d-none d-sm-block col-2"><?= $items['qty'] ?></div>
                                    <div class="d-none d-sm-block col-2 text-95">$<?= $items['unit_price'] ?></div>
                                    <div class="col-2 text-secondary-d2">$<?= $items['qty'] * $items['unit_price'] ?></div>
                                </div>
                            <?php 
                                $totalQTY += $items['qty'];
                                $totalAmount += $items['qty'] * $items['unit_price'];
                                endforeach 
                            ?>
                        </div>

                        <div class="row mt-5 total-box">

                            <div class="col-5 col-sm-3 text-grey text-90 order-first order-sm-last border border-info rounded-3 bg-info">
                                <strong><div class="row my-2">
                                    <div class="col-7 text-right">
                                        Total Quantity
                                    </div>
                                    <div class="col-5">
                                        <span class="text-120 text-secondary-d1"><?= $totalQTY ?></span>
                                    </div>
                                </div></strong>

                                <strong><div class="row my-2 align-items-center bgc-primary-l3 p-1">
                                    <div class="col-7 text-right">
                                        Total Amount
                                    </div>
                                    <div class="col-5">
                                        <span class="text-150 text-success-d3 opacity-2">$<?= $totalAmount ?></span>
                                    </div>
                                </div></strong>
                            </div>

                        </div>

                        <hr />

                        <div style="font-family: 'Kantumruy Pro ExtraLight'; font-style: italic;">
                            <span class="text-secondary-d1 text-105"><strong> សូមអរគុណសម្រាប់ការជាវទំនិញពីហាងយើងខ្ញុំ</strong></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer id="footbarlog" class="app-footer">
        <?php include('inc/footer.php') ?>
    </footer>

</body>

</html>

<script type="text/javascript">

    window.print();
    window.outfocus = function() {
        window.close
    }
    
</script>
