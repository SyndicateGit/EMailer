<?php
require_once('../common.php'); 

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$dbUser = new dbuser();

// Fetch all current users to ensure foreign key constraints are met
$currentUsers = $dbUser->lookup_all(); 
$user = array_column($currentUsers, 'user'); 

// Generate and insert mock users
for ($i = 0; $i < 10; $i++) {
    $fname = generateRandomString(5);
    $lname = generateRandomString(5);
    $email = generateRandomString(5) . '@example.com';
    $password = generateRandomString(12);
    $dbUser->insert($fname, $lname, $email, $password); 
    echo "Inserted user with email $email\n"; 
}

$testEmail = 'test@example.com';
$testPassword = 'yourTestPassword123';
$dbUser->insert('Test', 'User', $testEmail, $testPassword);
echo "Inserted test user with email $testEmail and known password.\n";

?>