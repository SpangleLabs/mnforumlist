<?
include('../connect.php');

mysql_query('UPDATE `'.$db_pref.'rating_request` SET `Fixed` = \'Y\' WHERE `ID` = \''.$_GET['ID'].'\'');

echo('Request ID '.$_GET['ID'].' deleted. (well, marked as fixed ;) )

<meta http-equiv="refresh" content="2;url=index.php" />');


?>