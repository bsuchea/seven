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
            header('Location: user.php');
        }
        
        $userData = $con->prepare("SELECT * FROM tbl_user WHERE user_id = ?");
        $userData->bindParam(1, $_GET['id']);
        $userData->execute();
        $user_items = $userData->fetch(PDO::FETCH_BOTH);


        if (isset($_POST['update_user'])) {
            $fullname = $_POST['fullname'];
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $permission = $_POST['permission'];
            $password = $_POST['password'];
            $updated_date = date('Y/m/d h:i:s a', time());
            $user_id = $_GET['id'];

            if (empty($fullname) || empty($name) || empty($gender) || empty($phone) || empty($email) || empty($address)) {
                echo '
				<div class="alert alert-warning alert-dismissible fade show">
					<strong>Message!</strong> Please input a correct data.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			';
            } else {

                $sql = $con->prepare("UPDATE tbl_user SET user_fullname=?, user_gender=?, user_email=?, user_name=?, user_password=?, user_address=?, user_phone=?, permission=?, status=? WHERE user_id=? ");
                $sql->bindParam(1, $fullname);
                $sql->bindParam(2, $gender);
                $sql->bindParam(3, $email);
                $sql->bindParam(4, $name);
                $sql->bindParam(5, $password);
                $sql->bindParam(6, $address);
                $sql->bindParam(7, $phone);
                $sql->bindParam(8, $permission);
                $sql->bindParam(9, $status);
                $sql->bindParam(10, $user_id);

                if ($sql->execute()) {

                     //get data if updated
                    $userData = $con->prepare("SELECT * FROM tbl_user WHERE user_id = ?");
                    $userData->bindParam(1, $_GET['id']);
                    $userData->execute();
                    $user_items = $userData->fetch(PDO::FETCH_BOTH);

                    echo '
					<div class="alert alert-success alert-dismissible fade show">
						<strong>Message!</strong> Updated Data Success. Now you can back.
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
                            class="app-page-title mb-2">??????????????????????????????????????????????????????????????????????????????</h1>
                    </div>
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-5 bg-body rounded-4">
                        <form action="#" method="post">
                            <div class="mb-3">
                            <a href="user.php" title="Back">
                                <svg  width="25" height="25" fill="green"
                                     class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                </svg>
                            </a>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputID">Full Name</label>
                                    <input name="fullname" value="<?= $user_items['user_fullname'] ?>" class="form-control" type="text" placeholder="Full Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputID">Username</label>
                                    <input name="name" value="<?= $user_items['user_name'] ?>" class="form-control" type="text" placeholder="Username">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="Male" <?= $user_items['user_gender']=='Male'?'selected':'' ?>>Male</option>
                                        <option value="Female" <?= $user_items['user_gender']=='Female'?'selected':'' ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="<?= $user_items['user_email'] ?>" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" value="<?= $user_items['user_phone'] ?>" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" value="<?= $user_items['user_address'] ?>" class="form-control" placeholder="Address">
                                </div>
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="form-select" class="form-label">Permission</label>
                                    <select name="permission" class="form-select">
                                        <option value="Admin" <?= $user_items['permission']=='Admin'?'selected':'' ?>>Admin</option>
                                        <option value="User" <?= $user_items['permission']=='User'?'selected':'' ?>>User</option>
                                        <option value="Vendor" <?= $user_items['permission']=='Vendor'?'selected':'' ?>>Vendor</option>
                                    </select>
                            </div>
                            <div class="form-group col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" value="<?= $user_items['user_password'] ?>" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button name="update_user" type="submit" class="btn btn-sm btn-success rounded-5">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                    </svg> Update</button>
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

