<?php

require_once '../config/db.php';

try{

    $supplier =  $_GET['em'];
    $date = $_GET['d'];
    $items = $_GET['items'];

    // $query = $con->prepare("DELETE FROM tbl_suppliers WHERE suppliers_id = " . $_GET['id']);
    // $query->execute();

    echo 'success';
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

