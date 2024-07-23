<?php
require_once('../../db/common.php');

$from_email = $_SESSION['from_email'];

if($from_email == null){
    echo "No email found";
    exit;
}

echo $from_email;

exit;
?>
