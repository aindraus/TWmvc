<?php
require_once '../../app/bootstrap.php';
require_once APP_ROOT . '/config/scaffold.php';

if(isset($_POST['submit_new'])){
  if(!empty($_POST['new_name']) && !empty($_POST['db_attr'])){
    $name = $_POST['new_name'];
    $attr = $_POST['db_attr'];

    $newTable = new Scaffold($name, $attr);
  } else {
    die('Please make sure all fields are valid');
  }
}
?>
<?php get_header();?>
<div style="background:#f1f2f7;position:absolute;width:100%;height:100%;margin:0;display:flex;flex-direction:column;justify-content:center;align-items:center;">
  <div style="background:#fff;padding: 20px;box-shadow:0 10px 8px -3px rgba(0,0,0,0.1);text-align:center;width:60%;margin-left:auto;margin-right:auto;">
    <h3 style="padding-bottom: 10px;border-bottom:1px solid #e0e0e0;">The Webery PHP MVC - Scaffolding</h3>
    <p>
      Please make sure to run <span style="color:red;">scaffold_remove.php</span> before publishing your application to production.
    </p>
  </div>
  <div style="width:60%;margin-left:auto;margin-right:auto;background:#fff;margin-top:25px;padding: 20px;box-shadow:0 10px 8px -3px rgba(0,0,0,0.1);">
    <form action="" method="post" style="display:flex;flex-direction:column;width:100%;">
      <label style="margin-top:15px; text-transform:uppercase;">New Class Name - Please make sure you enter a plural value.</label>
      <input type="text" name="new_name" placeholder="Enter Value" style="border:1px solid #e0e0e0;padding:10px;margin-top:15px;"/>
      <label style="margin-top:15px; text-transform:uppercase;">Database Attributes</label>
      <textarea name="db_attr" style="border:1px solid #e0e0e0;padding:10px;margin-top:15px;"></textarea>
      <input type="submit" value="Create" name="submit_new" style="margin-top:15px;border:none;background:green;color:#fff;padding:10px;cursor:pointer;" />
    </form>
  </div>
</div>
<?php get_footer();?>
