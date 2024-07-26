<?php
require_once '../../db/common.php';
require_once '../../db/autoload/dbuser.php';

$userModel = new dbuser();

$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) && !empty($password)) {
    $userIsValid = $userModel->check_user_pass($email, $password);

    if ($userIsValid) {
        $user = $userModel->email_lookup($email);
        if($user == false){
            echo "User not found\n";
            header('Location: ../Login/login.html');
            exit;
        }
        $_SESSION['user_id'] = $user['user'];
        $_SESSION['from_email'] = $email;
        $_SESSION['errorMessage'] = null;
        header('Location: ../ViewEmails/ViewEmails.html');
        exit;
    } else {
        echo "Authentication failed\n";
        $_SESSION["errorMessage"]="Authentication failed";
        header('Location: ../Login/login.html');
        exit;
    }
}
?>
