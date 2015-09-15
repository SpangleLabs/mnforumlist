<?

function function_action_changemainflag($NatID,$NewFlag,$db_pref) {

$raw_thumbid = mysql_query('SELECT `ThumbID` FROM `'.$db_pref.'flags` WHERE `ID` = \''.$NewFlag.'\'');
$num_thumbid = mysql_num_rows($raw_thumbid);
if($num_thumbid!=1) {
$output = 'New flag does not exist.<br />';
} else {
$dat_thumbid = mysql_fetch_array($raw_thumbid);

mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_main` = \''.$NewFlag.'\' WHERE `NatID` = \''.$NatID.'\'');
$output .= 'Updated main flag.<br />';
mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_thumb` = \''.$dat_thumbid['ThumbID'].'\' WHERE `NatID` = \''.$NatID.'\'');
$output .= 'Updated flag thumbnail.<br />';


} //end bracket for if($num_thumbid!=1) { } else {
return $output;
}

?>