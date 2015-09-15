<?
include('../../connect.php');
include('function.addwikiarticle.php');


if($_POST['Type']=="Main") {
$_POST['Description'] = '-';
}
echo(function_action_addwikiarticle($_POST['NatID'],$_POST['WikiID'],$_POST['Link'],$_POST['Type'],$_POST['Description'],$db_pref));
echo('<meta http-equiv="refresh" content="2;url=index.php">');


?>