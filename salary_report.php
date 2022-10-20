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
        <?php if (isset($_SESSION['res'])) {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
        } ?>
        <div class="container-xl">
            <div class="position-relative mb-3">
                <div class="row g-2 justify-content-between mb-2">
                    <div class="col-auto">
                        <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large"
                            class="app-page-title mb-3">ទំព័ររបាយការណ៍ប្រាក់បៀរវត្ស</h1>
                                  
                            <!-- print and excel -->
                            <div>
                            <button class="btn btn-sm btn-success rounded-5">
                                    <a style="color: white; text-decoration:none;" href="reports.php" title="Back">
                                        <svg width="16" height="16" fill="white" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                                        </svg>
                                        Back
                                    </a>
                                </button>

                                <a href="salary_print_report.php" target="_blank">
                                <button class="btn btn-sm btn-outline-success rounded-3" title="Print">  
                                Print
                                <svg width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                </svg>  
                                </button>
                                </a>

                                <a href="#">
                                <button class="btn btn-sm btn-outline-info rounded-3" title="Export Excel">
                                    Export
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewB="0 0 16 16">
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
                                    </svg>
                                </button>
                            </a>
                    </div>    
                    </div>

                    <div class="col-auto mb-2">
                        <div><br></div>
                        <div > 
                            <form  action="#" method="GET" >
                                <div class="d-flex">

                              
                                <input 

                                value="<?php if(isset($_GET['seach'])){echo $_GET['search_str'];} else{$_GET['search_str']='';} ?>"
                                
                                name="search_str" type="text" class="form-control mr-2" placeholder="Search Name...">
                                
                                <button class="btn btn-sm btn-outline-success rounded-5" type="submit" name="seach">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-search" viewB="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg> Search</button> 
                                </div>
                            </form>
                         </div>
                     
                    </div>
                </div>
                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                         aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                        <tr>
                                            <th class="cell text-center">#</th>
                                            <th class="cell">Vendor</th>
                                            <th class="cell">Salary</th>
                                            <th class="cell">Bonus</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Description</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $limit = 10;
                                        if (isset($_GET["page"])) {
                                            $page = $_GET["page"];
                                        } else {
                                            $page = 1;
                                        }
                                        $start_from = ($page - 1) * $limit;

                                        if(isset($_GET['seach'])){
                                            if($_GET['search_str']==''){
                                                $sql_select = $con->prepare("SELECT tbl_salary.*, tbl_user.* FROM tbl_salary 
                                                                            INNER JOIN tbl_user ON tbl_salary.user_id = tbl_user.user_id 
                                                                            ORDER BY salary_id ASC LIMIT $start_from, $limit");
                                            }else{
                                                $search_str = $_GET['search_str'];
                                                $sql_select = $con->prepare("SELECT tbl_salary.*, tbl_user.* FROM tbl_salary 
                                                INNER JOIN tbl_user ON tbl_salary.user_id = tbl_user.user_id WHERE user_fullname
                                                LIKE '%".$_GET['search_str']."%' ORDER BY permission ASC LIMIT $start_from, $limit");
                                            }
                                        }else{
                                            $sql_select = $con->prepare("SELECT tbl_salary.*, tbl_user.* FROM tbl_salary 
                                                                        INNER JOIN tbl_user ON tbl_salary.user_id = tbl_user.user_id 
                                                                        ORDER BY salary_id ASC LIMIT $start_from, $limit");
                                        }
                                        

                                        $sql_select->execute();

                                        $i = 0;

                                        while ($row = $sql_select->fetch(PDO::FETCH_OBJ)) :
                                            $i++;
                                            ?>
                                            <tr id="user<?= $row->user_id ?>">
                                                <td class="text-center"><?= $i ?></td>
                                                <td><?= $row->user_fullname ?></td>
                                                <td><?= $row->salary ?>$</td>
                                                <td><?= $row->bonus ?>$</td>
                                                <td><?= $row->salary_date ?></td>
                                                <td><?= $row->notes ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="cell text-center">#</th>
                                            <th class="cell">Vendor</th>
                                            <th class="cell">Salary</th>
                                            <th class="cell">Bonus</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Description</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div><!--//table-responsive-->
                                <?php
                                $query = $con->query("SELECT * FROM tbl_user");
                                $total_records = $query->rowCount();
                                $total_pages = ceil($query->rowCount() / $limit);
                                ?>
                                <nav class="app-pagination mt-4">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?> ">
                                            <a class="page-link" href="salary_report.php?page=<?= $page - 1 ?>"
                                               tabindex="-1"
                                               aria-disabled="true">Previous</a>
                                        </li>
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item active"><a class="page-link"
                                                                            href="salary_report.php?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?> ">
                                            <a class="page-link" href="salary_report.php?page=<?= $page + 1 ?>">Next</a>
                                        </li>
                                    </ul>
                                </nav><!--//app-pagination-->
                                <br>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->


                    </div><!--//tab-pane-->
                </div>
            </div>
        </div>
    </div>

    <footer id="footbarlog" class="app-footer">
        <?php include('inc/footer.php') ?>
    </footer><!--//app-footer-->

</div>

<!-- ::: My Script ::: -->
<?php include('contents/My_Scripts.php') ?>

</body>
</html>
