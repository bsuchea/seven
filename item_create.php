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

        if (isset($_POST['add_item'])) {
            $item_name = $_POST['item_name'];
            $brand_name = $_POST['brand_name'];
            $category = $_POST['category'];
            $current_stock = $_POST['current_stock'];
            $unit_price = $_POST['unit_price'];
            $created_date = $_POST['created_date'];
            $description = $_POST['description'];

            if (empty($item_name) || empty($brand_name) || empty($category) || empty($current_stock) || empty($unit_price) || empty($created_date)) {
                echo '
				<div class="alert alert-warning alert-dismissible fade show">
					<strong>Message!</strong> Please input a correct data.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			';
            } else {

                $sql = $con->prepare("INSERT INTO tbl_item(item_name, brand_id, 
                                    category_id, current_stock, unit_price, created_date, item_description, status) 
                                    VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bindParam(1, $item_name);
                $sql->bindParam(2, $brand_name);
                $sql->bindParam(3, $category);
                $sql->bindParam(4, $current_stock);
                $sql->bindParam(5, $unit_price);
                $sql->bindParam(6, $created_date);
                $sql->bindParam(7, $description);
                $sql->bindParam(8, $status);

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
                        <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">ទំព័រទិញទំនិញ</h1>
                    </div>
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-5 bg-body rounded-4">
                        <form action="#" method="post">
                            <div class="mb-3">
                            <a href="item.php" title="Back">
                                <svg width="25" height="25" fill="green"
                                     class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                </svg>
                        </a>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputID">Product Name</label>
                                    <input name="item_name" class="form-control" type="text" placeholder="Product Name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Brand</label>
                                    <select name="brand_name" class="form-select">
                                        <option hidden value="">Select Brand</option>
                                        <?php 
                                            $stmt = $con->query("SELECT * FROM tbl_brand");
                                            while($row = $stmt->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <option value="<?= $row->brand_id ?>"><?= $row->brand_name ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        <option hidden value="">Select Category</option>
                                        <?php 
                                            $stmt = $con->query("SELECT * FROM tbl_category");
                                            while($row = $stmt->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <option value="<?= $row->category_id ?>"><?= $row->category_name ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="current_stock" class="form-control" placeholder="Quantity" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" name="unit_price" class="form-control" placeholder="Unit Price" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Created Date</label>
                                    <input type="date" name="created_date" id="created_date" class="form-control" placeholder="Created Date">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="10" cols="10">

                                    </textarea>
                                </div>
                                </div>
                            <div class="text-center mt-3">
                                <button name="add_item" type="submit" class="btn btn-sm btn-success rounded-5">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                    </svg> Add Product</button>
                                <button type="reset" class="btn btn-sm btn-danger rounded-5">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg> Cancel</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div><!--//container-fluid-->
        <footer id="footbarlog" class="app-footer">
        <?php include('inc/footer.php') ?>
        </footer><!--//app-footer-->

    </div><!--//app-content-->


<!-- ::: My Script ::: -->

<?php include('contents/My_Scripts.php') ?>
</body>
</html>

