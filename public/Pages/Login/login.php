<?php
require_once '../../db/common.php';
require_once '../../db/autoload/dbuser.php';

header('Content-Type: application/json');

$userModel = new dbuser();
$email = $_POST['email'];
$password = $_POST['password'];

$response = array();

// Validate email and password
if (!empty($email) && !empty($password)) {
    $userIsValid = $userModel->check_user_pass($email, $password);

    if ($userIsValid) {
        $user = $userModel->email_lookup($email);
        if ($user == false) {
            $response['success'] = false;
        } else {
            // Set session variables upon successful validation
            $_SESSION['user_id'] = $user['user'];
            $_SESSION['from_email'] = $email;
            $_SESSION['errorMessage'] = null;
            $response['success'] = true;
            $response['redirect'] = '../ViewEmails/ViewEmails.html';
        }
    } else {
        // Set error message upon failed validation
        $response['success'] = false;
        $response['message'] = "Email and Password combination is incorrect";
        $_SESSION["errorMessage"] = "Authentication failed";
    }
}

echo json_encode($response);
