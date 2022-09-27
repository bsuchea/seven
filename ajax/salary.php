<?php

require_once '../config/db.php';

try{

    $vendor =  $_GET['vn'];
    $date = $_GET['d'];
    $salary = $_GET['sa'];
    $bonus = $_GET['bn'];
    $description = $_GET['des'];
    $items = $_GET['items'];
    
    $query = $con->prepare("INSERT INTO tbl_salary VALUES(?, ?, ?, ?, ?)");
    $query->bindParam(1, $vendor);
    $query->bindParam(2, $salary);
    $query->bindParam(3, $bonus);
    $query->bindParam(4, $date);
    $query->bindParam(5, $description);
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

