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

        if (isset($_POST['add_sale'])) {
            $item_name = $_POST['item_name'];
            $buyer_name = $_POST['buyer_name'];
            $buyer_phone = $_POST['buyer_phone'];
            $sale_qty = $_POST['sale_qty'];
            $sale_cost = $_POST['sale_cost'];
            $sale_date = $_POST['sale_date'];
            $description = $_POST['description'];
            

            if (empty($item_name) || empty($buyer_name) || empty($buyer_phone) || empty($sale_qty) || empty($sale_cost) || empty($sale_date)) {
                echo '
				<div class="alert alert-warning alert-dismissible fade show">
					<strong>Message!</strong> Please input a correct data.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			';
            } else {

                $sql = $con->prepare("INSERT INTO tbl_sale(item_id, buyer_name, buyer_phone, sale_qty, sale_cost, sale_date, description) 
                                    VALUES(?, ?, ?, ?, ?, ?, ?)");
                $sql->bindParam(1, $item_name);
                $sql->bindParam(2, $buyer_name);
                $sql->bindParam(3, $buyer_phone);
                $sql->bindParam(4, $sale_qty);
                $sql->bindParam(5, $sale_cost);
                $sql->bindParam(6, $sale_date);
                $sql->bindParam(7, $description);

                if ($sql->execute()) {
                    echo '
					<div class="alert alert-success alert-dismissible fade show">
						<strong>Message!</strong> Insert Sale Success.
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
                        <h1 style="font-family: 'Kh Dangrek'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">ទំព័រលក់ទំនិញ</h1>
                    </div>
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-5 bg-body rounded-4">
                        <form action="#" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputID">Product Name</label>
                                    <select name="item_name" class="form-select">
                                        <option hidden value="">Select Product</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="sale_qty" class="form-control" placeholder="Quantity">
                                </div>
                                </div>
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="form-select" class="form-label">Buyer Name</label>
                                    <input type="text" name="buyer_name" class="form-control" placeholder="Buyer Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="form-select" class="form-label">Buyer Phone</label>
                                    <input type="text" name="buyer_phone" class="form-control" placeholder="Buyer Phone">
                                </div>
                                </div>
                            
                            <div class="form-row">
                            
                                <div class="form-group col-md-6">
                                    <label class="form-label">Sale Total ($)</label>
                                    <input type="text" name="sale_cost" class="form-control" placeholder="Sale Total">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Sale Date</label>
                                    <input type="date" name="sale_date" class="form-control" placeholder="Sale Date">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="10" cols="10">

                                    </textarea>
                                </div>
                                </div>
                            <div class="text-center mt-3">
                                <button name="add_sale" type="submit" class="btn btn-sm btn-success rounded-5">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                    </svg> Sale</button>
                                <button type="reset" class="btn btn-sm btn-danger rounded-5">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg> Cancel</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div><!--//container-fluid-->
        <footer id="footbarlog" class="app-footer">
        <?php include('inc/footer.php') ?>
        </footer><!--//app-footer-->
    </div><!--//app-content-->



<!-- ::: My Script ::: -->
<?php include('contents/My_Scripts.php') ?>
</body>
</html>

