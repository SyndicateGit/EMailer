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

// Fetch emails by user id
try{
    $Emails = $dbEmail->lookup_by_user($user_id);
    if(isset($_SESSION['signupError'])) {
        unset($_SESSION['signupError']); 
    }
} catch (Exception $e){
    // Error fetching emails
    echo "Error fetching emails";
    $_SESSION['errorMessage'] = "Error fetching emails";
    exit;
}

// Check if emails were found
if($Emails == false){
    echo("No emails found");
    exit;
}

// Return emails as JSON
echo json_encode($Emails);

exit;
?>
