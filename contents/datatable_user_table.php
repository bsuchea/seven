<?php include_once('config/db.php');
    include_once('assets/contents/My_Scripts.php');
    ?>

							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell text-center">#</th>
												<th class="cell">Profile</th>
												<th class="cell">Full Name</th>
                                                <th class="cell">Gender</th>
                                                <th class="cell">Phone</th>
                                                <th class="cell">Email</th>
                                                <th class="cell">Address</th>
                                                <th class="cell">Create Date</th>
                                                <th class="cell">Update Date</th>
                                                <th class="cell">Permission</th>
												<th class="cell text-center">Actions</th>
											</tr>
										</thead>
								<tbody>
								<?php
										 $status = 1;
										 //sql Prepare Statement
										 $sql_select = $con->prepare("SELECT *
											 FROM tbl_user");
		 
										 $sql_select->bindParam(1, $status);
		 
										 $sql_select->execute();
										 //$row_select = $sql_select->fetch(PDO::FETCH_BOTH);
										$i = 0;

                                foreach ($sql_select as $row) :
                                    $i++; ?>
                                    <tr>
                                        <td class="text-center"><?= $i ?></td>
                                        <td>
                                            <img src=".assets/images/users<?= $row['user_profile'] ?>" alt="" class="tbl-profile">
                                        </td>
                                        <td><?= $row['full_name'] ?></td>
                                        <td><?= $row['gender'] ?></td>
										<td><?= $row['user_phone'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td style="color: #FF0000;"><?= $row['created_date'] ?></td>
                                        <td style="color: #FF0000;"><?= $row['updated_date'] ?></td>
                                        <?php
                                            //check permission in table
                                            if ($row['permission'] == "Admin") {
                                        ?>
                                            <td class="text-center">
                                            <span class="badge badge-pill badge-success">
                                                    <?= $row['permission'] ?>
                                            </span>
                                            </td>
                                        <?php 
                                            } else{
                                        ?>
                                            <td class="text-center">
                                            <span style="color:white ;" class="badge badge-pill badge-warning">
                                                    <?= $row['permission'] ?>
                                            </span>
                                            </td>
                                        <?php } ?>

                                                
                                        <td class="td-actions text-center ">
												<button style="width: 30px; height:30px;" id="user_edit" type="button" class="btn btn-info rounded-circle btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#myModal_user_update" data-original-title="" title="Edit">
													<svg width="13" height="13" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  													<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  													<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
														Edit</svg>
												</button>
												<button style="width: 30px; height:30px;" id="delete_user" type="button" class="btn btn-danger rounded-circle btn-just-icon btn-sm" data-original-title="" title="Delete">
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

										</tbody>
                                        <tfoot>
                                        <tr>
												<th class="cell text-center">#</th>
												<th class="cell">Profile</th>
												<th class="cell">Full Name</th>
                                                <th class="cell">Gender</th>
                                                <th class="cell">Phone</th>
                                                <th class="cell">Email</th>
                                                <th class="cell">Address</th>
                                                <th class="cell">Create Date</th>
                                                <th class="cell">Update Date</th>
                                                <th class="cell">Permission</th>
												<th class="cell text-center ">Actions</th>
											</tr>
                                        </tfoot>
									</table>

                                    <!-- modal -->
		<div class="modal" id="myModal_user">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">បញ្ចូលព័ត៌មានអ្នកប្រើប្រាស់</h5>
										</div>
										<div class="modal-body">
											<form action="">
												<div class="mb-2">
													<label class="form-label required">Name</label>
													<input type="text" class="form-control">
												</div>
												<div class="mb-2">
                                            		<label for="inputFile" class="col-form-lapel mb-1">Profile</label>
                                            		<br> <input type="file" accept="image/*" class="btn btn-outline-secondary form-control" name="photo" id="file_photo" onchange="loadFile(event)">
                                       			</div>
												<div class=" mb-2">
													<label for="form-select" class="form-label">Gender</label>
													<select class="form-select">
														<option hidden value=""lSelect Permission"">Select Gender</option>
														<option value="Male">Male</option>
														<option value="User">Female</option>
													</select>
												</div>
												<div class="mb-2">
													<label class="form-label">Phone Number</label>
													<input type="text" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Email</label>
													<input type="email" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Create Date</label>
													<input type="date" class="form-control">
												</div>

												<div class="mb-2">
													<label class="form-label">Address</label>
													<input type="text" class="form-control">
												</div>
												<div class="mb-2">
													<label for="form-select" class="form-label">Permission</label>
													<select class="form-select" placeholder="Select Permission">
														<option hidden value="" >Select Permission</option>
														<option value="Admin">Admin</option>
														<option value="User">User</option>
													</select>
												</div>
											</form>
										</div>
										<div class="modal-footer mb-2">
											<button id="add_cus" type="submit" name="add_user" class="btn btn-success" data-bs-dismiss="modal">Add User</button>
											<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
		<!-- end modal -->
        <!-- Modal Update -->
        <div class="modal" id="myModal_user_update">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">កែប្រែព័ត៌មានអ្នកប្រើប្រាស់</h5>
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
														<option hidden value="">Select Gender</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
												</div>
												<div class="mb-2">
													<label class="form-label">Phone Number</label>
													<input type="text" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Email</label>
													<input type="email" class="form-control">
												</div>
												<div class="mb-2">
													<label class="form-label">Update Date</label>
													<input type="date" class="form-control">
												</div>

												<div class="mb-2">
													<label class="form-label">Address</label>
													<input type="text" class="form-control">
												</div>
												<div class="mb-2">
													<label for="form-select" class="form-label">Permission</label>
													<select class="form-select" placeholder="Select Permission">
														<option hidden value="">Select Permission</option>
														<option value="Admin">Admin</option>
														<option value="User">User</option>
													</select>
												</div>
											</form>
										</div>
										<div class="modal-footer mb-2">
											<button id="update_user" type="submit" name="update_user" class="btn btn-success" data-bs-dismiss="modal">Update User</button>
											<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
		<!-- end modal -->