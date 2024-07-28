<?php
    require_once('../../db/common.php');

    // Check if user is logged in upon page load
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['errorMessage'] = "Please login to view this page";
        echo $_SESSION['errorMessage'];
        exit;
    }

    // Check if there is an error message in the session
    if(isset($_SESSION['sendError'])) {
        echo $_SESSION['sendError'];
        unset($_SESSION['sendError']); 
    }
    exit;
?>