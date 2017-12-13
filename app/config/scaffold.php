<?php
require_once '../../app/libraries/Inflect.php';
require_once '../../app/config/db_config.php';
// Create New Scaffold - Create new Model, Controller, DB Table, Views (index, edit, add, show)
class Scaffold {
  private $name;
  private $dbarray;

  public function __construct($name, $attr) {
    $this->name = $name;
    $this->dbarray = $attr;
    if(!empty($name) && !empty($attr)) {
        $sql = 'CREATE TABLE IF NOT EXISTS tw_' . $name . ' (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, '. $attr . ')';
        // $sql = 'INSERT INTO users(title) VALUES (:title)';
        // Set DSN
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        //SET DATABASE VARIABLES
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        if(!$stmt) {
          die('Error');
        }
        // Creating Required Files
        mkdir('../../app/views/' . $name, 0777);
        touch('../../app/controllers/' . ucwords($name) . '.php');
        $model = Inflect::singularize($name);
        touch('../../app/models/' . ucwords($model) . '.php');
        $modelFile = fopen('../../app/models/' . ucwords($model) . '.php', 'w');
        $modelTxt = "<?php \n //" . ucwords($model) . " Model\n class " . ucwords($model) . " {\n    private \$db;\n    public function __construct(){\n      \$this->db = new Database;\n   }\n\n   public function get" . ucwords($name) . "() {\n    \$this->db->query('SELECT * FROM " . $name . "');\n   return \$this->db->resultSet();  \n  }\n }";
        fwrite($modelFile, $modelTxt);
        fclose($modelFile);
        $controllerFile = fopen('../../app/controllers/' . ucwords($name) . '.php', 'w');
        $txt = "<?php \n //" . ucwords($name) . " Controller \n class " . ucwords($name) . " extends Controller {\n   public function __construct(){\n      \$this->". $model . "Model = \$this->model('". ucwords($model) . "');\n   }\n\n   public function index() {\n    \$" . $name . " = \$this->" . $model . "Model->get" . ucwords($name) . "();\n    \$data = [\n       'data' => \$" . $name . ";\n      ]; \n    \$this->view('" . $name . "/index', \$data);\n   }\n }";
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
