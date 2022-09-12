<?php
    $page = explode('/', $_SERVER["REQUEST_URI"]);
    $page = end($page);
    $p = '';
    if($page!=''){
        $page = explode('?', $page);
//        if(isset($page[1])){
//            $page[1] = explode('=', $page[1]);
//            $p = end($page[1]);
//        }else{
//            $p = basename($page[0],'.php');
//        }
        $p = basename($page[0],'.php');
    }else{
        $p = "dashboard";
    }
 ?>

<div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
            <div class="app-branding mt-2">
                <a style="text-decoration:none; font-family:'Bauhaus 93';" id="color" class="app-logo"
                   href="dashboard.php"><img class="logo-icon me-2 rounded-circle" src="assets/images/Logo.jpg"
                                        alt="logo"><span class="logo-text" style="font-size: 25px ;">Seven Esport</span></a>
            </div><!--//app-branding-->
            <?php include('config/checkpermission.php'); ?>

            <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                    <li class="nav-item">
                        <a class="nav-link <?= ($p=="dashboard" || $p=="dashboard")?'active':'' ?>" href="dashboard.php">
						        <span class="nav-icon">
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                     fill="currentColor" >
		  							<path fill-rule="evenodd"
                                          d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
		  							<path fill-rule="evenodd"
                                          d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/></svg>
						        </span>
                            <span​ class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($p=="item" || $p=="item_create" || $p=="item_edit")?'active':'' ?>" href="item.php">
						        <span class="nav-icon">
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder"
                                     fill="currentColor" >
  									<path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
  									<path fill-rule="evenodd"
                                          d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/></svg>
						        </span>
                            <span class="nav-link-text">Item</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($p=="sale" || $p=="sale_history")?'active':'' ?>" href="sale.php">
						        <span class="nav-icon">
									<svg  width="16" height="16" fill="currentColor"
                                         class="bi bi-folder-minus" viewBox="0 0 16 16">
									<path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
									<path d="M11 11.5a.5.5 0 0 1 .5-.5h4a.5.5 0 1 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
									</svg>
						        </span>
                            <span class="nav-link-text">Sale</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($p=="purchase" || $p=="purchase_history")?'active':'' ?>" href="purchase.php">
						        <span class="nav-icon">
						        <svg  width="16" height="16" fill="currentColor"
                                     class="bi bi-folder-plus" viewBox="0 0 16 16">
  									<path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
  									<path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/></svg>
						        </span>
                            <span class="nav-link-text">Purchase</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($p=="brand_and_category" || $p=="brand" || $p=="brand_create" || $p=="brand_edit" || $p=="category" || $p=="category_create" || $p=="category_edit" )?'active':'' ?>" href="brand_and_category.php">
						        <span class="nav-icon">
						            <svg width="16" height="16" fill="currentColor" class="bi bi-diagram-3" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
                                    </svg>
						        </span>
                            <span class="nav-link-text">Brand and Category</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($p=="suppliers" || $p=="supplier_create" || $p=="supplier_edit")?'active':'' ?>" href="suppliers.php">
						        <span class="nav-icon">
						        	<svg width="16" height="16" fill="currentColor" class="bi bi-people"
                                         viewBox="0 0 16 16">
  									<path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
						        </span>
                            <span class="nav-link-text">Suppliers</span>
                        </a>
                    </li>

                    <!-- Check Permission -->
                    <?php
                    $LogID = $_SESSION["Loged_id"];
                    $status = 1;
                
                    //Sql Select User Logedin
                    $sql_select_logedin = $con->prepare("SELECT * FROM tbl_user WHERE tbl_user.status = ? 
                    AND tbl_user.user_id = ?");
                
                    $sql_select_logedin->bindParam(1, $status);
                    $sql_select_logedin->bindParam(2, $LogID);
                
                    $sql_select_logedin->execute();
                    $row_select_logedin = $sql_select_logedin->fetch(PDO::FETCH_BOTH);
                
                    $_SESSION['Loged_permission'] = $row_select_logedin['permission'];
                    if ($row_select_logedin['permission'] == "Admin") {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($p=="salary")?'active':'' ?>"" href="salary.php">
						        <span class="nav-icon">
						        <svg width="16" height="16" fill="currentColor" class="bi bi-currency-dollar"
                                     viewBox="0 0 16 16">
  									<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/></svg>
						         </span>
                            <span class="nav-link-text">Salary</span>
                        </a>
                    </li>
                    <?php } ?>
                    <!-- End Check Permission -->

                    <li class="nav-item">
                        <a class="nav-link <?= ($p=="reports" || $p=="sale_report" || $p=="purchase_report")?'active':'' ?>" href="reports.php">
						        <span class="nav-icon">
						        	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files"
                                         fill="currentColor" >
	  								<path fill-rule="evenodd"
                                          d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
	  								<path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/></svg>
						        </span>
                            <span class="nav-link-text">Reports</span>
                        </a>
                    </li>

                    <?php
                    if ($row_select_logedin['permission'] == "Admin") {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($p=="user" || $p=="user_create" || $p=="user_edit")?'active':'' ?>" href="user.php">
						        <span class="nav-icon">
								<svg  width="16" height="16" fill="currentColor"
                                     class="bi bi-person-circle" viewBox="0 0 16 16">
								<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
								<path fill-rule="evenodd"
                                      d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
								</svg>
						         </span>
                            <span class="nav-link-text">Manage User</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul><!--//app-menu-->
            </nav><!--//app-nav-->
        </div><!--//sidepanel-inner-->