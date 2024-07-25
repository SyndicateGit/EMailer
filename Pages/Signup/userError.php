<?php
    session_start();
    if(isset($_SESSION['signupError'])) {
        echo $_SESSION['signupError'];
        unset($_SESSION['signupError']); 
    }
    exit;
?>