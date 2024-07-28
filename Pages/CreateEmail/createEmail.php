<?php
require_once('../../db/common.php');
require_once('../../db/autoload/dbemail.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: ../Login/login.html');
  exit;
}


$to_email = $_POST['to-email'];
$email_subject = $_POST['email-subject'];
$email_body = $_POST['email-body'];
$from_email = $_SESSION['from_email'];


$dbEmail = new dbemail();

$user = $_SESSION['user_id'];
$date = date('Y-m-d');
$time = date('H:i:s');
$draft = 0; // Not a draft

try{
  $dbEmail->insert($user, $to_email, $from_email, $email_body, $email_subject, $draft, $date, $time);
  echo "Email sent";
  header('Location: ../ViewEmails/ViewEmails.html');
} catch (Exception $e){
  echo "Error sending email";
  $_SESSION['sendError'] = 'Error: the email failed to send. Please try again.';
  header('Location: ../CreateEmail/CreateEmail.html?to-email=' . urlencode($to_email) . '&email-subject=' . urlencode($email_subject) . '&email-body=' . urlencode($email_body));
  exit;
}


exit;
?>
