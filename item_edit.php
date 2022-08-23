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
            $itemname = $_POST['item_name'];
            $brand = $_POST['brand'];
            $category = $_POST['category'];
            $category = $_POST['unit_price'];
            $description = $_POST['description'];

            if (empty($itemname) || empty($brand) || empty($category) || empty($description)) {
                echo '
				<div class="alert alert-warning alert-dismissible fade show">
					<strong>Message!</strong> Please input a correct data.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			';
            } else {

                $sql = $con->prepare("UPDATE tbl_supplier SET WHERE ");
                $sql->bindParam(1, $itemname);
                $sql->bindParam(2, $brand);
                $sql->bindParam(3, $description);
                $sql->bindParam(4, $category);
                $sql->bindParam(5, $description);

                if ($sql->execute()) {
                    echo '
					<div class="alert alert-success alert-dismissible fade show">
						<strong>Message!</strong> Insert Data success. Now you can back.
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
                        <h1 style="font-family: 'Kh Dangrek'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">កែប្រែព័ត៌មានផលិតផល</h1>
                        <a href="item.php">
                            <button id="form_load" type="button" class="btn btn-success btn-sm col-10 mx-auto m-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                </svg>
                                Back View
                            </button>
                        </a>
                    </div>
                    <div class="p-3">
                        <form action="#" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputID">Product Name</label>
                                    <input name="itemname" value="<?= $data->item_name ?>" class="form-control" type="text" placeholder="Product Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="form-select" class="form-label">Brand</label>
                                    <select name="brand" class="form-select">
                                        <option value="MSI" <?= $data->brand_name=='MSI'?'selected':'' ?>>MSI</option>
                                        <option value="TUF" <?= $data->brand_name=='TUF'?'selected':'' ?>>TUF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="form-select" class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        <option value="Mouse" <?= $data->category_name=='Mouse'?'selected':'' ?>>Mouse</option>
                                        <option value="Monitor" <?= $data->category_name=='Monitor'?'selected':'' ?>>Monitor</option>
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
                                <button name="update_item" type="submit" class="btn btn-success">Update Item</button>
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
<?php include('contents/My_Scripts.php') ?>
</body>
</html>

