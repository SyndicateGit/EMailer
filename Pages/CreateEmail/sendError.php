<?php
    require_once('../../db/common.php');

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['errorMessage'] = "Please login to view this page";
        echo $_SESSION['errorMessage'];
        exit;
    }

    if(isset($_SESSION['sendError'])) {
        echo $_SESSION['sendError'];
        unset($_SESSION['sendError']); 
    }
    exit;
?>