<?php

//Connect to Database
try {
    $con = new PDO("mysql:host=localhost;dbname=seven;", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    $errorMessage = $e->getMessage();
    echo $errorMessage;
    exit();
}
	