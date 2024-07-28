<?php
require_once('../../db/common.php');
require_once('../../db/autoload/dbemail.php');

$dbEmail = new dbemail();

$user_id = $_SESSION['user_id'];

// Check if user is logged in
if($user_id == null){
    echo("Please login to view this page");
    exit;
}

$emailId = $_REQUEST['id'];

// Check if email id is set in the request
if($emailId == null){
    echo("Email not found");
    exit;
}

// Delete email by id
try{
    $dbEmail->delete_by_id($emailId);
    echo "Email deleted";
    if(isset($_SESSION['signupError'])) {
        unset($_SESSION['signupError']); 
    }
    exit;
} catch (Exception $e){
    // Error deleting email
    $_SESSION['errorMessage'] = "Error deleting email";
    echo "Error deleting email";
} 
exit;
?>
