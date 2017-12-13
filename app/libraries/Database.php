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
  // Prepare statement
  public function query($query){
    $this->stmt = $this->dbh->prepare($query);
  }
  // Binding Values
  public function bind($param, $value, $type = null){
    if(is_null($type)){
      switch(true){
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;

        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;

        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;

        default:
          $type = PDO::PARAM_STR;
      }
    }
  $this->stmt->bindValue($param, $value, $type);
  }
  // Exectue Prepared Statement

  public function execute(){
    return $this->stmt->excute();
  }

  // Get results set

  public function resultSet(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function single(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }
  public function rowCount(){
    return $this->stmt->rowCount();
  }
}
