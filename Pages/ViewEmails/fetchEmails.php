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

$Emails = $dbEmail->lookup_by_user($user_id);

if($Emails == false){
    echo("No emails found");
    exit;
}

echo json_encode($Emails);

exit;
?>
