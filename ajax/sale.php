<?php

require_once '../config/db.php';

try{

    $buyer =  $_GET['b'];
    $buyer_phone =  $_GET['bp'];
    $date = $_GET['d'];
    $total = $_GET['tol'];
    $items = $_GET['items'];

<<<<<<< HEAD
    $query = $con->prepare("INSERT INTO tbl_sale VALUES(null, ?, ?,?,?,null)");
=======
    $query = $con->prepare("INSERT INTO tbl_sale VALUES(NULL, ?, ?, ?, ?)");
>>>>>>> d7b6ff35d7e0cfae572def2b54da1e1e4d66d9de
    $query->bindParam(1, $buyer);
    $query->bindParam(2, $buyer_phone);
    $query->bindParam(3, $total);
    $query->bindParam(4, $date);
    $query->execute();

    $sale_id = $con->lastInsertId();

    foreach($items as $item){
<<<<<<< HEAD
        $q1 = $con->prepare("INSERT INTO tbl_sale_detail VALUES(?, ?, ?, ?)");
        $q1->bindParam(1, $pid);
=======
        $q1 = $con->prepare("INSERT INTO tbl_sale_detail VALUES( ?, ?, ?)");
        $q1->bindParam(1, $sale_id);
>>>>>>> d7b6ff35d7e0cfae572def2b54da1e1e4d66d9de
        $q1->bindParam(2, $item['pid']);
        $q1->bindParam(3, $item['pqty']);
        $q1->execute();
        $q2 = $con->prepare("UPDATE tbl_item SET current_stock = current_stock - ? WHERE item_id = ? ");
        $q2->bindParam(1, $item['pqty']);
        $q2->bindParam(2, $item['pid']);
        $q2->execute();
    }

<<<<<<< HEAD
    echo 'Sale Successfully!';

=======
    echo $sale_id;
>>>>>>> d7b6ff35d7e0cfae572def2b54da1e1e4d66d9de
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

