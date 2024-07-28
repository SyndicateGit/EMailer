<?php
require_once('../../../private/db/common.php');
session_start();
$fname = strip_tags($_POST['fname']);
$lname = strip_tags($_POST['lname']);
$email = strip_tags($_POST['address']);
$pass = strip_tags($_POST['password']);


$dbUser = new dbuser();
$email .= "@example.com";

//Check if the user already exists
try {
    if($dbUser->email_lookup($email)) {
        $_SESSION['signupError'] = "User already exists. Try again";
        header('Location: ./signup.html?fname=' . urlencode($fname) . '&lname=' 
        . urlencode($lname) . '&address=' . urlencode($_POST['address']));
        exit;
    }
}catch (Exception $e) {
    $_SESSION['signupError'] = "Failed to check existing users.";
    header('Location: ./signup.html?fname=' . urlencode($fname) . '&lname=' 
    . urlencode($lname) . '&address=' . urlencode($_POST['address']));
    exit;
}

// Add the user to the database
try {
    $dbUser->insert($fname, $lname,$email, $pass);
    $_SESSION['from_email'] = $email;
    if(isset($_SESSION['signupError'])) {
        unset($_SESSION['signupError']); 
    }
}catch (Exception $e) {
    $_SESSION['signupError'] = "Failed to create new account.";
    header('Location: ./signup.html?fname=' . urlencode($fname) . '&lname=' 
    . urlencode($lname) . '&address=' . urlencode($_POST['address']));
    exit;
}    

// Redirect to the login page
header('Location: ../Login/login.html');
exit;
?>
