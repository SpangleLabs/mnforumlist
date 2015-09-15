<?
die();
include('../connect.php');

$raw_thumb = mysql_query('SELECT `ID`,`File_name` FROM `'.$db_pref.'flags` WHERE `Type` = \'Thumbnail\'');
$num_thumb = mysql_num_rows($raw_thumb);

if($num_thumb==0) {
die('All thumbnails deleted.');
} else {
echo($num_thumb.'Thumbnails left.<br /><br />');
}

$dat_thumb = mysql_fetch_array($raw_thumb);

unlink('../'.$dat_thumb['File_name']);
echo('Deleted flag image.<br />');

$raw_nat = mysql_query('SELECT `NatID` FROM `'.$db_pref.'data` WHERE `Flag_thumb` = \''.$dat_thumb['ID'].'\'');
$num_nat = mysql_num_rows($raw_nat);
for($a=0;$a<$num_nat;$a++) {
$dat_nat = mysql_fetch_array($raw_nat);
mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_thumb` = \'0\' WHERE `NatID` = \''.$dat_nat['NatID'].'\'');
}
echo('Removed references to thumbnail in database.');

mysql_query('DELETE FROM `'.$db_pref.'flags` WHERE `ID` = \''.$dat_thumb['ID'].'\'');
echo('Removed row in table.');



?>