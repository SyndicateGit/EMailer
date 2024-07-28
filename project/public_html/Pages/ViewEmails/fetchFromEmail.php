<?php
require_once('../../../private/db/common.php');

// Used to set the from email field in email cards
$from_email = $_SESSION['from_email'];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['errorMessage'] = "Please login to view this page";
    echo $_SESSION['errorMessage'];
    exit;
}

if($from_email == null){
    echo "No email found";
    exit;
}

echo $from_email;

exit;
?>
