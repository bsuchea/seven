<?php

require_once '../config/db.php';

try{

    $items = $_GET['items'];
    foreach($items as $item)
    {
        $query = $con->prepare("INSERT INTO tbl_salary VALUES(null, ?, ?, ?, ?,?)");
        $query->bindParam(1, $item['uid']);
        $query->bindParam(2, $item['salary']);
        $query->bindParam(3, $item['bonus']);
        $query->bindParam(4, $item['salary_date']);
        $query->bindParam(5, $item['notes']);
        $query->execute();
  
    }
    // $vendor =  $_GET['vn'];
    // $date = $_GET['d'];
    // $salary = $_GET['sa'];
    // $bonus = $_GET['bn'];
    // $description = $_GET['des'];
    // $items = $_GET['items'];
    



    echo     'success';
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

