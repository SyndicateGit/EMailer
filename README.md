# EMailer
Online Email App. Create and send emails online.
Features include: login, signup, logout, darkMode settings that persist accross user sessions, create emails (draft or send), view emails, edit draft emails, delete emails, and contact us page.

# Link: https://comp3340.zeng25.myweb.cs.uwindsor.ca/EMailer 

## Front-end:
Copy all folders in your myweb file directory of your choosing.

## Database Configuration
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
Use the PHP scripts provided to set up the initial structure of your database.

### Scripts and Their Functions
- **`userdb-create.php`**: Creates the table for user data.
- **`emaildb-create.php`**: Sets up the table for email data.
- **`contactus-create.php`**: Create the table for contact us data.

### Running Scripts
Scripts should be placed in your project directory and can be run directly from a web browser via the URL. After running all db, change folder permissions from db to not allow public access. Users already can't access it without admin ip address but with this it makes it so they won't know which files are under db. 

**Example:** In your browser run: https://comp3340.blanchad.myweb.cs.uwindsor.ca/path/to/script.php

### Other User Operations
- **Destroy Users Table:** Run `userdb-destroy.php` to drop the users table. This is IP-restricted to ensure only the admin can drop the user table.
- **Insert User:** Use the `mockuser.php` script to insert mock user data into the database.

### Email Operations
- **Destroy Emails Table:** `emaildb-destroy.php` allows the admin to drop the emails table from the database. This is IP-restricted to ensure only the admin can drop the user table.
- **Insert Email:** The `mockemail.php` script can be used to generate and insert mock emails into the database.