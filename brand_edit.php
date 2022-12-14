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

            <?php

                if (!isset($_GET['id']) or $_GET['id'] == '') {
                    header('Location: brand.php');
                }

                // get data for update
                // $data = $con->query("SELECT * FROM tbl_brand WHERE brand_id = ". $_GET['id'])->fetch(PDO::FETCH_OBJ);

                $brandData = $con->prepare("SELECT * FROM tbl_brand WHERE brand_id = ?");
                $brandData->bindParam(1, $_GET['id']);
                $brandData->execute();
                $brand_items = $brandData->fetch(PDO::FETCH_BOTH);

                // if click on update
                if (isset($_POST['update_brand'])) {
                    $brand_name = $_POST['brand_name'];
                    $description = $_POST['description'];
                    $brand_id = $_GET['id'];

                    if (empty($brand_name)) {
                        echo '
                            <div class="alert alert-warning alert-dismissible fade show">
                                <strong>Message!</strong> Please input a correct data.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        ';
                    } else {

                        // update data
                        $sql = $con->prepare("UPDATE tbl_brand SET brand_name=?, description=? WHERE brand_id = ? ");
                        $sql->bindParam(1, $brand_name);
                        $sql->bindParam(2, $description);
                        $sql->bindParam(3, $brand_id);

                        // if update success
                        if ($sql->execute()) {
                            
                            // get data if updated
                            $brandData = $con->prepare("SELECT * FROM tbl_brand WHERE brand_id = ?");
                            $brandData->bindParam(1, $_GET['id']);
                            $brandData->execute();
                            $brand_items = $brandData->fetch(PDO::FETCH_BOTH);

                            echo '
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Message!</strong> Updated Data Success.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            ';

                        } else {
                            // if not success
                            echo '
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Message!</strong> Error Update Data, Some data is already exist.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            ';
                        }
                    }
                }
            ?>

            <?php 
                if (isset($_SESSION['res'])) {
                    echo $_SESSION['res'];
                    unset($_SESSION['res']);
                }  
            ?>

            <div class="container-xl">
                <div class="position-relative mb-3">
                    <div class="row g-2 justify-content-between mb-3">
                        <div class="col-auto ">
                            <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large" class="app-page-title mb-2">??????????????????????????????????????????????????????</h1>
                        </div>
                        <div class="container bg-white p-3 mt-3 shadow p-3 mb-5 bg-body rounded-4">

                            <!-- form update -->
                            <form action="#" method="post">

                                <!-- btn back -->
                                <div class="mb-3">
                                    <a href="brand.php" title="Back">
                                        <svg width="25" height="25" fill="green" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                        </svg>
                                    </a>
                                </div>

                                <!-- inputs -->
                                <div class="row  text-center">
                                    <!-- brand name -->
                                    <div class="col-md-6 mb-3 mt-3">
                                        <label class="form-label">Brand Name</label>
                                        <input type="text" value="<?= $brand_items['brand_name'] ?>" name="brand_name" class="form-control" placeholder="Brand Name">
                                    </div>
                                    <!-- description -->
                                    <div class="col-md-6 mb-3 mt-3">
                                        <label class="form-label">Description or Notes</label>
                                        <!-- <textarea name="description" class="form-control" rows="10" cols="10"><?= $brand_items['description'] ?>
                                        </textarea> -->
                                        <input type="text" value="<?= $brand_items['description'] ?>" name="description" class="form-control" placeholder="Description">
                                    </div>
                                </div>

                                <!-- btn update -->
                                <div class="mt-2 text-center">
                                    <button class="btn btn-success rounded-5" type="submit" name="update_brand">
                                        <a>
                                            <svg width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                            Update
                                        </a>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-content-->

        <footer id="footbarlog" class="app-footer">
            <?php include('inc/footer.php') ?>
        </footer>
        <!--//app-footer-->

    </div>

    <!-- ::: My Script ::: -->
    <?php include('contents/My_Scripts.php') ?>
</body>

</html>
