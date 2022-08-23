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

        if (isset($_POST['add_user'])) {
            $fullname = $_POST['fullname'];
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $permission = $_POST['permission'];
            $password = $_POST['password'];

            //  date_default_timezone_set('Asia/Bangkok');
            // $created_date = date('d-m-Y h:i:s a', time());
            // $updated_date = date('Y/m/d h:i:s a', time());
            // $status = 1;

            if (empty($name) || empty($gender) || empty($phone) || empty($email) || empty($address) || empty($permission) || empty($password)){
                echo '
				<div class="alert alert-warning alert-dismissible fade show">
					<strong>Message!</strong> Please input a correct data.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			';
            } else {

                $sql = $con->prepare("INSERT INTO tbl_user(user_fullname, user_name, user_gender, user_email, user_phone, user_address, permission, user_password, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bindParam(1, $fullname);
                $sql->bindParam(2, $name);
                $sql->bindParam(3, $gender);
                $sql->bindParam(4, $email);
                $sql->bindParam(5, $phone);
                $sql->bindParam(6, $address);
                $sql->bindParam(7, $permission);
                $sql->bindParam(8, $password);
                $sql->bindParam(9, $status);

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
                            class="app-page-title mb-2">ទំព័រព័ត៌មានអ្នកប្រើប្រាស់</h1>
                        <a href="user.php">
                            <button id="form_load" type="button" class="btn btn-success btn-sm col-8 mx-auto m-2">
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
                                <div class="form-group col-md-4">
                                    <label for="inputID">Full Name</label>
                                    <input name="fullname" class="form-control" type="text" placeholder="Full Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputID">Username</label>
                                    <input name="name" class="form-control" type="text" placeholder="Username">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option hidden value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Address">
                                </div>
                                </div>
                            
                            <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="form-select" class="form-label">Permission</label>
                                    <select name="permission" class="form-select">
                                        <option hidden value="">Set Permission</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                            </div>
                            <div class="form-group col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button name="add_user" type="submit" class="btn btn-success">Add User</button>
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
