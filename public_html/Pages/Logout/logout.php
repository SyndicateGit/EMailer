<?php
// Remove all session variables and redirect to login page
session_start();
session_unset();
session_destroy();

header('Location: ../Login/login.html');
exit;
?>
