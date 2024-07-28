<?php
session_start();
// Remove all session variables and redirect to login page
session_unset();
session_destroy();

header('Location: ../Login/login.html');
exit;
?>
