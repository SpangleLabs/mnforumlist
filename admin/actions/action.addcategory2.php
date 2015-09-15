<?
include('../../connect.php');
include('function.addcategory.php');

echo(function_action_addcategory($_POST['Name'],$_POST['Description'],$db_pref));
echo('<meta http-equiv="refresh" content="2;url=index.php">');


?>