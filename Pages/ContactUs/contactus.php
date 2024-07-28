<?php
require_once('../../db/common.php');
require_once('../../db/autoload/dbcontactus.php');

header('Content-Type: application/json');

if (isset($_POST['from_email']) && isset($_POST['email_body'])) {
  $from_email = filter_input(INPUT_POST, 'from_email', FILTER_SANITIZE_EMAIL);
  $email_body = filter_input(INPUT_POST, 'email_body', FILTER_SANITIZE_STRING);

  $dbcontactus = new dbcontactus();

  $result = false;
  try{
    $result = $dbcontactus->insert($from_email, $email_body);
  }catch (Exception $e){
    echo json_encode(['success' => false, 'message' => 'Failed to send message.']);
    exit;
  }
  
  if($result){
    echo json_encode(['success' => true, 'message' => 'Message sent successfully.']);
  
  } else {
  echo json_encode(['success' => false, 'message' => 'Required fields are missing.']);
  }
}
?>