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

try{
    $Emails = $dbEmail->lookup_by_user($user_id);
    if(isset($_SESSION['signupError'])) {
        unset($_SESSION['signupError']); 
    }
} catch (Exception $e){
    echo "Error fetching emails";
    $_SESSION['errorMessage'] = "Error fetching emails";
    exit;
}

if($Emails == false){
    echo("No emails found");
    exit;
}

echo json_encode($Emails);

exit;
?>
