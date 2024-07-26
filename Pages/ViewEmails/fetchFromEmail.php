<?php
require_once('../../db/common.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login/login.html');
    exit;
}

$from_email = $_SESSION['from_email'];

if($from_email == null){
    echo "No email found";
    exit;
}

echo $from_email;

exit;
?>
