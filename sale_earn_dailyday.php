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
            <?php if (isset($_SESSION['res'])) {
                echo $_SESSION['res'];
                unset($_SESSION['res']);
            } ?>

            <?php
                $limit = 10;
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }
                $start_from = ($page - 1) * $limit;

                $date = date('Y-m-d');

                $sql_select = $con->prepare("SELECT buyer_name, sale_date, sale_cost FROM tbl_sale WHERE sale_date LIKE '$date%' ORDER BY sale_id ASC LIMIT $start_from, $limit");
                $sql_select->execute();

                $i = 0;
                $totalAmount = 0; 

            ?>

            <div class="container-xl">
                <div class="position-relative mb-3">
                    <div class="row g-2 justify-content-between mb-1">
                        <div class="col-auto">
                            <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large" class="app-page-title mb-3">ទំព័រព័ត៌មានចំណូលប្រចាំថ្ងៃ</h1>
                            <div class="mb-2">
                                <button class="btn btn-sm btn-success rounded-5">
                                    <a style="color: white; text-decoration:none;" href="reports.php" title="Back">
                                        <svg width="16" height="16" fill="white" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                        </svg>
                                        Back
                                    </a>
                                </button>
                            </div>

                        </div>
                        <div class="col-auto mt-5">
                                <a href="sale_earn_dailyday_print.php" target="_blank">
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
                    </div>
                    
                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-3">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cell text-center">#</th>
                                                    <th class="cell">Buyer Name</th>
                                                    <th class="cell">Date</th>
                                                    <th class="cell">Amount</th>
                                                    <th class="cell text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                
                                                foreach ($sql_select as $row) :
                                                    $i++;
                                                ?>
                                                    <tr id="user">
                                                        <td class="text-center"><?= $i ?></td>
                                                        <td><?= $row['buyer_name'] ?></td>
                                                        <td><?= $row['sale_date'] ?></td>
                                                        <td><?= $row['sale_cost'] ?></td>
                                                        <td class="td-actions text-center">
                                                            <a href="#" class="p-2" title="View Detail">
                                                                <svg width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                    View
                                                                </svg>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                <?php 
                                                    $totalAmount += $row['sale_cost'];
                                                    endforeach; 
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="cell text-center">#</th>
                                                    <th class="cell">Buyer Name</th>
                                                    <th class="cell">Date</th>
                                                    <th class="cell">Amount</th>
                                                    <th class="cell text-center">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!--//table-responsive-->

                                    <?php
                                    $query = $con->query("SELECT * FROM tbl_sale");
                                    $total_records = $query->rowCount();
                                    $total_pages = ceil($query->rowCount() / $limit);
                                    ?>
                                    <nav class="app-pagination mt-4">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?> ">
                                                <a class="page-link" href="sale_earn_dailyday.php?page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>
                                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                <li class="page-item active"><a class="page-link" href="sale_earn_dailyday.php?page=<?= $i ?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?> ">
                                                <a class="page-link" href="sale_earn_dailyday.php?page=<?= $page + 1 ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <!--//app-pagination-->
                                    <br>
                                </div>
                                <!--//app-card-body-->
                            </div>
                            <!--//app-card-->

                        </div>
                        <!--//tab-pane-->
                    </div>

                    <div style="display:flex; justify-content: right;">
                        <div style="padding: 5px 10px; font-weight: bold; font-family: 'Kantumruy Pro ExtraLight';" class="mb-2 bg-light shadow-sm rounded-4 border border-success mr-1">
                            ចំណូលដែលរកបានក្នុងថ្ងៃនេះគឺ : <span id="total"></span>$<?= $totalAmount ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <footer id="footbarlog" class="app-footer">
            <?php include('inc/footer.php') ?>
        </footer>
        <!--//app-footer-->

    </div>

    <!-- ::: My Script ::: -->
    <?php include('contents/My_Scripts.php') ?>

</body>

</html>
