<?php
require_once('../../db/common.php');
session_start();
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['address'];
$pass = $_POST['password'];


$dbUser = new dbuser();

//Check if the user already exists
if($dbUser->email_lookup($email)) {
    $_SESSION['signupError'] = "User already exists.";
    header('Location: ./signup.html?fname=' . urlencode($fname) . '&lname=' 
    . urlencode($lname) . '&address=' . urlencode($_POST['address']));
    exit;
}

// Add the user to the database
$dbUser->insert($fname, $lname,$email, $pass);

$_SESSION['from_email'] = $email;

// Redirect to the login page
header('Location: ../ViewEmails/viewEmails.html');
exit;
?>
