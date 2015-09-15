<?
include('../../connect.php');

$sql_delete = 'UPDATE `'.$db_pref.'lang_request_text` SET `Fixed` = \'Y\' WHERE `ID` = \''.$_GET['ID'].'\'';
$raw_delete = mysql_query($sql_delete);
echo('Entry marked as fixed, <a href="requestlist.php">Back to requests</a>');

?>