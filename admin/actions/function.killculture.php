<?


function function_action_killculture($ID,$db_pref) {
$output = '';

$raw_culturalitem = mysql_query('SELECT `File_name`,`NatID` FROM `'.$db_pref.'culture` WHERE `ID` = \''.$ID.'\'');
$num_culturalitem = mysql_num_rows($raw_culturalitem);
if($num_culturalitem!=1) {
$output .= 'No cultural item exists by this ID number.';
} else {
$dat_culturalitem = mysql_fetch_array($raw_culturalitem);

$file_addr = '../../culture/'.str_pad($dat_culturalitem['NatID'],4,'0',STR_PAD_LEFT).'/'.$dat_culturalitem['File_name'];
if(!is_file($file_addr)) {
$output .= 'File is missing';
} else {
unlink($file_addr);
$output .= 'File deleted.<br />';
}

mysql_query('DELETE FROM `'.$db_pref.'culture` WHERE `ID` = \''.$ID.'\'');
$output .= 'Deleted from database.<br />';


} //ending bracket for if it does have a database record
return $output;
}


?>