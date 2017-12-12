<?php
  /*
  * TWmvc CORE
  * Creates URL and loads Core Controller
  * URL Format /Controller/method/params
  */

  class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
      $url = $this->getUrl();
      //Controller
      if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      }
      require_once '../app/controllers/' . $this->currentController . '.php';
      $this->currentController = new $this->currentController;
      //Method
      if(isset($url[1])){
        if(method_exists($this->currentController, $url[1])){
          $this->currentMethod = $url[1];
          unset($url[1]);
        }
      }
      //Params
      if($url){
        $this->params = array_values($url);
      } else {
        $this->params = [];
      }
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }
  }
