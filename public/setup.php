<?php
  //check if file exists
  if(file_exists('../app/config/db_config.php')){
    header("Location: index.php");
  } else {
    if(isset($_POST['create_db_file'])){
      $filePath = '../app/config/db_config_sample.php';
      $newFile = '../app/config/db_config.php';
      copy($filePath, $newFile);
      // Sourcing Data
      $site_name = $_POST['site_name'];
      $db_name = $_POST['database_name'];
      $db_pass = $_POST['database_password'];
      $db_user = $_POST['database_username'];
      // Updating Database Details
      $findFile = '../app/config/db_config.php';
      $fileContent = file_get_contents($findFile);
      $replacedbname = str_replace('database_name_here', $db_name, $fileContent);
      file_put_contents($findFile, $replacedbname);
      $fileContent = file_get_contents($findFile);
      $replacedbPass = str_replace('password_here', $db_pass, $fileContent);
      file_put_contents($findFile, $replacedbPass);
      $fileContent = file_get_contents($findFile);
      $replacedbUser = str_replace('username_here', $db_user, $fileContent);
      file_put_contents($findFile, $replacedbUser);
      // Updating Site Name
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Install TW MVC</title>
  <style>
    body {
      background: #f9f9f9;
      width: 100%;
      height: 100vh;
      margin:0;
      font-family: sans-serif;
      padding:0;
    }
    .data-collect-section {
      display:flex;
      width: 100%;
      height: 100vh;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    form {
      background: #fff;
      padding: 20px;
      box-shadow: 0 10px 8px -5px rgba(0,0,0,0.1);
      width: 400px;
    }
    form h3 {
      padding-bottom: 10px;
      border-bottom: 1px solid #f9f9f9;
      font-weight: lighter;
      text-transform: uppercase;
      color: #212121;
    }
    form > * {
      display: inline-block;
      width: 100%;
    }
    form label {
      margin-bottom: 10px;
    }
    form input {
      margin-bottom: 15px;
      padding: 5px;
      border: none;
      border: 1px solid #e0e0e0;
      box-sizing:border-box;
      border-radius: 2px;
    }
    form input[type="submit"] {
      width: 150px;
      margin-left:auto;
      margin-right:auto;
      margin-bottom: 0;
      float: right;
      background-color: Turquoise;
      color: #fff;
      border: none;
    }
  </style>
</head>
<body>
  <section class="data-collect-section">
    <form action="" method="post">
      <h3>Install TW MVC</h3>
      <label>Site Name</label>
      <input type="text" name="site_name" placeholder="Enter Site Name"/>
      <label>Database Name</label>
      <input type="text" name="database_name" placeholder="Enter Database Name" />
      <label>Database Username</label>
      <input type="text" name="database_username" placeholder="Enter Database Username" />
      <label>Database Password</label>
      <input type="password" name="database_password" placeholder="Enter Database Password"  />
      <input type="submit" name="create_db_file" value="Install" />
    </form>
  </section>
</body>
</html>
