<?php
session_start();

// Cannot modify header information
ob_start();
if (!isset($_SESSION['Loged_id'])) {
    header("location: index.php");
    unset($_SESSION['Loged_id']);
}