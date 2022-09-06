<?php

require_once '../config/db.php';

try{

    $supplier =  $_GET['em'];
    $date = $_GET['d'];
    $total = $_GET['t'];
    $items = $_GET['items'];



    $query = $con->prepare("INSERT INTO tbl_purchase VALUES(null, ?, ?, ?)");
    $query->bindParam(1, $total);
    $query->bindParam(2, $date);
    $query->bindParam(3, $supplier);
    $query->execute();

    $pid = $con->lastInsertId();

    foreach($items as $item){
        $q1 = $con->prepare("INSERT INTO tbl_purchase_detail VALUES(?, ?, ?, ?)");
        $q1->bindParam(1, $pid);
        $q1->bindParam(2, $item['id']);
        $q1->bindParam(3, $item['pqty']);
        $q1->bindParam(4, $item['punit']);
        $q1->execute();
        $q2 = $con->prepare("UPDATE tbl_item SET current_stock= current_stock + ? WHERE item_id = ? ");
        $q2->bindParam(1, $item['pqty']);
        $q2->bindParam(2, $item['id']);
        $q2->execute();
    }

    echo 'success';
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

