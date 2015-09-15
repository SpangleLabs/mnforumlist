<?
include('../../connect.php');
include('function.addwiki.php');

echo(function_action_addwiki($_POST['Name'],$_POST['Link'],$_POST['First_bit'],$_POST['Last_bit'],$db_pref));
echo('<meta http-equiv="refresh" content="2;url=index.php">');


?>