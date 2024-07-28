<?php
require_once('../common.php');

try {
  echo "Destroying contactus DB...\n";
  $db = new dbcontactus();
  $db->admin_destroy_db();
  echo "Finished destroying DB.\n";
} catch (Exception $e) {
  echo "EXCEPTION: " . $e->getMessage() . "\n";
  echo "IP: " . http_utils::get_client_ip_address() . "\n";
}
