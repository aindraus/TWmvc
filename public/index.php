<?php
// Check if connection installed properly
if(!file_exists('../app/config/db_config.php')){
  header("Location: setup.php");
}
// Require App Libraries
require_once '../app/bootstrap.php';
// Initiate Core Library
$init = new Core();
?>
