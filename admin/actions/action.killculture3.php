<?
include('../../connect.php');
include('function.killculture.php');


echo(function_action_killculture($_POST['CultureID'],$db_pref));
echo('<meta http-equiv="refresh" content="2;url=index.php">');


?>