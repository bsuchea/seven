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

        if (isset($_POST['add_salary'])) {
            $item_name = $_POST['item_name'];
            $suppliers_name = $_POST['suppliers_name'];
            $purchase_qty = $_POST['purchase_qty'];
            $purchase_amount = $_POST['purchase_amount'];
            $purchase_total = $_POST['purchase_total'];
            $purchase_date = $_POST['purchase_date'];

            $sql = $con->prepare("INSERT INTO tbl_salary(item_id, suppliers_name, purchase_qty, purchase_amount, purchase_total, purchase_date) 
                                    VALUES(?, ?, ?, ?, ?, ?)");
            $sql->bindParam(1, $item_name);
            $sql->bindParam(2, $suppliers_name);
            $sql->bindParam(3, $purchase_qty);
            $sql->bindParam(4, $purchase_amount);
            $sql->bindParam(5, $purchase_total);
            $sql->bindParam(6, $purchase_date);
            }
        ?>
        <?php if(isset($_SESSION['res'])){ echo $_SESSION['res']; unset($_SESSION['res']);}  ?>
        <div class="container-xl">
            <div class="position-relative mb-3">
                <div class="row g-2 justify-content-between mb-3">
                    <div class="col-auto ">
                        <h1 style="font-family: 'Kantumruy Pro ExtraLight'; color:#15a362; font-size:large"
                            class="app-page-title mb-2">ទំព័រប្រាក់បៀរវត្ស</h1>
                    </div>
                    <div class="container bg-white p-3 mt-3 shadow p-3 mb-2 bg-body rounded-4">
                        <form action="#" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    
                                    <label for="inputID">Vendor Name</label>
                                    <select name="vendor_name" id="vendor_name" class="form-select">
                                        <option hidden value="">Select Vendor</option>
                                        <?php 
                                            $stmt = $con->query("SELECT * FROM tbl_user");
                                            while($row = $stmt->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <option value="<?= $row->user_id ?>"><?= $row->user_fullname ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Salary($)</label>
                                    <input type="text" name="salary" id="salary" min="1" class="form-control" placeholder="Salary">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Bonus($)</label>
                                    <input type="text" name="bonus" id="bonus" min="1" class="form-control" placeholder="Bonus">
                                </div>
                            </div>
                                <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="form-select" class="form-label">Date</label>
                                    <input type="date" name="salary_date" id="salary_date" class="form-control">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="form-select" class="form-label">Description or Notes</label>
                                    <input type="text" name="notes" id="notes" class="form-control" placeholder="Description or Notes">
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button name="#" type="submit" id="btnAdd" class="btn btn-sm btn-info rounded-5">
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
                                    <table id="tblsalary" class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Vendor Name</th>
                                                <th class="cell">Salary($)</th>
                                                <th class="cell">Bonus($)</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Description or Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div> 
                    </div><!--end table-->
                    <!-- Total -->
                    <!-- <div style="width: 20%;" class="container bg-white p-3 shadow rounded-4 mr-5">
                        <h6>Purchase Total ($): <span id="total"></span>$</h6>
                    </div> -->
                    <!-- End Total -->
                    <div class="text-center mt-3">
                                    <button name="add_salary" id="btnSalary" type="submit" class="btn btn-md btn-success rounded-5">
                                        <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                        </svg> Done</button>
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
    let newRowContent
    $(document).ready(function(){
        $("#salary_date").val(new Date().toISOString().slice(0, 10));
    });

    $("#btnAdd").click(function(){
        if($('#vendor_name').val() == "") {errmsg('Please select Vendor Name!'); return false;}
        if($('#salary').val() == "") {errmsg('Please insert Salary!'); return false; }

         newRowContent = "<td>"+$('#vendor_name option:selected').text() +"</td>" + "<td>"+$('#salary').val() +"</td>" + "<td>"+$('#bonus').val() +"</td>" + "<td>"+$('#salary_date').val() +"</td>" +"<td>"+$('#notes').val() +"</td>";

        $("#tblsalary tbody").append("<tr>"+newRowContent+"</tr>");
     
            uid=$('#vendor_name').val(),
           salary=$('#salary').val(),
           bonus= $('#bonus').val(),
           salary_date=  $("#salary_date").val(),
           notes= $("#notes").val(),
           
           item = {uid: uid, salary: salary, bonus:bonus, salary_date: salary_date,notes:notes};
        items.push(item);
        console.log('working!' + JSON.stringify(items));
        return false;
    });
        
    $("#btnSalary").click(function(){

        $.ajax({
            // url: 'ajax/purchase.php?em='+em+'+date='+date,
            url: 'ajax/salary.php',
            cache: false,
            data: {items: items},
            success: function(res){
          
                if(res == 'success'){
                    // success
                    $('#vendor_name').val(""),
                    $('#salary').val(""),
                    $('#bonus').val(""),
                    $("#salary_date").val(new Date().toISOString().slice(0, 10));
                    $("#notes").val(""),
                    $("#tblsalary tbody").html("");
                    items = new Array();
                    total = 0;
                    
                }
                Swal.fire(res, '', 'success');
            }, error: function(e){
                console.log(e.responseText); 
            }
        });
        console.log('working!');
        return false;
    });

    function errmsg(msg){
        Swal.fire(msg, '', 'error'); 
    }
</script>

</body>
</html>

