<?php
require_once('../../db/common.php');
require_once('../../db/autoload/dbemail.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login/login.html');
    exit;
}

$dbEmail = new dbemail();

$user_id = $_SESSION['user_id'];

if($user_id == null){
    echo("No user found");
    exit;
}


$emailId = $_REQUEST['id'];

if($emailId == null){
    echo("No email found");
    exit;
}

exit;
?>