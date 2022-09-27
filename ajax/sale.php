<?php

require_once '../config/db.php';

try{

    $buyer =  $_GET['b'];
    $buyer_phone =  $_GET['bp'];
    $date = $_GET['d'];
    $total = $_GET['tol'];
    $items = $_GET['items'];

    $query = $con->prepare("INSERT INTO tbl_sale VALUES(null, ?, ?,?,?,null)");
    $query->bindParam(1, $buyer);
    $query->bindParam(2, $buyer_phone);
    $query->bindParam(3, $total);
    $query->bindParam(4, $date);
    $query->execute();

    $pid = $con->lastInsertId();

    foreach($items as $item){
        $q1 = $con->prepare("INSERT INTO tbl_sale_detail VALUES(?, ?, ?, ?)");
        $q1->bindParam(1, $pid);
        $q1->bindParam(2, $item['pid']);
        $q1->bindParam(3, $item['pqty']);
        $q1->bindParam(4, $item['punit']);
        $q1->execute();
        $q2 = $con->prepare("UPDATE tbl_item SET current_stock = current_stock - ? WHERE item_id = ? ");
        $q2->bindParam(1, $item['pqty']);
        $q2->bindParam(2, $item['pid']);
        $q2->execute();
    }

    echo 'Sale Successfully!';

    
} catch (PDOException $e) {
    echo $e->getMessage();
}

