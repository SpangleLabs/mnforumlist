<?
include('../../connect.php');
include('function.addnation.php');
include('../../function.rssadd.php');

echo(function_action_addnation($_POST,$db_pre));

echo('<meta http-equiv="refresh" content="2;url=index.php">');

?>