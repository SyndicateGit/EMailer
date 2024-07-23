<?php
require_once('../../db/common.php');
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: ../Login/login.html');
  exit;
}

$to_email = $_POST['to-email'];
$email_subject = $_POST['email-subject'];
$email_body = $_POST['email-body'];
$from_email = $_SESSION['from_email'];


$dbEmail = new dbemail();

$user = $dbUser->lookup($_SESSION['user_id']);
$date = date('Y-m-d');
$time = date('H:i:s');

$dbEmail->insert($user['user'], $to_email, $from_email, $email_body, $email_subject, $date, $time);

exit;
?>
