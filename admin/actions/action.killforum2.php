<?
include('../../connect.php');
include('function.killforum.php');


echo(function_action_killforum($_POST['ForumID'],$db_pre));
echo('<meta http-equiv="refresh" content="2;url=index.php">');


?>