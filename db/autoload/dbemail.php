
<?php

final class dbemail extends db
{
    public function __construct()
    {
        parent::__construct();
    }

    public function admin_create_db()
    {
        if (!$this->admin_permit_create_drop())
            throw new Exception('Database CREATEs are prohibited by admin.');

        $sql = <<<ZZEOF
CREATE TABLE emails (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    user INT NOT NULL,
    to_email VARCHAR(255) NOT NULL,
    from_email VARCHAR(255) NOT NULL,
    email_body TEXT NOT NULL,
    email_subject VARCHAR(255) NOT NULL,
    draft INT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    FOREIGN KEY (user) REFERENCES users(user) ON DELETE CASCADE
)
ZZEOF;
        return $this->db_handle()->exec($sql);
    }

    public function insert($user, $to_email, $from_email, $email_body, $email_subject, $draft, $date, $time)
    {
        $sql = 'INSERT INTO emails (user, to_email, from_email, email_body, email_subject, draft, date, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->db_handle()->prepare($sql);
        return $stmt->execute([$user, $to_email, $from_email, $email_body, $email_subject, $draft, $date, $time]);
    }


    public function lookup_all()
    {
        $sql = 'SELECT * FROM emails';
        $stmt = $this->db_handle()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function admin_destroy_db()
    {
        if (!$this->admin_permit_create_drop()) {
            throw new Exception('Database DROPs are prohibited by admin.');
        }

        $sql = "DROP TABLE IF EXISTS emails";
        return $this->db_handle()->exec($sql);
    }

    public function delete_by_id($id)
    {
        $sql = 'DELETE FROM emails WHERE _id = ?';
        $stmt = $this->db_handle()->prepare($sql);
        return $stmt->execute([$id]);
    }
}

?>