<?php
require_once('../../db/common.php');
require_once('../../db/autoload/dbemail.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: ../Login/login.html');
  exit;
}
$emailId = strip_tags($_POST['email-id']);
$to_email = strip_tags($_POST['to-email']);
$email_subject = strip_tags($_POST['email-subject']);
$email_body = strip_tags($_POST['email-body']);
$from_email = strip_tags($_SESSION['from_email']);

# TODO: Get rid of all string inside <>

$dbEmail = new dbemail();

$user = $_SESSION['user_id'];
$date = date('Y-m-d');
$time = date('H:i:s');
$draft = 0; // Not a draft


try{
  $dbEmail->updateEmail($emailId, $to_email, $from_email, $email_body, $email_subject, $draft, $date, $time);
  unset($_SESSION['errorMessage']);
  echo "Email sent";
} catch (Exception $e){
  $_SESSION['errorMessage'] = "Error updating email";
  echo "Error updating email";
} finally{
  header('Location: ../ViewEmails/ViewEmails.html');
}


exit;
?>
