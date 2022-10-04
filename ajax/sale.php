<?php

require_once '../config/db.php';

try{
    $buyer_name = $_GET['buyer_name'];
    $buyer_phone = $_GET['bp'];
    $date = $_GET['d'];
    $total = $_GET['tol'];
    $items = $_GET['items'];

    $query = $con->prepare("INSERT INTO tbl_sale VALUES(NULL, ?, ?, ?, ?)");
    $query->bindParam(1, $buyer_name);
    $query->bindParam(2, $buyer_phone);
    $query->bindParam(3, $total);
    $query->bindParam(4, $date);
    $query->execute();

    $sale_id = $con->lastInsertId();

    foreach($items as $item){
        $q1 = $con->prepare("INSERT INTO tbl_sale_detail VALUES( ?, ?, ?)");
        $q1->bindParam(1, $sale_id);
        $q1->bindParam(2, $item['pid']);
        $q1->bindParam(3, $item['pqty']);
        $q1->execute();

        $q2 = $con->prepare("UPDATE tbl_item SET current_stock= current_stock - ? WHERE item_id = ? ");
        $q2->bindParam(1, $item['pqty']);
        $q2->bindParam(2, $item['id']);
        $q2->bindParam(2, $item['pid']);
        $q2->execute();
    }

    echo $sale_id;

} catch (PDOException $e) {
    echo $e->getMessage();
}
