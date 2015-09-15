<?

function function_check_flags($id,$db_pre,$fix) {

$raw_flags = mysql_query('SELECT `ID`,`File_name` FROM `'.$db_pre.'flags` WHERE `NatID` = \''.$id.'\'');
$num_flags = mysql_num_rows($raw_flags);

for($a=0;$a<$num_flags;$a++) {
$dat_flags = mysql_fetch_array($raw_flags);

if(!is_file('../../'.$dat_flags['File_name'])) {
$output = 'Error: Flag(s) in database for nation '.$id.' does not exist.'."\n";
if($fix==1) {
mysql_query('DELETE FROM `'.$db_pre.'flags` WHERE `ID` = \''.$dat_flags['ID'].'\'');
$output .= 'Fixed the error.'."\n\n";
} else {
$output .= "\n";
}
}
}


return $output;
}

?>