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
    $password = generateRandomString(12);
    $dbUser->insert($username, $password);
    echo "Inserted user: $username\n";
    $usernames[] = $username; // Add newly created username to list
}

// Generate and insert mock emails
for ($i = 0; $i < 30; $i++) {
    if (empty($usernames)) {
        echo "No users available to assign emails.\n";
        break;
    }
    $randomUserKey = array_rand($usernames); // Get a random index from usernames array
    $user = $usernames[$randomUserKey]; // Select a random user from existing users

    $to_email = generateRandomString(5) . '@example.com';
    $from_email = generateRandomString(5) . '@example.com';
    $email_body = 'This is a test email body.';
    $email_subject = 'Test Email';
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $dbEmail->insert($user, $to_email, $from_email, $email_body, $email_subject, $date, $time);
    echo "Inserted email from: $from_email to: $to_email\n";
}
?>