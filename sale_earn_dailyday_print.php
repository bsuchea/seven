<?php
require_once 'config/checklogin.php';
require_once 'config/db.php';
require_once 'inc/html_head.php';
?>

<body class="app">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <?php if (isset($_SESSION['res'])) {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
        } ?>

        <?php
        // $limit = 10;
        // if (isset($_GET["page"])) {
        //     $page = $_GET["page"];
        // } else {
        //     $page = 1;
        // }
        // $start_from = ($page - 1) * $limit;

        $date = date('Y-m-d');

        $sql_select = $con->prepare("SELECT sale_date, sale_cost FROM tbl_sale WHERE sale_date LIKE '$date%' ORDER BY sale_date ASC ");
        $sql_select->execute();

        $i = 0;
        $totalAmount = 0;

        ?>

        <div class="container-xl">
            <div class="position-relative mb-3">
                <div class="position-relative mb-3">
                    <div class="row g-2 justify-content-between mb-1">
                        <div class="col-auto">
                            <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large" class="app-page-title mb-3">
                                របាយការណ៍ចំណូលប្រចាំថ្ងៃ
                            </h1>
                            <div class="mb-2">
                                Date : <?= $date ?>
                            </div>

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
                                                    <th class="cell">Date</th>
                                                    <th class="cell">Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

                                                foreach ($sql_select as $row) :
                                                    $i++;
                                                ?>
                                                    <tr id="user">
                                                        <td class="text-center"><?= $i ?></td>
                                                        <td><?= $row['sale_date'] ?></td>
                                                        <td><?= $row['sale_cost'] ?></td>
                                                    </tr>
                                                <?php
                                                    $totalAmount += $row['sale_cost'];
                                                endforeach;
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                    <!--//table-responsive-->

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


        <!-- ::: My Script ::: -->
        <?php include('contents/My_Scripts.php') ?>

        <script type="text/javascript">
            window.print();
            window.outfocus = function() {
                window.close
            }
        </script>
</body>