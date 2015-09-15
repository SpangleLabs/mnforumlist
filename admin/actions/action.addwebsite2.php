<?
include('../../connect.php');
include('function.addwebsite.php');

echo(function_action_addwebsite($_POST['NatID'],$_POST['URL'],$_POST['status'],$_POST['Type'],$_POST['Language'],$db_pre));
echo('<meta http-equiv="refresh" content="2;url=index.php">');



?>