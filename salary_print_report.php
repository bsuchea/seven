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

        $sql_select = $con->prepare("SELECT tbl_salary.*, tbl_user.* FROM tbl_salary 
                                    INNER JOIN tbl_user ON tbl_salary.user_id = tbl_user.user_id 
                                    ORDER BY salary_id ");
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
                                របាយការណ៍ប្រាក់បៀរវត្ស
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
                                                    <th class="cell">Vendor Name</th>
                                                    <th class="cell">Salary</th>
                                                    <th class="cell">Bonus</th>
                                                    <th class="cell">Date</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

                                                foreach ($sql_select as $row) :
                                                    $i++;
                                                ?>
                                                    <tr id="user">
                                                        <td class="text-center"><?= $i ?></td>
                                                        <td><?= $row['user_fullname'] ?></td>
                                                        <td><?= $row['salary'] ?>$</td>
                                                        <td><?= $row['bonus'] ?>$</td>
                                                        <td><?= $row['salary_date'] ?></td>
                                                    </tr>
                                                <?php
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