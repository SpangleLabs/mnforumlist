<?

function function_check_lognumber($id,$db_pre,$fix) {

$dat_nation = mysql_fetch_array(mysql_query('SELECT Logs FROM '.$db_pre.'data WHERE NatID = \''.$id.'\''));
$num_logs = mysql_num_rows(mysql_query('SELECT ID FROM '.$db_pre.'activity WHERE NatID = \''.$id.'\''));

if($dat_nation['Logs']!=$num_logs) {
$output = 'Error : Wrong number of activity logs listed in data table for row '.$id.".\n";

if($fix==1) {
mysql_query('UPDATE '.$db_pre.'data SET Logs = \''.$num_logs.'\' WHERE NatID = \''.$id.'\'');

$output .= 'Fixed the error.'."\n\n";
} else { $output .= "\n"; }
}


return $output;
}

?>