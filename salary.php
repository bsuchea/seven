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

        if (isset($_POST['add_salary'])) {
            $vendor_name = $_POST['vendor_name'];
            $vendor_gender = $_POST['vendor_gender'];
            $vendor_phone = $_POST['vendor_phone'];
            $vendor_email = $_POST['vendor_email'];
            $vendor_address = $_POST['vendor_address'];
            $salary = $_POST['salary'];
            $bonus = $_POST['bonus'];
            $salary_date = $_POST['salary_date'];

            //  date_default_timezone_set('Asia/Bangkok');
            // $created_date = date('d-m-Y h:i:s a', time());
            // $updated_date = date('Y/m/d h:i:s a', time());
            // $status = 1;

            if (empty($vendor_name) || empty($vendor_gender) || empty($salary_date) || empty($salary) || empty($vendor_email) || empty($vendor_phone) || empty($vendor_address)){
                echo '
				<div class="alert alert-warning alert-dismissible fade show">
					<strong>Message!</strong> Please input a correct data.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			';
            } else {

                $sql = $con->prepare("INSERT INTO tbl_salary(vendor_name, vendor_gender, vendor_phone, vendor_email, vendor_address, salary, bonus, salary_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bindParam(1, $vendor_name);
                $sql->bindParam(2, $vendor_gender);
                $sql->bindParam(3, $vendor_phone);
                $sql->bindParam(4, $vendor_email);
                $sql->bindParam(5, $vendor_address);
                $sql->bindParam(6, $salary);
                $sql->bindParam(7, $bonus);
                $sql->bindParam(8, $salary_date);

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
                            class="app-page-title mb-2">ទំព័រប្រាក់បៀរវត្ស</h1>
                    </div>
                    <div class="p-3">
                        <form action="#" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputID">Vendor Name</label>
                                    <input name="vendor_name" class="form-control" type="text" placeholder="Vendor Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Gender</label>
                                    <select name="vendor_gender" class="form-select">
                                        <option hidden value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputID">Vendor Phone</label>
                                    <input name="vendor_phone" class="form-control" type="text" placeholder="Vendor Phone">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Vendor Email</label>
                                    <input type="email" name="vendor_email" class="form-control" placeholder="Vendor Email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Vendor Address</label>
                                    <input type="text" name="vendor_address" class="form-control" placeholder="Vendor Address">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Salary</label>
                                    <input type="text" name="salary" class="form-control" placeholder="Salary">
                                </div>
                                </div>

                                <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Bonus</label>
                                    <input type="text" name="bonus" class="form-control" placeholder="Bonus">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="salary_date" class="form-control" placeholder="Date">
                                </div>

                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button name="add_salary" type="submit" class="btn btn-success">Done</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
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

