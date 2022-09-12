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
                        <div> <input type="text" class="form-control" placeholder="Search..."></div>

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
                                            <th class="cell">Product Name</th>
                                            <th class="cell">Brand</th>
                                            <th class="cell">Category</th>
                                            <th class="cell">Stock</th>
                                            <th class="cell">Unit Price</th>
                                            <th class="cell">Date</th>
                                            <th class="cell text-center">Description</th>
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
                                        $sql_select = $con->prepare("SELECT tbl_item.item_id,
                                                                    tbl_item.item_name, tbl_brand.brand_name as brand_name,
                                                                    tbl_category.category_name as category_name, tbl_item.current_stock,
                                                                    tbl_item.unit_price, tbl_item.created_date, tbl_item.item_description FROM ((tbl_item
                                                                    INNER JOIN tbl_brand ON tbl_item.brand_id = tbl_brand.brand_id)
                                                                    INNER JOIN tbl_category ON tbl_item.category_id = tbl_category.category_id) ORDER BY item_id ASC LIMIT $start_from, $limit");

                                        $sql_select->execute();

                                        $i = 0;

                                        while ($row = $sql_select->fetch(PDO::FETCH_OBJ)) :
                                            $i++;
                                            ?>
                                            <tr id="item<?= $row->item_id ?>">
                                                <td class="text-center"><?= $i ?></td>
                                                <td><?= $row->item_name ?></td>
                                                <td><?= $row->brand_name ?></td>
                                                <td><?= $row->category_name ?></td>
                                                <td><?= $row->current_stock ?></td>
                                                <td>$<?= $row->unit_price ?></td>
                                                <td><?= $row->created_date ?></td>
                                                <td><?= $row->item_description ?></td>
                                                <td class="td-actions text-center">
                                                    <a href="item_edit.php?id=<?= $row->item_id ?>" class="p-2" title="View Detail">
                                                        <svg  width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                        View </svg>
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                        <th class="cell text-center">#</th>
                                            <th class="cell">Product Name</th>
                                            <th class="cell">Brand</th>
                                            <th class="cell">Category</th>
                                            <th class="cell">Stock</th>
                                            <th class="cell">Unit Price</th>
                                            <th class="cell">Date</th>
                                            <th class="cell text-center">Description</th>
                                            <th class="cell text-center">Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div><!--//table-responsive-->
                                <?php
                                $query = $con->query("SELECT tbl_item.item_id,
                                                    tbl_item.item_name, tbl_brand.brand_name,
                                                    tbl_category.category_name, tbl_item.current_stock,
                                                    tbl_item.unit_price FROM ((tbl_item
                                                    INNER JOIN tbl_brand ON tbl_item.brand_id = tbl_brand.brand_id)
                                                    INNER JOIN tbl_category ON tbl_item.category_id = tbl_category.category_id)");
                                $total_records = $query->rowCount();
                                $total_pages = ceil($query->rowCount() / $limit);
                                ?>
                                <nav class="app-pagination mt-4">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?> ">
                                            <a class="page-link" href="item.php?page=<?= $page - 1 ?>"
                                               tabindex="-1"
                                               aria-disabled="true">Previous</a>
                                        </li>
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item active"><a class="page-link"
                                                                            href="item.php?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?> ">
                                            <a class="page-link" href="item.php?page=<?= $page + 1 ?>">Next</a>
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

<!-- Modal Customer -->
<script type="text/javascript">
    function delItem(id){
        swal.fire({
            title: "Are you sure?",
            text: "Do you really want to remove this Product?",
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: 'Delete',
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                // Ajax processing or redirect back
                $.ajax({
                    url: 'ajax/item_delete.php',
                    cache: false,
                    data: {id: id},
                    success: function(e){
                        $('#item'+id).fadeOut();
                        Swal.fire(e, '', 'success');
                    }, error: function(e){
                        console.log(e.responseText);
                    }
                });
                
            }
        })
    }

</script>
</body>
</html>