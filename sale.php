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

        <?php if(isset($_SESSION['res'])){ echo $_SESSION['res']; unset($_SESSION['res']);}  ?>
        <div class="container-xl">
            <div class="position-relative mb-3">
                <div class="row g-2 justify-content-between mb-3">
                    <div class="col-auto ">
                        <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">ទំព័រលក់ទំនិញ</h1>
                    </div>
                    <div class="container mb-1 text-right">
                            <button class="btn btn-sm btn-danger rounded-5">
                            <a style="color: white; text-decoration:none;" href="sale_history.php" title="History">
                                <svg width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                Sale History
                            </a>
                            </button>
                            </div>
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-2 bg-body rounded-4">
                        <form action="#" method="post">
                        <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="form-select" class="form-label">Buyer Name</label>
                                    <input type="text" id="buyer_name" name="buyer_name" class="form-control" placeholder="Buyer Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Buyer Phone</label>
                                    <input type="text" id="buyer_phone" name="buyer_phone" class="form-control" placeholder="Buyer Phone">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Sale Date</label>
                                    <input type="date" id="sale_date" name="sale_date" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputID">Product Name</label>
                                    <select name="item_name" id="item_name" class="form-select">
                                        <option hidden value="">Select Product</option>
                                        <?php 
                                            $stmt = $con->query("SELECT * FROM tbl_item");
                                            while($row = $stmt->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <option value="<?= $row->item_id ?>" data-up="<?= $row->unit_price ?>"><?= $row->item_name ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="form-select" class="form-label">Quantity</label>
                                    <input type="number" id="sale_qty" name="sale_qty" class="form-control" min="1" placeholder="Quantity">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button name="#" id="btnAdd" type="submit" class="btn btn-sm btn-info rounded-5">
                                <svg width="16" height="16" fill="white" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg> Add</button>
                            </div>
                        </form>
                    </div>
                       
                    <!-- Table -->
                    <div class="container p-3 mt-2 shadow p-3 mb-2 rounded-4">
                    <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5 mt-1">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table id="tblproduct" class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Product Name</th>
                                                <th class="cell">Quantity</th>
                                                <th class="cell">Unit Price($)</th>
                                                <th class="cell">Amount($)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div> 
                    </div><!--end table-->
                    <!-- Total -->
                    <div style="width: 20%;" class="container bg-light p-3 shadow rounded-4 mr-5 border border-success">
                        <h6>Total : <span id="total"></span>$</h6>
                    </div>
                    <!-- End Total -->
                    <div class="text-center mt-3">
                                <button name="#" type="submit" id="btnSale" class="btn btn-md btn-success rounded-5">
                                    <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                    </svg> Sale</button>
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

<script>
    let items = new Array();
    let total = 0;

    $(document).ready(function(){
        $("#sale_date").val(new Date().toISOString().slice(0, 10));
    });

    $("#btnAdd").click(function(){
        pid = $('#item_name').val();
        pname = $('#item_name option:selected').text();
        punit = $('#item_name option:selected').data('up');
        pqty = $('#sale_qty').val();
        
        if(pid == '') {errmsg('Please select Product!'); return false;}
        if(pqty == '') {errmsg('Please insert Sale Quantity!'); return false; }

        let newRowContent = "<td>"+ pname +"</td>" + "<td>"+ pqty +"</td>" +"<td>"+ punit +"</td>" + "<td>"+pqty * punit +"</td>";

        $("#tblproduct tbody").append("<tr>"+newRowContent+"</tr>");

        total += pqty * punit;

        item = {pid: pid, pqty: pqty, punit: punit};

        items.push(item);

        $("#total").text(total);

        console.log('d: ' + JSON.stringify(items));
        return false;
    });
        
    $("#btnSale").click(function(){
        b = $('#buyer_name').val();
        bp = $('#buyer_phone').val();
        date = $("#sale_date").val();
        if(b =='') {errmsg('Please input Buyer Name!'); return false;}
        if(bp =='') {errmsg('Please input Buyer Phone!'); return false;}
        $.ajax({
            url: 'ajax/sale.php',
            cache: false,
            data: {items: items,tol: total, b: b, bp: bp, d: date},
            success: function(res){
                if(res == 'success'){
                    // success
                    $('#item_name').val('');
                    $('#sale_qty').val('');
                    $("#total").text("");
                    $("#tblproduct tbody").text("");
                    $('#buyer_name').val('');
                    $('#buyer_phone').val('');
                    pid = '';
                    pname = '';
                    punit = '';
                    pqty = '';
                    b = '';
                    bp = '';
                    items = new Array();
                    total = 0;
                }
                console.log('working!');
                Swal.fire(res, '', 'success');
            }, error: function(e){
                console.log(e.responseText); 
            }
        });
        return false;
    });

    function errmsg(msg){
        Swal.fire(msg, '', 'error'); 
    }
</script>

</body>
</html>

