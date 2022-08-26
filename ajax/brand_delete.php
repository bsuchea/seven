<?php

if(isset($_GET['id'])){
    
    require_once '../config/db.php';

    try{
        $query = $con->prepare("DELETE FROM tbl_brand WHERE brand_id = " . $_GET['id']);
        $query->execute();
        echo 'Deleted!';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    

}