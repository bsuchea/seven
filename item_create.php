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

        if (isset($_POST['add_cus'])) {
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            // date_default_timezone_set('Asia/Bangkok');
            // $created_date = date('Y/m/d h:i:s a', time());
            // $updated_date = date('Y/m/d h:i:s a', time());
            // $status = 1;

            if (empty($name) || empty($gender) || empty($phone) || empty($email) || empty($address)) {
                echo '
				<div class="alert alert-warning alert-dismissible fade show">
					<strong>Message!</strong> Please input a correct data.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			';
            } else {

                $sql = $con->prepare("INSERT INTO tbl_customer(customer_name, customer_gender, customer_email, customer_phone, customer_address, status) VALUES(?, ?, ?, ?, ?, ?)");
                $sql->bindParam(1, $name);
                $sql->bindParam(2, $gender);
                $sql->bindParam(3, $email);
                $sql->bindParam(4, $phone);
                $sql->bindParam(5, $address);
                $sql->bindParam(6, $status);

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
                                        <option value="MSI">MSI</option>
                                        <option value="TUF">TUF</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        <option hidden value="">Select Category</option>
                                        <option value="Mouse">Mouse</option>
                                        <option value="Monitor">Monitor</option>
                                        <option value="Headset">Headset</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="qty" class="form-control" placeholder="Quantity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Unit Price</label>
                                    <input type="text" name="unit_price" class="form-control" placeholder="Unit Price">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Created Date</label>
                                    <input type="date" name="date" class="form-control" placeholder="Created Date">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button name="add_cus" type="submit" class="btn btn-success">Add Customer</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- Create Brand and Category -->
                    <div class="container bg-white shadow p-3 mb-3 bg-body rounded-4">
                        <div class="text-center">
                            <h5>Create Brand and Category</h5>
                        </div>
                        <form action="#" method="post">
                        <div class="row  text-center">
                            <div class="col-md-6 mb-3 mt-3">
                                <input type="text" name="brand_create" class="form-control" placeholder="Create Brand">
                                <div class="mt-2">
                                <a type="submit" name="create_brand">
                                    <svg  width="20" height="20" fill="green" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mt-3">
                                <input type="text" name="category_create" class="form-control" placeholder="Create Category">
                                <div class="mt-2">
                                <a type="submit" name="create_category">
                                    <svg  width="20" height="20" fill="green" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </a>
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

