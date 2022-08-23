<?php include_once('config/db.php');
	include('assets/contents/My_Scripts.php');?>
							        <table id="datatableid" class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell text-center">#</th>
												<th class="cell">Name</th>
												<th class="cell">Gender</th>
												<th class="cell">Phone</th>
                                                <th class="cell">Email</th>
                                                <th class="cell">Address</th>
												<th class="cell">Salary</th>
                                                <th class="cell">Create Date</th>
                                                <th class="cell">Update Date</th>
												<th class="cell text-center">Actions</th>
											</tr>
										</thead>
										
                                       
								<tbody>
								<?php
                                $status = 1;
                                //sql Prepare Statement
                                $sql_select = $con->prepare("SELECT * FROM tbl_vendor");

                                $sql_select->bindParam(1, $status);

                                $sql_select->execute();
                                //$row_select = $sql_select->fetch(PDO::FETCH_BOTH);

                                $i = 0;

                                foreach ($sql_select as $row) :
                                    $i++;
                                ?>
                                    <tr>
                                    <td class="text-center"><?= $i ?></td>
                                        <td><?= $row['vendor_name'] ?></td>
                                        <td><?= $row['vendor_gender'] ?></td>
                                        <td><?= $row['vendor_phone'] ?></td>
                                        <td><?= $row['vendor_email'] ?></td>
                                        <td><?= $row['vendor_address'] ?></td>
										<td><a style="color: #03AC13;">$<?= $row['vendor_salary'] ?></a></td>
                                        <td style="color: #FF0000;;"><?= $row['created_date'] ?></td>
                                        <td style="color: #FF0000;;"><?= $row['updated_date'] ?></td>

                                        <td class="td-actions text-center">
												<button style="width: 30px; height:30px;" id="button5" type="button" class="btn btn-info rounded-circle btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#myModal_vendor_update" data-original-title="" title="Edit">
													<svg width="13" height="13" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  													<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  													<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
														Edit</svg>
												</button>
												<button style="width: 30px; height:30px;" id="delete_ven" type="button" class="btn btn-danger rounded-circle btn-just-icon btn-sm" data-original-title="" title="Delete">
													<svg width="13" height="13" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
													<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
													<path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
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
                                        <th class="cell text-center">#</th>
												<th class="cell">Name</th>
												<th class="cell">Gender</th>
												<th class="cell">Phone</th>
                                                <th class="cell">Email</th>
                                                <th class="cell">Address</th>
												<th class="cell">Salary</th>
                                                <th class="cell">Create Date</th>
                                                <th class="cell">Update Date</th>
												<th class="cell text-center">Actions</th>
											</tr>
                                        </tfoot>
									</table>

                <!-- modal -->
		<div class="modal" id="myModal_vendor">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">បញ្ចូលព័ត៌មានបុគ្គលិក</h5>
										</div>
										<div class="modal-body">
											<form action="">
												<div class="mb-2">
													<label class="form-label required">Name</label>
													<input type="text" class="form-control">
												</div>
												<div class="mb-2">
													<label for="form-select" class="form-label">Gender</label>
													<select class="form-select">
														<option selected>Select Gender</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
												</div>
												<div class="mb-2">
													<label class="form-label">Email</label>
													<input type="email" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Date of Birth</label>
													<input type="date" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Phone Number</label>
													<input type="text" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Address</label>
													<input type="text" class="form-control">
												</div>
											</form>
										</div>
										<div class="modal-footer mb-2">
											<button id="add_ven" type="submit" class="btn btn-success" data-bs-dismiss="modal">Add Vendor</button>
											<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
		<!-- end modal -->
        <!-- Modal Update -->
        <div class="modal" id="myModal_vendor_update">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">កែប្រែព័ត៌មានបុគ្គលិក</h5>
										</div>
										<div class="modal-body">
											<form action="">
												<div class="mb-2">
													<label class="form-label required">Name</label>
													<input type="text" class="form-control">
												</div>
												<div class="mb-2">
													<label for="form-select" class="form-label">Gender</label>
													<select class="form-select">
														<option selected>Select Gender</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
												</div>
												<div class="mb-2">
													<label class="form-label">Email</label>
													<input type="email" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Date of Birth</label>
													<input type="date" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Phone Number</label>
													<input type="text" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Address</label>
													<input type="text" class="form-control">
												</div>
											</form>
										</div>
										<div class="modal-footer mb-2">
											<button id="update_ven" type="submit" class="btn btn-success" data-bs-dismiss="modal">Update Vendor</button>
											<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
		<!-- end modal -->