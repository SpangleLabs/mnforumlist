<?

function function_action_killflag($ID,$db_pref) {

$raw_flag = mysql_query('SELECT `File_name`,`ThumbID` FROM `'.$db_pref.'flags` WHERE `ID` = \''.$ID.'\'');
$num_flag = mysql_num_rows($raw_flag);
if($num_flag!=1) {
$output = 'Invalid Flag ID.<br />';
} 
$dat_flag = mysql_fetch_array($raw_flag);

unlink('../../'.$dat_flag['File_name']);
$output .= 'Deleted flag.<br />';

mysql_query('DELETE FROM `'.$db_pref.'flags` WHERE `ID` = \''.$ID.'\'');
$output .= 'Deleted record from database.<br />';


if($dat_flag['ThumbID']!=0) {
$output .= 'Detected thumbnail.<br />';
$raw_thumb = mysql_query('SELECT `File_name` FROM `'.$db_pref.'flags` WHERE `ID` = \''.$dat_flag['ThumbID'].'\'');
$num_thumb = mysql_num_rows($raw_thumb);
if($num_thumb!=1) {
$output .= 'Invalid thumbnail ID';
}
$dat_thumb = mysql_fetch_array($raw_thumb);

unlink('../../'.$dat_thumb['File_name']);
$output .= 'Deleted thumbnail.<br />'.

mysql_query('DELETE FROM `'.$db_pref.'flags` WHERE `ID` = \''.$dat_flag['ThumbID'].'\'');
$output .= 'Deleted thumbnail record from database.<br />';

$raw_thumbset = mysql_query('SELECT `NatID` FROM `'.$db_pref.'data` WHERE `Flag_thumb` = \''.$dat_flag['ThumbID'].'\'');
$num_thumbset = mysql_num_rows($raw_thumbset);
if($num_thumbset==1) {
$dat_thumbset = mysql_fetch_array($raw_thumbset);
mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_thumb` = \'0\' WHERE `NatID` = \''.$dat_thumbset['NatID'].'\'');
$output .= 'Thumbnail unset as default for nation.<br />';
}}

$raw_flagset = mysql_query('SELECT `NatID` FROM `'.$db_pref.'data` WHERE `Flag_main` = \''.$ID.'\'');
$num_flagset = mysql_num_rows($raw_flagset);
if($num_flagset==1) {
$dat_flagset = mysql_fetch_array($raw_flagset);
mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_main` = \'0\' WHERE `NatID` = \''.$dat_flagset['NatID'].'\'');
$output .= 'Flag unset as default for nation.<br />';
}

return $output;
}

?>