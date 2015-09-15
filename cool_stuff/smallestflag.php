<?
include('../connect.php');


$sql_flags = 'SELECT `NatID`,`File_name`,`Length_Y` FROM `'.$db_pref.'flags` WHERE `Type` = \'Main\' ORDER BY `Length_Y` ASC';
$raw_flags = mysql_query($sql_flags);
$num_flags = mysql_num_rows($raw_flags);

for($a=0;$a<$num_flags;$a++) {
$dat_flags = mysql_fetch_array($raw_flags);
$sql_name = 'SELECT `Name` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$dat_flags['NatID'].'\'';
$raw_name = mysql_query($sql_name);
$dat_name = mysql_fetch_array($raw_name);

echo('<a href="../nation.php?ID='.$dat_flags['NatID'].'"><img src="../'.$dat_flags['File_name'].'" />Height: '.$dat_flags['Length_Y'].'px, Nation: '.$dat_name['Name'].'.</a><br /><br />');


}




?>