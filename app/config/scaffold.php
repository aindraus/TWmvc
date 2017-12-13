<?php
require_once '../../app/libraries/Inflect.php';
// Create New Scaffold - Create new Model, Controller, DB Table, Views (index, edit, add, show)
class Scaffold {
  private $name;
  private $dbarray = [];

  public function __construct($name) {
    $this->name = $name;
    if(!empty($name)) {
        $sql = 'CREATE TABLE IF NOT EXISTS tw_' . $name . ' (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY)';
        // $sql = 'INSERT INTO users(title) VALUES (:title)';
        $host = 'localhost';
        $user = 'root';
        $password = 'root';
        $db = 'pdotest1';
        // Set DSN
        $dsn = 'mysql:host=' . $host . ';dbname=' . $db;
        //SET DATABASE VARIABLES
        $pdo = new PDO($dsn, $user, $password);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        if(!$stmt) {
          die('Error');
        }
        // Creating Required Files
        mkdir('../../app/views/' . $name, 0777);
        touch('../../app/controllers/' . ucwords($name) . '.php');
        $controllerFile = fopen('../../app/controllers/' . ucwords($name) . '.php', 'w');
        $txt = "<?php \n //" . ucwords($name) . " Controller \n class " . ucwords($name) . " extends Controller { \n\n\n}";
        fwrite($controllerFile, $txt);
        fclose($controllerFile);
        $fileCreate = ['index', 'edit', 'add', 'show'];
        foreach($fileCreate as $file) {
          $myFile = touch('../../app/views/' . $name . '/' . $file . '.php');
        }
    } else {
      echo "error with name";
    }

  }
}
