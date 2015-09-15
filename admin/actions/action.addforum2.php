<?
include('../../connect.php');
include('function.addforum.php');

echo(function_action_addforum($_POST['NatID'],$_POST['URL'],$_POST['status'],$_POST['Type'],$db_pref));
echo('<meta http-equiv="refresh" content="2;url=index.php">');



?>