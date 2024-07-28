<?php
require_once('../../../private/db/common.php');
require_once('../../../private/db/autoload/dbemail.php');

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
  header('Location: ../Login/login.html');
  exit;
}
// Get form fields
// strip html tags from user input
$emailId = strip_tags($_POST['email-id']);
$to_email = strip_tags($_POST['to-email']);
$email_subject = strip_tags($_POST['email-subject']);
$email_body = strip_tags($_POST['email-body']);
$from_email = strip_tags($_SESSION['from_email']);

$dbEmail = new dbemail();

$user = $_SESSION['user_id'];
$date = date('Y-m-d');
$time = date('H:i:s');
$draft = 0; // Not a draft

// Update the email in the database. Upon success, redirect to the view emails page.
try{
  $dbEmail->updateEmail($emailId, $to_email, $from_email, $email_body, $email_subject, $draft, $date, $time);
  if(isset($_SESSION['signupError'])) {
    unset($_SESSION['signupError']); 
  }
  echo "Email sent";
} catch (Exception $e){
  // Fail email update.
  $_SESSION['errorMessage'] = "Error updating email";
  echo "Error updating email";
} finally{
  // Redirect to the view emails page
  header('Location: ../ViewEmails/ViewEmails.html');
}


exit;
?>
