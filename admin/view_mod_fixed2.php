<?
include('../connect.php');

if(!isset($_GET['ID'])) {
die('No modification selected.');
}



mysql_query('UPDATE `'.$db_pref.'modifications` SET `Fixed` = \'Y\' WHERE `ID` = \''.$_GET['ID'].'\'');

echo('Modification marked as fixed.<br />
<a href="view_modifications.php">Click here</a> to go back to the modifications listing.<br />
<a href="index.php">Click here</a> to go back to the main admin panel.');



?>