<?php
// End session and redirect to login page
session_destroy();

header('Location: ../Login/login.html');
exit;
?>
