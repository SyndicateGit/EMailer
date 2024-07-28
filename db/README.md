# Project Database Access Guide

## Overview
This guide provides instructions for setting your own instance of our project database using provided PHP scripts. Follow these steps to configure and replicate the database environment on your server.


## Configuration
The project is configured through the `config.php` file, which sets up the database connection and other global settings. Key configurations include:
- Log into http://www.myweb.cs.uwindsor.ca/ with your Uwin Credentials.
- Navigate to Account Manager > Databases
- Create a new database, keep track of your database name, and password.
- Modify the `config.php` file to include your database details:
    ```php
    $CFG = new stdClass();
    $CFG->base_url = 'your website URL';
    $CFG->site_wide_password_salt = 'your chosen password salt';
    $CFG->dbtype = 'mysql';
    $CFG->dbhost = 'localhost';
    $CFG->dbname = 'your_database_name';
    $CFG->dbuser = 'your_username';
    $CFG->dbpass = 'your_password';
    $CFG->db_admin_permit_create_drop = TRUE;
    $CFG->db_admin_only_allow_ip = 'your_ip_address (while connected to GlobalProtect VPN)';
    $CFG->emailaddr_support = 'your@adminEmail.com';
    ```
## Setting Up Database Tables
Use the PHP scripts provided to set up the initial structure of your database. Once the database is set up, you can run the scripts to insert mock data for testing purposes.

### Scripts and Their Functions
- **`userdb-create.php`**: Creates the table for user data.
- **`emaildb-create.php`**: Sets up the table for email data.
- **`contactus-create.php`**: Sets up the table for contact us data.

### Running Scripts
Scripts should be placed in your project directory and can be run directly from a web browser via the URL. Once satisfied with the database setup, remove the scripts from the server to prevent unauthorized access.

**Example:** In your browser run: https://comp3340.blanchad.myweb.cs.uwindsor.ca/path/to/script.php

### User Operations
- **Destroy Users Table:** Run `userdb-destroy.php` to drop the users table. This is IP-restricted to ensure only the admin can drop the user table.
- **Insert User:** Use the `mockuser.php` script to insert mock user data into the database.

### Email Operations
- **Destroy Emails Table:** `emaildb-destroy.php` allows the admin to drop the emails table from the database. This is IP-restricted to ensure only the admin can drop the user table.
- **Insert Email:** The `mockemail.php` script can be used to generate and insert mock emails into the database.

### User Operations
- **Destroy contact us Table:** Run `contactus-destroy.php` to drop the contact us table. This is IP-restricted to ensure only the admin can drop the user table.
- **Insert User:** Use the `mockcontactus.php` script to insert mock contact us data into the database.
