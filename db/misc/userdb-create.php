<?php
require_once('../common.php');

// Clearly this is a very crude interface.
// A normal web site would never output raw text. Instead an admin login
// would trigger this and only would output errors if they occured.
header('Content-Type: text/plain');
try
{
  echo "Creating users DB...\n";
  $db = new dbuser();
  $db->admin_create_db();
  echo "Finished creating DB.\n";
}
catch (Exception $e)
{
    echo "EXCEPTION: ".$e->getMessage()."\n";
    echo "IP: ".http_utils::get_client_ip_address()."\n";
}
?>
