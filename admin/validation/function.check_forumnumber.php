<?

function function_check_forumnumber($id,$db_pre,$fix) {

$dat_nation = mysql_fetch_array(mysql_query('SELECT Forums FROM '.$db_pre.'data WHERE NatID = \''.$id.'\''));
$num_forums = mysql_num_rows(mysql_query('SELECT ID FROM '.$db_pre.'forums WHERE NatID = \''.$id.'\''));

if($dat_nation['Forums']!=$num_forums) {
$output = 'Error : Wrong number of forums listed in data table for row '.$id.".\n";

if($fix==1) {
mysql_query('UPDATE '.$db_pre.'data SET Forums = \''.$num_forums.'\' WHERE NatID = \''.$id.'\'');

$output .= 'Fixed the error.'."\n\n";
} else { $output .= "\n"; }
}


return $output;
}

?>