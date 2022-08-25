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
                        <h1 style="font-family: 'Kh Dangrek'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">ទំព័រស្តុកទំនិញ</h1>
                            <div class="mb-2">
                            <a href="item_create.php" title="Add Item">
                                <svg width="25" height="25" fill="green" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </a>
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
                                            <th class="cell">Description</th>
                                            <th></th>
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
                                                                    tbl_item.unit_price, tbl_item.item_description FROM ((tbl_item
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
                                                <td><?= $row->item_description ?></td>
                                                <td class="td-actions text-center">
                                                    <a href="item_edit.php?id=<?= $row->item_id ?>" class="p-2" title="Edit">
                                                        <svg width="20" height="20" fill="currentColor"
                                                             class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                            Edit
                                                        </svg>
                                                    </a>
                                                    <a href="#" class="text-danger" onclick="delItem(<?= $row->item_id ?>)" class="p-2" title="Delete">
                                                        <svg width="20" height="20" fill="currentColor"
                                                             class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            Delete    
                                                        </svg>
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
                                            <th class="cell">Description</th>
                                            <th></th>
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
