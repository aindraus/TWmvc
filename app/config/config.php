<?php
  //App Root
  define('APP_ROOT', dirname(dirname(__FILE__)));
  //URL Root
  define('URL_ROOT', 'http://localhost/TWmvc');
  //Site Name
  define('SITE_NAME', 'WeberyMVC');
  // Display Header
  function get_header() {
    require_once APP_ROOT . '/views/inc/header.php';
  };
  function get_footer() {
    require_once APP_ROOT . '/views/inc/footer.php';
  }
