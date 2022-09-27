<?php
require_once 'config/checklogin.php';
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="utf-8">
    <title>Create Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="ក្រុមនិស្សិត ស.ជ.ប.ដ">
    <link rel="shortcut icon" href="assets/images/number-7.ico">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="col-md-12">   
 <div class="row">
		<?php
		if(isset($_GET['id'])){
$sql = $con->prepare("SELECT * FROM tbl_sale WHERE sale_id = " . $_GET['id'] );
$sql->execute();
$sale = $sql->fetch(PDO::FETCH_OBJ);
		}
		?>
        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
    			<div class="receipt-header">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="receipt-left">
							<img class="img-responsive" alt="iamgurdeeposahan" src="assets/images/Logo.jpg" style="width: 71px; border-radius: 43px;">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 text-right">
						<div class="receipt-right">
							<h5>Company Name.</h5>
							<p>+1 3649-6589 <i class="fa fa-phone"></i></p>
							<p>company@gmail.com <i class="fa fa-envelope-o"></i></p>
							<p>USA <i class="fa fa-location-arrow"></i></p>
						</div>
					</div>
				</div>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<h5><?= $sale->buyer_name ?></h5>
							<p><b>Mobile :</b> <?= $sale->buyer_phone ?></p>
						</div>
					</div>
					<div class="col-md-12 text-center float-left">
						<div class="receipt-left">
							<h3>INVOICE # <?= $sale->sale_id ?></h3>
						</div>
					</div>
				</div>
            </div>
			
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Items</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						$sql2 = $con->prepare("SELECT * FROM tbl_sale_detail
						INNER JOIN tbl_item ON tbl_sale_detail.item_id = tbl_item.item_id
						 WHERE sale_id = " . $_GET['id'] );
						$sql2->execute();
						while($saled = $sql2->fetch(PDO::FETCH_OBJ)):
						?>
                        <tr>
                            <td class="col-md-9"><?= $saled->item_name ?></td>
                            <td class="col-md-3"><?= $saled->unit_price ?></td>
                            <td class="col-md-3"><?= $saled->qty ?></td>
                            <td class="col-md-3"><?= $saled->unit_price * $saled->qty ?></td>
                        </tr>
						<?php endwhile; ?>
                        <tr>
                            <td colspan="3" class="text-right"><h2><strong>Total: </strong></h2></td>
                            <td class="text-left text-danger"><h2><strong><i class="fa fa-inr">$ <?= $sale->sale_cost ?></h2></td>
                        </tr>
                    </tbody>
                </table>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<p><b>Date :</b> <?= $sale->sale_date ?></p>
							<h5 style="color: rgb(140, 140, 140);">Thanks for shopping.!</h5>
						</div>
					</div>
				</div>
            </div>
			
        </div>    
	</div>
</div>

<style type="text/css">
body{
background:#eee;
margin-top:20px;
}
.text-danger strong {
        	color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #9f181c;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		#container {
			background-color: #dcdcdc;
		}
</style>

<script type="text/javascript">
	window.print();
	window.onafterprint = function () { window.close(); }
</script>
</body>
</html>