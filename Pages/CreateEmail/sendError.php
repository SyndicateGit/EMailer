<?php
    session_start();
    if(isset($_SESSION['sendError'])) {
        echo $_SESSION['sendError'];
        unset($_SESSION['sendError']); 
    }
    exit;
?>