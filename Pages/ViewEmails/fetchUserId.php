<?php
require_once('../../db/common.php');

$user_id = $_SESSION['user_id'];

if($user_id == null){
    echo("No user found");
    exit;
}

echo($user_id);

exit;
?>
