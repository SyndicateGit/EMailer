<?php
// Used to fetch any error messages from the session and display them
// If a user is not logged in, they will be redirected to the login page
require_once('../../db/common.php');

if (!isset($_SESSION['user_id'])) {
  $_SESSION['errorMessage'] = "Please login to view this page";
}

$errorMessage = $_SESSION['errorMessage'];
unset($_SESSION['errorMessage']);

if($errorMessage == null){
  echo '';
  exit;
}

echo $errorMessage;
exit;
?>
