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
                            class="app-page-title mb-3">ទំព័រព័ត៌មានអ្នកប្រើប្រាស់</h1>
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
                        <div> <input type="text" class="form-control" placeholder="Search..."></div>

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
                                            <th class="cell">Name</th>
                                            <th class="cell">Gender</th>
                                            <th class="cell">Phone</th>
                                            <th class="cell">Email</th>
                                            <th class="cell">Address</th>
                                            <th class="cell">Permission</th>
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
                                        $sql_select = $con->prepare("SELECT * FROM tbl_user ORDER BY permission ASC LIMIT $start_from, $limit");

                                        $sql_select->execute();

                                        $i = 0;

                                        while ($row = $sql_select->fetch(PDO::FETCH_OBJ)) :
                                            $i++;
                                            ?>
                                            <tr id="user<?= $row->user_id ?>">
                                                <td class="text-center"><?= $i ?></td>
                                                <td><?= $row->user_fullname ?></td>
                                                <td><?= $row->user_gender ?></td>
                                                <td><?= $row->user_phone ?></td>
                                                <td><?= $row->user_email ?></td>
                                                <td><?= $row->user_address ?></td>
                                                <?php
                                                        //check permission in table
                                                        if ($row->permission == "Admin") {
                                                    ?>
                                                        <td>
                                                        <span class="badge badge-pill badge-success">
                                                                <?= $row->permission ?>
                                                        </span>
                                                        </td>
                                                    <?php 
                                                        } else{
                                                    ?>
                                                        <td>
                                                        <span style="color:white ;" class="badge badge-pill badge-warning">
                                                                <?= $row->permission ?>
                                                        </span>
                                                        </td>
                                                    <?php } ?>
                                                <td class="td-actions text-center">
                                                    <a href="user_edit.php?id=<?= $row->user_id ?>" class="p-2">
                                                        <svg width="20" height="20" fill="currentColor"
                                                             class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                            Edit
                                                        </svg>
                                                    </a>
                                                    <a href="#" class="text-danger" onclick="delUser(<?= $row->user_id ?>)" class="p-2">
                                                            <svg width="20" height="20" fill="currentColor" 
                                                             class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" 
                                                                  d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
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
                                            <th class="cell">Name</th>
                                            <th class="cell">Gender</th>
                                            <th class="cell">Phone</th>
                                            <th class="cell">Email</th>
                                            <th class="cell">Address</th>
                                            <th class="cell">Permission</th>
                                            <th></th>
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
                                            <a class="page-link" href="user.php?page=<?= $page - 1 ?>"
                                               tabindex="-1"
                                               aria-disabled="true">Previous</a>
                                        </li>
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item active"><a class="page-link"
                                                                            href="user.php?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?> ">
                                            <a class="page-link" href="user.php?page=<?= $page + 1 ?>">Next</a>
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
    function delUser(id){
        swal.fire({
            title: "Are you sure?",
            text: "Do you really want to remove this User?",
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: 'Delete',
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                // Ajax processing or redirect back
                $.ajax({
                    url: 'ajax/user_delete.php',
                    cache: false,
                    data: {id: id},
                    success: function(e){
                        $('#user'+id).fadeOut();
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
