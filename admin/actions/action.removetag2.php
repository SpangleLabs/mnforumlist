<?
include('../../connect.php');
include('function.removetag.php');


echo(function_action_removetag($_POST['Nation'],$_POST['Category'],$db_pref));
echo('<meta http-equiv="refresh" content="2;url=index.php">');



?>