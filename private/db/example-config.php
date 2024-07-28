<?php
$CFG = new stdClass();

# Replace the following URL with your site's URL...
$CFG->base_url = 'your website URL';

# Site-wide password salt...
$CFG->site_wide_password_salt = 'password salt';

# Set a "global"  session timeout...
$CFG->session_timeout = 60*10; // in seconds

# Database information...
$CFG->dbtype = 'mysql';
$CFG->dbhost = 'localhost';
$CFG->dbname = 'our_database_name';
$CFG->dbuser = 'our_username';
$CFG->dbpass = 'your_password';

# Special database "admin" security settings...
$CFG->db_admin_permit_create_drop = TRUE;
$CFG->db_admin_only_allow_ip = 'your_ip_address (while connected to GlobalProtect VPN)';

# e.g., Special email support address...
$CFG->emailaddr_support = 'your@adminEmail.com';

?>