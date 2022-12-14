<?php
require_once 'config/db.php';
require_once 'inc/html_head.php';
?>

<body class="app app-reset-password p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.php"><img class="logo-icon me-0 rounded-circle" src="assets/images/Logo.jpg" alt="logo"></a></div>
					<h2 style="color:#15a362 ; font-family: 'Kantumruy Pro ExtraLight'" class="auth-heading text-center mb-4">ទំព័រផ្លាស់ប្តូរពាក្យសម្ងាត់</h2>
					
					<div class="auth-form-container text-left">
						
						<form class="auth-form resetpass-form">                
							<div class="email mb-3">
								<!-- <label class="sr-only" for="change-password">Current Password</label> -->
								<input id="change-password" name="change-password" type="password" class="form-control login-email mb-3" placeholder="Current Password" required="required">
								<input id="change-password" name="change-password" type="password" class="form-control login-email mb-3" placeholder="New Password" required="required">
								<input id="change-password" name="change-password" type="password" class="form-control login-email mb-3" placeholder="Confirm Password" required="required">
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" class="btn btn-success app-btn-primary btn-block theme-btn col-5 mx-auto">Change Password</button>
							</div>
						</form>
						
						<div class="auth-option text-center pt-3"><a class="app-link" href="index.php" >Back to Log in</a></div>
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
					    <h5 class="mb-3 overlay-title">សូមអរគុណសម្រាប់ការដាក់ប្រើប្រាស់ប្រព័ន្ធនេះ</h5>
					    <div>ប្រព័ន្ធគ្រប់គ្រងនេះត្រូវបានសិក្សាសា្រវជ្រាវនិងបង្កើតឡើងដោយក្រុមនិស្សិត ស.ជ.ប.ដ ដែលមានសមាជិក ៣រូបគឺ <p class="m-2 mb-2">១.សែស សុវណ្ណគីរី ២.ឡុង ភ័ក្រ្ត ៣.ស៊ីវ សុវឌ្ឍនៈ</p></div>
				    </div>
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>
</html> 

