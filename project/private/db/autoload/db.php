<?php

abstract class db
{
  private static $dbh = NULL;

  public function __construct($enable_exceptions=TRUE)
  {
    global $CFG;

    if (self::$dbh === NULL)
    {
      $dsn = $CFG->dbtype.':host='.$CFG->dbhost.';dbname='.$CFG->dbname;

      self::$dbh = new PDO($dsn, $CFG->dbuser, $CFG->dbpass);
      if (self::$dbh !== NULL)
      {
        if ($enable_exceptions === TRUE)
          self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        else
          self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

        self::$dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        self::$dbh->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
      }
    }
  }

  protected final function db_handle()
  {
    return self::$dbh;
  }

  protected final function admin_permit_create_drop()
  {
    global $CFG;

    return
        $CFG->db_admin_permit_create_drop === TRUE &&
        $CFG->db_admin_only_allow_ip == http_utils::get_client_ip_address()
    ;
  }

  public abstract function admin_create_db();
  public abstract function admin_destroy_db();
}

?>
