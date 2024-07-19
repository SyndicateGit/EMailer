# Project Database Access Guide

## Overview
Here are the instructions for accessing and manipulating user and email data within our [Project Database](https://comp3340.blanchad.myweb.cs.uwindsor.ca) via provided PHP scripts hosted at. 

## Configuration
The project is configured through the `config.php` file, which sets up the database connection and other global settings. Key configurations include:
- **Database Type:** MySQL
- **Host:** localhost
- **Database Name:** ASK ME FOR DB NAME
- **Username:** ASK ME FOR USERNAME
- **Password:** ASK ME FOR DB PASSWORD
- **Admin Restrictions:** Certain operations are IP-restricted and only available to the admin.

## Database Classes
- **db.php:** Base class for database interactions.
- **dbuser.php:** Handles user-specific database operations.
- **dbemail.php:** Manages email-related database activities.

## Key Operations

### User Operations
- **Create Users Table:** Execute `userdb-create.php` to create a table for users. This is IP-restricted to ensure only the admin can create a user table.
- **Destroy Users Table:** Run `userdb-destroy.php` to drop the users table. This is IP-restricted to ensure only the admin can drop the user table.
- **Insert User:** Use the `mockuser.php` script to insert mock user data into the database.

### Email Operations
- **Create Emails Table:** Use `emaildb-create.php` to initialize the emails table. Admin rights are required.
- **Destroy Emails Table:** `emaildb-destroy.php` allows the admin to drop the emails table from the database. Admin rights are required.
- **Insert Email:** The `mockemail.php` script can be used to generate and insert mock emails into the database.

## Scripts and Usage

### Running Scripts
Scripts are located in the project directory and can be run directly from a web browser or via command line with a PHP server setup.

**Example:** In your browser run: https://comp3340.blanchad.myweb.cs.uwindsor.ca/path/to/script.php
