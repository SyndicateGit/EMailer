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
$dbEmail = new dbEmail();

$currentUsers = $dbUser->lookup_all();
if (empty($currentUsers)) {
    echo "No users available to assign emails.\n";
    exit; // Stop execution if no users exist
}

$usernames = array_column($currentUsers, 'user');

// Generate and insert mock emails
for ($i = 0; $i < 10; $i++) {
    $randomUserKey = array_rand($usernames);
    $user = $usernames[$randomUserKey];

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