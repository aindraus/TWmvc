<?php
// Base Controller - Exetends all Controllers
class Controller {
  // Load Models
  public function model($model){
    require_once '../app/models/' . $model . '.php';
    return new $model();
  }
  // Load View
  public function view($view, $data = []){
    if(file_exists('../app/views/' . $view . '.php')){
      require_once '../app/views/' . $view . '.php';
    } else {
      die($view . ' Does not exist.');
    }
  }
}
