
<table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell text-center">#</th>
												<th class="cell">Product</th>
                                                <th class="cell">Category</th>
                                                <th class="cell">Brand</th>
                                                <th class="cell">Quantity</th>
												<th class="cell">Unit Price</th>
                                                <th class="cell">Vendor</th>
												<th class="cell">Date</th>
												<th class="cell">Total</th>
												<th class="cell text-center">Actions</th>
											</tr>
										</thead>
										<?php
                                $status = 1;
                                //sql Prepare Statement
                                $sql_select = $con->prepare("SELECT tbl_purchase.purchase_id, tbl_item.item_name AS product_name, tbl_category.category_name AS category_name,
                                                                    tbl_brand.brand_name AS brand_name, tbl_purchase.purchase_qty AS qty, tbl_purchase.purchase_unit AS unit_price,
                                                                    tbl_vendor.vendor_name AS vendor_name, tbl_purchase.purchase_date, tbl_purchase.purchase_cost AS total 
                                                                    FROM((((tbl_purchase
                                                                    INNER JOIN tbl_category ON tbl_purchase.category_id = tbl_category.category_id)
                                                                    INNER JOIN tbl_brand ON tbl_purchase.brand_id = tbl_brand.brand_id)
                                                                    INNER JOIN tbl_vendor ON tbl_purchase.vendor_id = tbl_vendor.vendor_id)
                                                                    INNER JOIN tbl_item ON tbl_purchase.item_id = tbl_item.item_id)");

                                $sql_select->bindParam(1, $status);

                                $sql_select->execute();
                                //$row_select = $sql_select->fetch(PDO::FETCH_BOTH);

                                $i = 0;

                                foreach ($sql_select as $row) :
                                    $i++;
                                ?>
								<tbody>
                                    <tr>
                                        <td class="text-center"><?= $i ?></td>
                                        <td><?= $row['product_name'] ?></td>
                                        <td><?= $row['category_name'] ?></td>
                                        <td><?= $row['brand_name'] ?></td>
										<td><?= $row['qty'] ?></td>
                                        <td><a style="color: #03AC13;">$<?= $row['unit_price'] ?></a></td>
                                        <td><?= $row['vendor_name'] ?></td>
                                        <td  style="color: #FF0000;"><?= $row['purchase_date'] ?></td>
                                        <td><a style="color: #03AC13;">$<?= $row['total'] ?></a></td>

                                        <td class="td-actions text-center">
										<button style="width: 30px; height:30px;" id="button5" type="button" class="btn btn-info rounded-circle btn-just-icon btn-sm" data-original-title="" title="Print">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
														Print</svg>
												</button>
                                        <button style="width: 30px; height:30px;"  id="excel" type="button" class="btn btn-info rounded-circle btn-just-icon btn-sm" data-original-title="" title="Export as Excel">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-filetype-xls" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM6.472 15.29a1.176 1.176 0 0 1-.111-.449h.765a.578.578 0 0 0 .254.384c.07.049.154.087.25.114.095.028.202.041.319.041.164 0 .302-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.255-.144-.462-.193l-.619-.143a1.72 1.72 0 0 1-.539-.214 1.001 1.001 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.527-.422.225-.1.484-.149.777-.149.305 0 .564.05.78.152.216.102.383.239.5.41.12.17.186.359.2.566h-.75a.56.56 0 0 0-.12-.258.625.625 0 0 0-.247-.181.923.923 0 0 0-.369-.068c-.217 0-.388.05-.513.152a.472.472 0 0 0-.184.384c0 .121.048.22.143.3a.97.97 0 0 0 .405.175l.62.143c.217.05.406.12.566.211a1 1 0 0 1 .375.358c.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Zm-2.945-3.358h-.893L1.81 13.37h-.036l-.832-1.438h-.93l1.227 1.983L0 15.931h.861l.853-1.415h.035l.85 1.415h.908L2.253 13.94l1.274-2.007Zm2.727 3.325H4.557v-3.325h-.79v4h2.487v-.675Z"/>
                                            Excel</svg>
										</button>
											</td>
                                    </tr>
									</tbody>
                                <?php
                                endforeach;
                                ?>
                                        <tfoot>
                                        <tr>
                                                <th class="cell text-center">#</th>
												<th class="cell">Product</th>
                                                <th class="cell">Category</th>
                                                <th class="cell">Brand</th>
                                                <th class="cell">Quantity</th>
												<th class="cell">Unit Price</th>
                                                <th class="cell">Vendor</th>
												<th class="cell">Date</th>
												<th class="cell">Total</th>
												<th class="cell text-center">Actions</th>
											</tr>
										</tfoot>
									</table>