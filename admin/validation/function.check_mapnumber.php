<?

function function_check_mapnumber($id,$db_pre,$fix) {

$dat_nation = mysql_fetch_array(mysql_query('SELECT Maps FROM '.$db_pre.'data WHERE NatID = \''.$id.'\''));
$num_maps = mysql_num_rows(mysql_query('SELECT ID FROM '.$db_pre.'maps WHERE NatID = \''.$id.'\''));

if($dat_nation['Maps']!=$num_maps) {
$output = 'Error : Wrong number of maps listed in data table for row '.$id.".\n";

if($fix==1) {
mysql_query('UPDATE '.$db_pre.'data SET Maps = \''.$num_maps.'\' WHERE NatID = \''.$id.'\'');

$output .= 'Fixed the error.'."\n\n";
} else { $output .= "\n"; }
}


return $output;
}

?>