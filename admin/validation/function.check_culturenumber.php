<?

function function_check_culturenumber($id,$db_pre,$fix) {

$dat_nation = mysql_fetch_array(mysql_query('SELECT Culture_items FROM '.$db_pre.'data WHERE NatID = \''.$id.'\''));
$num_culture = mysql_num_rows(mysql_query('SELECT ID FROM '.$db_pre.'culture WHERE NatID = \''.$id.'\''));

if($dat_nation['Culture_items']!=$num_culture) {
$output = 'Error : Wrong number of cultural items listed in data table for row '.$id.".\n";

if($fix==1) {
mysql_query('UPDATE '.$db_pre.'data SET Culture_items = \''.$num_culture.'\' WHERE NatID = \''.$i.'\'');

$output .= 'Fixed the error.'."\n\n";
} else { $output .= "\n"; }
}


return $output;
}

?>