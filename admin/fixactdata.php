<?
include('../connect.php');

//die('out of action');
$raw_data = mysql_query('SELECT `NatID` FROM `'.$db_pref.'data` ORDER BY `NatID`');
$num_data = mysql_num_rows($raw_data);
for($a=0;$a<$num_data;$a++) {
$dat_data = mysql_fetch_array($raw_data);

echo('bam');

$raw_actlogs = mysql_query('SELECT `ID` FROM `'.$db_pref.'activity` WHERE `NatID` = \''.$dat_data['NatID'].'\' ORDER BY `Date` DESC');
$num_actlogs = mysql_num_rows($raw_actlogs);
if($num_actlogs>=2) {
echo('BAM');
$new_actlog = mysql_fetch_array($raw_actlogs);
$old_actlog = mysql_fetch_array($raw_actlogs);
mysql_query('UPDATE `'.$db_pref.'data` SET `Act_IDOld` = \''.$old_actlog['ID'].'\' WHERE `NatID` = \''.$dat_data['NatID'].'\'');
mysql_query('UPDATE `'.$db_pref.'data` SET `Act_IDNew` = \''.$new_actlog['ID'].'\' WHERE `NatID` = \''.$dat_data['NatID'].'\'');
}


echo('<br/>');
}


?>