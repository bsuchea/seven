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
            $salary = $_POST['salary'];
            $bonus = $_POST['bonus'];
            $salary_date = $_POST['salary_date'];
            $notes = $_POST['notes'];

            //  date_default_timezone_set('Asia/Bangkok');
            // $created_date = date('d-m-Y h:i:s a', time());
            // $updated_date = date('Y/m/d h:i:s a', time());
            // $status = 1;

            if (empty($vendor_name) || empty($notes) || empty($salary)){
                echo '
				<div class="alert alert-warning alert-dismissible fade show">
					<strong>Message!</strong> Please input a correct data.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			';
            } else {

                $sql = $con->prepare("INSERT INTO tbl_salary(user_id, salary, bonus, salary_date, notes) VALUES(?, ?, ?, ?, ?)");
                $sql->bindParam(1, $vendor_name);
                $sql->bindParam(2, $salary);
                $sql->bindParam(3, $bonus);
                $sql->bindParam(4, $salary_date);
                $sql->bindParam(5, $notes);

                if ($sql->execute()) {
                    echo '
					<div class="alert alert-success alert-dismissible fade show">
						<strong>Message!</strong> Insert Data success.
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
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-5 bg-body rounded-4">
                        <form action="#" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="form-select" class="form-label" >Vendor Name</label>
                                    <select name="vendor_name" class="form-select" required>
                                        <option hidden value="">Select Vendor</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Salary</label>
                                    <input type="text" name="salary" class="form-control" placeholder="Salary"  required>
                                </div>
                                </div>

                                <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Bonus</label>
                                    <input type="text" name="bonus" class="form-control" placeholder="Bonus">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="salary_date" class="form-control" placeholder="Date" required>
                                </div>
                                </div>
                                <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Notes</label>
                                    <textarea name="notes" class="form-control" rows="10" cols="10">

                                    </textarea>
                                </div>
                                </div>
                            <div class="text-center mt-3">
                                <button name="add_salary" type="submit" class="btn btn-sm btn-success rounded-5">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                    </svg> Done</button>
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

