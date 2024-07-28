<?php

final class dbuser extends db
{
    public function __construct()
    {
        // PHP does not call the parent constructor automatically...
        parent::__construct();
    }

    public function admin_create_db()
    {
        if (!$this->admin_permit_create_drop())
            throw new Exception('Database CREATEs are prohibited by admin.');

        // An SQL prepared statement is not needed here since everything
        // is from this site and safe...
        $sql = <<<ZZEOF
CREATE TABLE users (
    user INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    pass VARCHAR(255) NOT NULL
)
ZZEOF;
        return $this->db_handle()->exec($sql);
    }

    // Inserts a new user $user into the DBUser table having password $pass.
    public function insert($fname, $lname, $email, $pass)
    {
        if($this->duplicate_email_check($email))
        {
            throw new Exception('Email already exists in the database.');
        }
        
        $entry = array(
            ':fname' => $fname,
            ':lname' => $lname,
            ':email' => $email,
            ':pass' => $this->compute_password_hash($pass),
        );

        $sql = 'INSERT INTO users (fname, lname, email, pass) VALUES (:fname, :lname, :email, :pass)';
        $stmt = $this->db_handle()->prepare($sql);
        return $stmt->execute($entry);
    }


    public function admin_destroy_db()
    {
        if (!$this->admin_permit_create_drop())
            throw new Exception('Database DROPs are prohibited by admin.');

        $sql = "DROP TABLE IF EXISTS users";
        return $this->db_handle()->exec($sql);
    }

    protected final function compute_password_hash($pass)
    {
        global $CFG;

        // Combine the site-wide salt with $pass...
        $salted_pass = $CFG->site_wide_password_salt.$pass;
        if (strlen($salted_pass) > 72)
            throw new Exception('Password + site salt too long to avoid truncation.');
        return password_hash($salted_pass, PASSWORD_DEFAULT);
    }

    protected final function verify_password_hash($plain_pass, $hashed_pass)
    {
        global $CFG;

        // Combine the site-wide salt with $pass...
        $salted_pass = $CFG->site_wide_password_salt.$plain_pass;
        if (strlen($salted_pass) > 72)
            throw new Exception('Password + site salt too long to avoid truncation.');
        return password_verify($salted_pass, $hashed_pass) === TRUE;
    }

    // Erases an existing user $user from the DBUser table.
    public function erase($user)
    {
        $entry = array( ':user' => $user );

        // Create the SQL prepared statement and delete the entry...
        $sql = 'DELETE FROM users WHERE user = :user';
        $stmt = $this->db_handle()->prepare($sql);
        $stmt->execute($entry);
    }

    // Checks that user $user exists and has password $pass. If
    // such is true, then TRUE is returned. Otherwise FALSE is returned.
    public function check_user_pass($email, $pass)
    {
        // Create the entry to add...
        $entry = array( ':email' => $email );

        // Create the SQL prepared statement and insert the entry...
        try
        {
            $sql = 'SELECT pass FROM users WHERE email = :email';
            $stmt = $this->db_handle()->prepare($sql);
            $stmt->execute($entry);
            $result = $stmt->fetchAll();
            if (count($result) == 1 && array_key_exists('pass', $result[0]))
            {
                return $this->verify_password_hash($pass, $result[0]['pass']);
            }
            else
                return FALSE;
        }
        catch (PDOException $e)
        {
            return FALSE;
        }
    }

    // Attempt to look up user $user in the DBUser table. If $user
    // is not found, then FALSE is returned. Otherwise an array
    // containing the DBUser entry is returned. The column names
    // are: "user" and "pass".
    //
    // If the user is not found or a DB error occurs FALSE is
    // returned. Otherwise an associative array for the record is returned.a
    public function lookup($user)
    {
        // Create the entry to add...
        $entry = [':user' => $user ];

        // Create the SQL prepared statement and insert the entry...
        try
        {
            $sql = 'SELECT * FROM users WHERE user = :user';
            $stmt = $this->db_handle()->prepare($sql);
            $stmt->execute($entry);
            $result = $stmt->fetch();
            return $result;
        }
        catch (PDOException $e)
        {
            return FALSE;
        }
    }

    // Return corresponding if email exists in the database, otherwise return FALSE
    public function email_lookup($email)
    {
        $entry = [':email' => $email];

        try{
            $sql = 'SELECT * FROM users WHERE email = :email';
            $stmt = $this->db_handle()->prepare($sql);
            $stmt->execute($entry);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    // Look up all users in the users table. This function permits
    // PDOExceptions to leak.
    public function lookup_all()
    {
        // Create the SQL prepared statement and insert the entry...
        $sql = 'SELECT * FROM users';
        $stmt = $this->db_handle()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function duplicate_email_check($email)
    {
        $entry = array( ':email' => $email ); 

        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->db_handle()->prepare($sql);
        $stmt->execute([':email' => $email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
}

?>
