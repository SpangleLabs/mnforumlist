<?
include('../../connect.php');
include('function.killforum.php');
include('function.killnation.php');


echo(function_action_killnation($_POST['NatID'],$db_pre));
echo('<meta http-equiv="refresh" content="2;url=index.php">');


?>