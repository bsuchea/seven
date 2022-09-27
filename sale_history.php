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
                            class="app-page-title mb-3">ទំព័រប្រវត្តិនៃការលក់ទំនិញ</h1>
                            <div class="mb-2">
                            <button class="btn btn-sm btn-success rounded-5">
                            <a style="color: white; text-decoration:none;" href="sale.php" title="Back">
                                <svg width="16" height="16" fill="white"
                                     class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                </svg>
                                Back
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
                                
                                name="search_str" type="text" class="form-control mr-2" placeholder="Search Brand...">
                                
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
                        <div class="app-card app-card-orders-table shadow-sm mb-5 mt-1">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                        <tr>
                                            <th class="cell text-center">#</th>
                                            <th class="cell">Buyer Name</th>
                                            <th class="cell">Sale Total</th>
                                            <th class="cell">Sale Date</th>
                                            <th class="cell text-center">Action</th>
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
                                                $sql_select = $con->prepare("SELECT * FROM tbl_sale ORDER BY sale_id ASC LIMIT $start_from, $limit");
                                            }else{
                                                $search_str = $_GET['search_str'];
                                                $sql_select = $con->prepare("SELECT * FROM tbl_sale WHERE buyer_name
                                                LIKE '%".$_GET['search_str']."%' ORDER BY sale_id ASC LIMIT $start_from, $limit");
                                            }
                                        }else{
                                            $sql_select = $con->prepare("SELECT * FROM tbl_sale ORDER BY sale_id ASC LIMIT $start_from, $limit");
                                        }

                                        $sql_select->execute();

                                        $i = 0;

                                        while ($row = $sql_select->fetch(PDO::FETCH_OBJ)) :
                                            $i++;
                                            ?>
                                            <tr id="item<?= $row->sale_id ?>">
                                                <td class="text-center"><?= $i ?></td>
                                                <td><?= $row->buyer_name ?></td>
                                                <td><?= $row->sale_cost ?>$</td>
                                                <td><?= $row->sale_date ?></td>
                                                <td class="td-actions text-center">
                                                    <a href="view_sale.php?id=<?= $row->sale_id ?>" class="ml-1" title="View Detail">
                                                        <svg width="20" height="20" fill="green" class="bi bi-card-text" viewB="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                        </svg>
                                                    </a>
                                                    <a href="#" id="print_sale" title="Print">
                                                        <svg width="20" height="20" fill="green" class="bi bi-printer" viewB="0 0 16 16">
                                                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                                        </svg>
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="cell text-center">#</th>
                                            <th class="cell">Buyer Name</th>
                                            <th class="cell">Sale Total</th>
                                            <th class="cell">Sale Date</th>
                                            <th class="cell text-center">Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div><!--//table-responsive-->
                                <?php
                                $query = $con->query("SELECT * FROM tbl_sale");
                                $total_records = $query->rowCount();
                                $total_pages = ceil($query->rowCount() / $limit);
                                ?>
                                <nav class="app-pagination mt-4">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?> ">
                                            <a class="page-link" href="sale_history.php?page=<?= $page - 1 ?>"
                                               tabindex="-1"
                                               aria-disabled="true">Previous</a>
                                        </li>
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item active"><a class="page-link"
                                                                            href="sale_history.php?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?> ">
                                            <a class="page-link" href="sale_history.php?page=<?= $page + 1 ?>">Next</a>
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
