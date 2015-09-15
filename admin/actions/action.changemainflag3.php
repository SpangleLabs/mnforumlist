<?
include('../../connect.php');
include('function.changemainflag.php');


echo(function_action_changemainflag($_POST['NatID'],$_POST['FlagID'],$db_pre));
echo('<meta http-equiv="refresh" content="2;url=index.php">');


?>