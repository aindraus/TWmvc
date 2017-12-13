<?php
// Database Class - Connect to DB & Create Prepares Statements (CRUD)

class Database {
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  // Handler
  private $dbh;
  private $stmt;
  private $error;

  public function __construct(){
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch(PDOException $e){
      $this->error = $e->get_message();
      echo $this->error;
    }
  }
}
