<?php
session_start();

// Cannot modify header information
ob_start();

include_once ("config/db.php");

?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Se7en Esport Management</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Se7en Esport Management System">
    <meta name="author" content="ក្រុមនិស្សិត ស.ជ.ប.ដ">    
    <link rel="shortcut icon" href="assets/images/number-7.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
	<link rel="stylesheet" href="assets/css/style.css">

</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-3"><a class="app-logo" href="index.php"><img class="logo-icon me rounded-circle" src="assets/images/Logo.jpg" alt="logo"></a></div>
					<h2 style="font-family: 'Bauhaus 93';" class="auth-heading text-center mb-3">Se7eN Esport</h2>
					<h2 style="color:#15a362 ; font-family: 'Kantumruy Pro ExtraLight'; font-size:larger" class="auth-heading text-center mb-5">សូមធ្វើការបំពេញព័ត៌មានសម្រាប់ការចូលប្រើប្រាស់</h2>
			        <div class="auth-form-container text-start">
						<form class="auth-form login-form" action="#" method="post">
						<?php
								if (isset($_POST['submit'])) {

									$user_name = $_POST['user_name'];
									$user_password = $_POST['user_password'];
									$status = 1;

									//echo $password;

									//User Login
									$sql_select = $con->prepare("SELECT * FROM tbl_user WHERE tbl_user.status = ? AND 
									tbl_user.user_name = ? AND tbl_user.user_password = ?");

									$sql_select->bindParam(1, $status);
									$sql_select->bindParam(2, $user_name);
									$sql_select->bindParam(3, $user_password);

									$sql_select->execute();

									//Check empty or not
									if(empty($user_name)){
										echo '
											<div class="alert alert-warning alert-dismissible fade show text-start">
												 Please input Username.
												<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
											</div>
										';
									}
									else if(empty($user_password)){
										echo '
											<div class="alert alert-warning alert-dismissible fade show text-start">
												 Please input Password.
												<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
											</div>
										';
									}
									else{

										//If not empty and input = True
										if($row_select = $sql_select->fetch(PDO::FETCH_BOTH)){
											echo '
												<div class="alert alert-success alert-dismissible fade show text-start">
													 Login Successful.
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
												</div>
											';

											//Set Session User Logedin
											$_SESSION['Loged_id'] = $row_select['user_id'];

											//Check Admin
											if($row_select['permission' == 'Admin'] || $row_select['permission' == 'User'] || $row_select['permission' == 'Vendor']){
												header('location: dashboard.php');
											}

										}
										else{

											//If not empty and input = false
											echo '
												<div class="alert alert-danger alert-dismissible fade show text-start text-center">
													 Invalid Username or Password. Try again.
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
												</div>
											';
										}

									}
									
								}

								?>       
							<div class="email mb-3">
								<label class="sr-only" for="username">Username</label>
								<input id="user_name" name="user_name" type="text" class="form-control signin-email" placeholder="Username" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="password">Password</label>
								<input id="signin-password" name="user_password" type="password" class="form-control signin-password" placeholder="Password" required="required">
								<span class="btn-show-pass">
									<i class="zmdi zmdi-eye"></i>
								</span>
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" name="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
							</div>
							<div class="extra mt-3 row justify-content-between">
									<div class="col-12">
										<div class="forgot-password text-center">
											<a href="change_password.php">Change password?</a>
										</div>
									</div><!--//col-6-->
								</div><!--//extra-->
						</form>
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
		    
			    <footer id="footertext" class="app-auth-footer">
				    <div class="container text-center py-3">
				         <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
			        <small class="copyright">បង្កើតដោយ៖ ក្រុមនិស្សិតសាកលវិទ្យាល័យជាតិបាត់ដំបង​ ជំនាន់ទី​ ១៥ <i class="fas fa-heart" style="color: #fb866a;"></i></small>
				       
				    </div>
			    </footer><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>
				    <div style="font-family:'Kantumruy Pro ExtraLight'; text-align:center" class="overlay-content p-3 p-lg-4 rounded">
					    <h5 class="mb-3 overlay-title">ស្វាគមន៍មកកាន់ Se7eN Esport</h5>
						<div>ប្រព័ន្ធគ្រប់គ្រងនេះត្រូវបានសិក្សាសា្រវជ្រាវនិងបង្កើតឡើងដោយក្រុមនិស្សិត ស.ជ.ប.ដ ដែលមានសមាជិក ៣រូបគឺ <p class="m-2 mb-2">១.សែស សុវណ្ណគីរី ២.ឡុង ភ័ក្រ្ត ៣.ស៊ីវ សុវឌ្ឍនៈ</p></div>
				    </div>
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>
</html> 

