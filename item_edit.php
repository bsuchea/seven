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

        <?php

        if(!isset($_GET['id']) or $_GET['id'] == ''){
            header('Location: item.php');
        }
        $data = $con->query("SELECT tbl_item.item_id,
                            tbl_item.item_name, tbl_brand.brand_name,
                            tbl_category.category_name, tbl_item.current_stock,
                            tbl_item.unit_price, tbl_item.item_description FROM ((tbl_item
                            INNER JOIN tbl_brand ON tbl_item.brand_id = tbl_brand.brand_id)
                            INNER JOIN tbl_category ON tbl_item.category_id = tbl_category.category_id) WHERE tbl_item.item_id = ". $_GET['id'])->fetch(PDO::FETCH_OBJ);

        if (isset($_POST['update_item'])) {
            $item_name = $_POST['item_name'];
            $brand = $_POST['brand'];
            $category = $_POST['category'];
            $unit_price = $_POST['unit_price'];
            $description = $_POST['description'];

            if (empty($item_name) || empty($brand) || empty($category) || empty($unit_price)) {
                echo '
				<div class="alert alert-warning alert-dismissible fade show">
					<strong>Message!</strong> Please input a correct data.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			';
            } else {

                $sql = $con->prepare("UPDATE tbl_item SET item_name=?, brand_id=?,
                                     category_id=?, unit_price=?, 
                                     item_description=?  WHERE item_id = ? ");
                $sql->bindParam(1, $item_name);
                $sql->bindParam(2, $brand);
                $sql->bindParam(3, $category);
                $sql->bindParam(4, $unit_price);
                $sql->bindParam(5, $description);
                $sql->bindParam(6, $item_id);

                if ($sql->execute()) {
                    echo '
					<div class="alert alert-success alert-dismissible fade show">
						<strong>Message!</strong> Update Data Success. Now you can back.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				';
                } else {
                    echo '
					<div class="alert alert-danger alert-dismissible fade show">
						<strong>Message!</strong> Error Insert Data, Some data is already exist.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				';
                }
            }
        }
        ?>
        <?php if(isset($_SESSION['res'])){ echo $_SESSION['res']; unset($_SESSION['res']);}  ?>
        <div class="container-xl">
            <div class="position-relative mb-3">
                <div class="row g-2 justify-content-between mb-3">
                    <div class="col-auto ">
                        <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">កែប្រែព័ត៌មានផលិតផល</h1>
                    </div>
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-5 bg-body rounded-4">
                        <form action="#" method="post">
                            <div class="mb-3">
                            <a href="item.php"​ title="Back">
                                <svg width="25" height="25" fill="green"
                                     class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                </svg>
                        </a>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputID">Product Name</label>
                                    <input name="item_name" value="<?= $data->item_name ?>" class="form-control" type="text" placeholder="Product Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="form-select" class="form-label">Brand</label>
                                    <select name="brand" class="form-select">
                                    <?php 
                                            $stmt = $con->query("SELECT * FROM tbl_brand");
                                            while($row = $stmt->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <option value="<?= $row->brand_id ?>"><?= $row->brand_name ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="form-select" class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                    <?php 
                                            $stmt = $con->query("SELECT * FROM tbl_category");
                                            while($row = $stmt->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <option value="<?= $row->category_id ?>"><?= $row->category_name ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" name="unit_price" value="<?= $data->unit_price ?>" class="form-control" placeholder="Unit Price">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" value="<?= $data->item_description ?>" class="form-control" placeholder="Description">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button name="update_item" type="submit" class="btn btn-sm btn-success rounded-5">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                    </svg> Update Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--//container-fluid-->
    </div><!--//app-content-->

    <footer id="footbarlog" class="app-footer">
        <?php include('inc/footer.php') ?>
    </footer><!--//app-footer-->

</div>

<!-- ::: My Script ::: -->

<script>
    date_default_timezone_get();
    $date = date('m/d/Y h:i:s a', time());
    $(document).ready(function(){
        $("#created_date") = $date;
    });
</script>

<?php include('contents/My_Scripts.php') ?>
</body>
</html>

