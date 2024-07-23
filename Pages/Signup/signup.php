<?php
require_once('../../db/common.php');

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['address'];
$pass = $_POST['password'];


$dbUser = new dbuser();

//TODO: Check if the user already exists

// Add the user to the database
$dbUser->insert($fname, $lname,$email, $pass);

// Redirect to the login page
header('Location: ../Login/login.html');
exit;
?>
