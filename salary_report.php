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
                <div class="row g-2 justify-content-between mb-1">
                    <div class="col-auto">
                        <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large"
                            class="app-page-title mb-3">ទំព័ររបាយការណ៍ប្រាក់បៀរវត្ស</h1>
                            <div class="mb-2">
                            <button class="btn btn-sm btn-success rounded-5">
                            <a style="color: white; text-decoration: none;" href="user_create.php" title="Add New">
                                <svg width="16" height="16" fill="white" class="bi bi-person-plus"
                                     viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd"
                                          d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Add
                            </a>
                            </button>
                            </div>
                    </div>

                    <div class="col-auto">
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
