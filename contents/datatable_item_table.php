<?php include_once('config/db.php');
include('assets/contents/My_Scripts.php');?>
		<table class="table app-table-hover mb-0 text-left">
            <thead>
				<tr>
					<th class="cell text-center">ID</th>
					<th class="cell">Product Name</th>
					<th class="cell">Image</th>
					<th class="cell">Category</th>
					<th class="cell">Brand</th>
                    <th class="cell">Current Stock</th>
                    <th class="cell">Stock In</th>
                    <th class="cell">Stock Out</th>
					<th class="cell">Created Date</th>
                    <th class="cell">Updated Date</th>
					<th class="cell text-center">Actions</th>
				</tr>
			</thead>
										
                                       
								<tbody>
                                <?php
                                $status = 1;
                                //sql Prepare Statement
                                $sql_select = $con->prepare("SELECT tbl_item.item_id, tbl_item.item_name, tbl_item.item_image, tbl_category.category_id, tbl_category.category_name AS category_name, tbl_brand.brand_id, tbl_brand.brand_name AS brand_name, 
                                                            tbl_item.current_stock, tbl_item.stock_in, tbl_item.stock_out, tbl_item.created_date, tbl_item.updated_date
                                                            FROM((tbl_item
                                                            INNER JOIN tbl_category ON tbl_item.category_id = tbl_category.category_id)
                                                            INNER JOIN tbl_brand ON tbl_item.brand_id = tbl_brand.brand_id)");


                                $sql_select->execute();
                                //$row_select = $sql_select->fetch(PDO::FETCH_BOTH);

                                $i = 0;

                                foreach ($sql_select as $row) :
                                    $i++;
                                ?>
                                    <tr>
                                    <td class="text-center"><?= $i ?></td>
                                        <td><?= $row['item_name'] ?></td>
                                        <td><?= $row['item_image'] ?></td>
                                        <td><?= $row['category_name'] ?></td>
                                        <td><?= $row['brand_name'] ?></td>
                                        <td class="text-center"><?= $row['current_stock'] ?></td>
                                        <td class="text-center"><?= $row['stock_in'] ?></td>
                                        <td class="text-center"><?= $row['stock_out'] ?></td>
                                        <td style="color: #FF0000;"><?= $row['created_date'] ?></td>
										<td style="color: #FF0000;"><?= $row['updated_date'] ?></td>
                                        <td class="td-actions text-center">
												<button style="width: 30px; height:30px;" id="button5" type="button" class="btn btn-success rounded-circle btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#myModal_item_view" data-original-title="" title="View Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    View</svg>
												</button>
											</td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
							</tbody>
                    <tfoot>
                    <tr>
					<th class="cell text-center">ID</th>
					<th class="cell">Product Name</th>
					<th class="cell">Image</th>
					<th class="cell">Category</th>
					<th class="cell">Brand</th>
                    <th class="cell">Current Stock</th>
                    <th class="cell">Stock In</th>
                    <th class="cell">Stock Out</th>
					<th class="cell">Created Date</th>
                    <th class="cell">Updated Date</th>
					<th class="cell text-center">Actions</th>
											</tr>
                                        </tfoot>
									</table>

        <!-- modal -->
		<div class="modal" id="myModal_item_view">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Information Details</h5>
										</div>
										<div class="modal-body">
                                            <div class="card" style="width: 29rem;">
                                            <img class="card-img-top" src="assets/images/mouse/Mouse2.jpg" alt="Item Image">
                                            <div class="card-body">
                                                <p class="card-title" style="font-size: 30px; text-align:center;"><strong>Mouse</strong></p>
                                                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><strong>Category:</strong> Accessories (Mouse)</li>
                                                <li class="list-group-item"><strong>Brand:</strong> MSI</li>
                                                <li class="list-group-item"><strong>Model:</strong> MSI Univers</li>
                                                <li class="list-group-item"><strong>Price:</strong> $70</li>
                                            </ul>
                                            </div>
										</div>
										<div class="modal-footer mb-2">
											<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
		<!-- end modal -->