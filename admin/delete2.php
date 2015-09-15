<?
include('../connect.php');


if($_GET['table']=="Nations_data") { $idthing="NatID"; } else { $idthing="ID"; }
mysql_query('DELETE FROM '.$_GET['table'].' WHERE '.$idthing.' = \''.$_GET['ID'].'\'');

echo('Row '.$_GET['ID'].' deleted from '.$_GET['table'].' table');

echo('<meta http-equiv="refresh" content="2;url=index.php">');

?>