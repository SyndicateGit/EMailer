<?php
require_once('../common.php'); // Adjust path as necessary

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
$dbEmail = new dbEmail();

// Fetch all current users to ensure foreign key constraints are met
$currentUsers = $dbUser->lookup_all(); // This needs to return an array of user data
$usernames = array_column($currentUsers, 'user'); // Extract usernames from the fetched data

// Generate and insert mock users
for ($i = 0; $i < 10; $i++) {
    $username = generateRandomString(8);
    $email = generateRandomString(5) . '@example.com';
    $password = generateRandomString(12);
    $dbUser->insert($username, $email, $password);
    echo "Inserted user: $username with email $email\n";
    $usernames[] = $username;
}

?>