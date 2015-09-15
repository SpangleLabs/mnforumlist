<?
include('../../connect.php');
include('function.tagnation.php');

if($_POST['Current']=="Y") {
$deleted = '0';
} else {
$deleted = gmmktime()+1;
}
echo(function_action_tagnation($_POST['Nation'],$_POST['Category'],$_POST['Current'],gmmktime(),$deleted,$db_pref));
echo('<meta http-equiv="refresh" content="2;url=index.php">');



?>