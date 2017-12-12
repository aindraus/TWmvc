<?php
  require_once 'config/config.php';
  // Autoload Current
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  })
?>
