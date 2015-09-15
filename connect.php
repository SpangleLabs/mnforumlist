<?
include('config.php');

$con = mysql_connect($db_host,$db_user,$db_pass);
if (!$con)
  {
  die('Could not connect: '.mysql_error().file_get_contents('footer.php'));
  }

mysql_select_db($db_name, $con);

?>