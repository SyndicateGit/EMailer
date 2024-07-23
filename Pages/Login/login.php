<?php
require_once '../../db/common.php';
require_once '../../db/autoload/dbuser.php';
session_start();

$userModel = new dbuser();

$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) && !empty($password)) {
    $userIsValid = $userModel->check_user_pass($email, $password);

    if ($userIsValid) {
        $_SESSION['user_id'] = $userModel->lookup($email)['user'];
        $_SESSION['from_email'] = $email;

        header('Location: /Pages/ViewEmails/viewEmails.html');
        exit;
    } else {
        echo "Authentication failed\n";
        header('Location: /Pages/Login/login.html');
        exit;
    }
}
?>
