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

				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<h5>Customer Name </h5>
							<p><b>Mobile :</b> +1 12345-4569</p>
							<p><b>Email :</b> customer@gmail.com</p>
							<p><b>Address :</b> New York, USA</p>
							<h5><?= $sale->buyer_name ?></h5>
							<p><b>Mobile :</b> <?= $sale->buyer_phone ?></p>
						</div>
					</div>
					<div class="col-md-12 text-center float-left">
						<div class="receipt-left">
							<h3>INVOICE # 102</h3>
							<h3>INVOICE # <?= $sale->sale_id ?></h3>
						</div>
					</div>
				</div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
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
						while($sale = $sql2->fetch(PDO::FETCH_OBJ)):
						?>
                        <tr>
                            <td class="col-md-9">Payment for August 2016</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> 15,000/-</td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Payment for June 2016</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> 6,00/-</td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Payment for May 2016</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> 35,00/-</td>
                            <td class="col-md-9"><?= $sale->item_name ?></td>
                            <td class="col-md-3"><?= $sale->unit_price ?></td>
                            <td class="col-md-3"><?= $sale->qty ?></td>
                            <td class="col-md-3"><?= $sale->unit_price * $sale->qty ?></td>
                        </tr>
						<?php endwhile; ?>
                        <tr>
                            <td class="text-right">
                            <p>
                                <strong>Total Amount: </strong>
                            </p>
                            <p>
                                <strong>Late Fees: </strong>
                            </p>
							<p>
                                <strong>Payable Amount: </strong>
                            </p>
							<p>
                                <strong>Balance Due: </strong>
                            </p>
							</td>
                            <td>
                            <p>
                                <strong><i class="fa fa-inr"></i> 65,500/-</strong>
                            </p>
                            <p>
                                <strong><i class="fa fa-inr"></i> 500/-</strong>
                            </p>
							<p>
                                <strong><i class="fa fa-inr"></i> 1300/-</strong>
                            </p>
							<p>
                                <strong><i class="fa fa-inr"></i> 9500/-</strong>
                            </p>
							</td>
                        </tr>
                        <tr>

                            <td class="text-right"><h2><strong>Total: </strong></h2></td>
                            <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> 31.566/-</strong></h2></td>
                            <td colspan="3" class="text-right"><h2><strong>Total: </strong></h2></td>
                            <td class="text-left text-danger"><h2><strong><i class="fa fa-inr">$ <?= $sale->sale_cost ?></h2></td>
                        </tr>
                    </tbody>
                </table>

				<div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<p><b>Date :</b> 15 Aug 2016</p>
							<p><b>Date :</b> <?= $sale->sale_date ?></p>
							<h5 style="color: rgb(140, 140, 140);">Thanks for shopping.!</h5>
						</div>
					</div>
					<!-- <div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
							<h1>Stamp</h1>
						</div>
					</div> -->
				</div>
            </div>


</style>

<script type="text/javascript">

	window.print();
	window.onafterprint = function () { window.close(); }
</script>
</body>
</html>