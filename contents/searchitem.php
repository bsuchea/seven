<?php 
include("config/db.php");
if(isset($_POST['input'])){
    $input = $_POST['input'];
    $query = "SELECT tbl_item.item_id, tbl_item.item_name, tbl_item.item_image, tbl_category.category_id, tbl_category.category_name AS category_name, tbl_brand.brand_id, tbl_brand.brand_name AS brand_name, 
                tbl_item.current_stock, tbl_item.stock_in, tbl_item.stock_out, tbl_item.created_date, tbl_item.updated_date
                FROM((tbl_item
                INNER JOIN tbl_category ON tbl_item.category_id = tbl_category.category_id)
                INNER JOIN tbl_brand ON  tbl_item.brand_id = tbl_brand.brand_id)
                WHERE tbl_item.item_name LIKE '{$input}%'";
    $con = mysqli_connect("localhost", "seven", "7777", "seven");
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){?>
    <table id="search_result" class="table app-table-hover mb-0 text-left">
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
                                while($row = mysqli_fetch_assoc($result)){
                                    $id = $row['item_id'];
                                    $id = $row['item_name'];
                                    $id = $row['item_image'];
                                    $id = $row['category_name'];
                                    $id = $row['brand_name'];
                                    $id = $row['current_stock'];
                                    $id = $row['stock_in'];
                                    $id = $row['stock_out'];
                                    $id = $row['created_date'];
                                    $id = $row['updated_date'];

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
                                         <td><?= $row['created_date'] ?></td>
                                         <td><?= $row['updated_date'] ?></td>
                                         <td class="td-actions text-center">
                                                 <button style="width: 30px; height:30px;" id="button5" type="button" class="btn btn-info rounded-circle btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#myModal3" data-original-title="" title="">
                                                     <svg width="13" height="13" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                       <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                       <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                         Edit</svg>
                                                 </button>
                                                 <button style="width: 30px; height:30px;" id="delete_item" type="button" class="btn btn-danger rounded-circle btn-just-icon btn-sm" data-original-title="" title="">
                                                     <svg width="13" height="13" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                     <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                     <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                         Delete</svg>
                                                 </button>
                                             </td>
                                     </tr>
                                    <?php 
                                     
                                }
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

    <?php 
    }else{
        echo "<h6 class='text-danger text-center mt-3'>No data found!</h6>";
    }
}




?>