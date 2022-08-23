<?php include_once('config/db.php');?>	    
		<table class="table app-table-hover mb-0 text-left">
            <thead>
				<tr>
					<th class="cell text-center">Invoice No.</th>
					<th class="cell">Product Name</th>
					<th class="cell">Quantity</th>
					<th class="cell">Customer</th>
					<th class="cell">Phone</th>
					<th class="cell">Vendor</th>
					<th class="cell">Amount</th>
                    <th class="cell">Created Date</th>
					<th class="cell text-center">Actions</th>
				</tr>
			</thead>
										
                                   
								<tbody>
								<?php
                                $status = 1;
                                //sql Prepare Statement
                                $sql_select = $con->prepare("SELECT tbl_item.item_name, tbl_invoice.item_qty, tbl_customer.customer_name,
															tbl_customer.customer_phone, tbl_vendor.vendor_name, tbl_invoice.invoice_total,
															tbl_invoice.created_date 
															FROM(((tbl_invoice 
															INNER JOIN tbl_customer ON tbl_invoice.customer_id = tbl_customer.customer_id)
															INNER JOIN tbl_item ON tbl_invoice.item_id = tbl_item.item_id)
															INNER JOIN tbl_vendor ON tbl_invoice.vendor_id = tbl_vendor.vendor_id)");

                                $sql_select->bindParam(1, $status);

                                $sql_select->execute();
                                //$row_select = $sql_select->fetch(PDO::FETCH_BOTH);

                                $i = 0;

                                foreach ($sql_select as $row) :
                                    $i++;
                                ?>
                                    <tr>
                                    <td class="text-center"><?= $i ?></td>
                                        <td><?= $row['item_name']?></td>
										<td><?= $row['item_qty']?></td>
                                        <td><?= $row['customer_name'] ?></td>
                                        <td><?= $row['customer_phone'] ?></td>
										<td><?= $row['vendor_name'] ?></td>
										<td><a style="color: #03AC13;">$<?= $row['invoice_total'] ?></a></td>
                                        <td style="color: #FF0000;"><?= $row['created_date'] ?></td>
										
										<td class="td-actions text-center">
											<button style="width: 30px; height:30px;" id="button5" type="button" class="btn btn-success rounded-circle btn-just-icon btn-sm" data-original-title="Print">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
														Print</svg>
												</button>
												<button style="width: 30px; height:30px;" id="button5" type="button" class="btn btn-info rounded-circle btn-just-icon btn-sm" data-original-title="" title="Edit">
													<svg width="13" height="13" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  													<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  													<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
														Edit</svg>
												</button>
												<button style="width: 30px; height:30px;" type="button" class="btn btn-danger rounded-circle btn-just-icon btn-sm" data-original-title="" title="Delete">
												<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-file-earmark-x" viewBox="0 0 16 16">
													<path d="M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146z"/>
													<path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
														Delete</svg>
												</button>
											</td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
										</tbody>
                    <tfoot>
                    <tr>
					<th class="cell text-center">Invoice No.</th>
					<th class="cell">Product Name</th>
					<th class="cell">Quantity</th>
					<th class="cell">Customer</th>
					<th class="cell">Phone</th>
					<th class="cell">Vendor</th>
					<th class="cell">Amount</th>
                    <th class="cell">Created Date</th>
					<th class="cell text-center">Actions</th>
											</tr>
                                        </tfoot>
									</table>