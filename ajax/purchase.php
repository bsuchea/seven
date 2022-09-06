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
        $query = $con->prepare("INSERT INTO tbl_purchase_detail VALUES(?, ?, ?, ?)");
        $query->bindParam(1, $pid);
        $query->bindParam(2, $item['id']);
        $query->bindParam(3, $item['pqty']);
        $query->bindParam(4, $item['punit']);
        $query->execute();
    }

    echo 'success';
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

