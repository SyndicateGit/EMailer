<?php
require_once('../../db/common.php');
require_once('../../db/autoload/dbemail.php');

// Get the email details from the form
// strip_tags for security against html injection attacks
$to_email = strip_tags($_POST['to-email']);
$email_subject = strip_tags($_POST['email-subject']);
$email_body = strip_tags($_POST['email-body']);
$from_email = strip_tags($_SESSION['from_email']);

$user = $_SESSION['user_id'];
$date = date('Y-m-d');
$time = date('H:i:s');
$draft = 0; // Not a Draft

$dbEmail = new dbemail();

// Insert the email into the database.  Upon success, redirect to the view emails page.
try{
  $dbEmail->insert($user, $to_email, $from_email, $email_body, $email_subject, $draft, $date, $time);
  echo "Email sent";
  if(isset($_SESSION['signupError'])) {
    unset($_SESSION['signupError']); 
  }
  header('Location: ../ViewEmails/ViewEmails.html');
} catch (Exception $e){
  // Fail email creation.
  // redirect to the create email page with the email details encoded in the URL.
  // set the error message in the session to be displayed on the page.
  echo "Error sending email";
  $_SESSION['sendError'] = 'Error: the email failed to save as draft. Please try again.';
  header('Location: ../CreateEmail/CreateEmail.html?to-email=' . urlencode($to_email) . '&email-subject=' . urlencode($email_subject) . '&email-body=' . urlencode($email_body));
}

exit;
?>
