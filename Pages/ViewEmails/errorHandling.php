<?php
// Used to fetch any error messages from the session and display them
require_once('../../db/common.php');

if (!isset($_SESSION['user_id'])) {
  $_SESSION['errorMessage'] = "Please login to view this page";
  header('Location: ../Login/login.html');
  exit;
}

$errorMessage = $_SESSION['errorMessage'];

if($errorMessage == null){
  exit;
}

echo $errorMessage;
exit;
?>
