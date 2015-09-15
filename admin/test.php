<?
include('../connect.php');

$d = explode('-',$_GET['D']);
echo(gmmktime(1,0,0,$d[1],$d[0],$d[2]));


?>