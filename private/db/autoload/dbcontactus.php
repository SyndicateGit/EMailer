
<?php

final class dbcontactus extends db
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
CREATE TABLE contactus (
    _id INT AUTO_INCREMENT PRIMARY KEY,
    from_email VARCHAR(255) NOT NULL,
    email_body TEXT NOT NULL
)
ZZEOF;
    return $this->db_handle()->exec($sql);
  }

  public function insert($from_email, $email_body)
  {
    $sql = 'INSERT INTO contactus (from_email, email_body) VALUES (?, ?)';
    $stmt = $this->db_handle()->prepare($sql);
    return $stmt->execute([$from_email, $email_body]);
  }

  public function admin_destroy_db()
  {
    if (!$this->admin_permit_create_drop()) {
      throw new Exception('Database DROPs are prohibited by admin.');
    }

    $sql = "DROP TABLE IF EXISTS contactus";
    return $this->db_handle()->exec($sql);
  }

  public function lookup_all()
  {
    $sql = 'SELECT * FROM contactus';
    $stmt = $this->db_handle()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>