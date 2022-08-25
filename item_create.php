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
                        <h1 style="font-family: 'Kh Dangrek'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">ទំព័របញ្ចូលទំនិញ</h1>
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
                                    <input name="item_name" class="form-control" type="text" placeholder="Product Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Brand</label>
                                    <select name="brand_name" class="form-select">
                                        <option hidden value="">Select Brand</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        <option hidden value="">Select Category</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="current_stock" class="form-control" placeholder="Quantity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" name="unit_price" class="form-control" placeholder="Unit Price">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Created Date</label>
                                    <input type="date" name="created_date" class="form-control" placeholder="Created Date">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Notes</label>
                                    <textarea name="description" class="form-control" rows="10" cols="10">

                                    </textarea>
                                </div>
                                </div>
                            <div class="text-center mt-3">
                                <button name="add_item" type="submit" class="btn btn-success rounded-5">Add Product</button>
                                <button type="reset" class="btn btn-danger rounded-5">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- Create Brand and Category -->
                    <div class="container bg-white shadow p-3 mb-3 bg-body rounded-4">
                        <div class="text-center">
                            <h5>Create Brand and Category</h5>
                        </div>
                        <?php
                            if (isset($_POST['create_brand'])) {
                                $brand_name = $_POST['brand_name'];

                                if (empty($brand_name)) {
                                    echo '
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <strong>Message!</strong> Please input a correct data.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                ';
                                } else {

                                    $sql = $con->prepare("INSERT INTO tbl_brand(brand_name) VALUES(?)");
                                    $sql->bindParam(1, $brand_name);

                                    if ($sql->execute()) {
                                        echo '
                                        <div class="alert alert-success alert-dismissible fade show">
                                            <strong>Message!</strong> Insert Brand Name Success.
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
                            <?php
                            if (isset($_POST['create_category'])) {
                                $category_name = $_POST['category_name'];

                                if (empty($category_name)) {
                                    echo '
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <strong>Message!</strong> Please input a correct data.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                ';
                                } else {

                                    $sql = $con->prepare("INSERT INTO tbl_category(category_name) VALUES(?)");
                                    $sql->bindParam(1, $category_name);

                                    if ($sql->execute()) {
                                        echo '
                                        <div class="alert alert-success alert-dismissible fade show">
                                            <strong>Message!</strong> Insert Category Name Success.
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
                        <form action="#" method="post">
                        <div class="row  text-center">
                            <div class="col-md-6 mb-3 mt-3">
                                <input type="text" name="brand_name" class="form-control" placeholder="Create Brand">
                                <div class="mt-2">
                                <button class="btn btn-success rounded-5" type="submit" name="create_brand">
                                <a>
                                    <svg  width="17" height="17" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    Add
                                </a>
                                </button>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mt-3">
                                <input type="text" name="category_name" class="form-control" placeholder="Create Category">
                                <div class="mt-2">
                                <button class="btn btn-success rounded-5" type="submit" name="create_category">
                                <a type="submit" name="create_category">
                                    <svg  width="17" height="17" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    Add
                                </a>
                                </button>
                                </div>
                            </div>
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

