<?php
$CFG = new stdClass();

# Replace the following URL with your site's URL...
$CFG->base_url = 'website URL';

# Site-wide password salt...
$CFG->site_wide_password_salt = 'ask me for the salt';

# Set a "global"  session timeout...
$CFG->session_timeout = 60*10; // in seconds

# Database information...
$CFG->dbtype = 'mysql';
$CFG->dbhost = 'localhost';
$CFG->dbname = 'ASK ME FOR DB NAME';
$CFG->dbuser = 'ASK ME FOR DB NAME';
$CFG->dbpass = 'ASK ME FOR DB PASSWORD';

# Special database "admin" security settings...
$CFG->db_admin_permit_create_drop = TRUE;
$CFG->db_admin_only_allow_ip = 'LETS TALK ABOUT IT';

# e.g., Special email support address...
$CFG->emailaddr_support = 'MY EMAIL';

?>