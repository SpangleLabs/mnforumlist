<?
include('../../connect.php');
include('function.killflag.php');


echo(function_action_killflag($_POST['FlagID'],$db_pre));
echo('<meta http-equiv="refresh" content="2;url=index.php">');


?>