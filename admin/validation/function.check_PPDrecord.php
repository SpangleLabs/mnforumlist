<?

function function_check_PPD($id,$db_pre,$fix) {

$last_month = mktime(0,0,0,(date(m)),1,date(y));
$blast_month = mktime(0,0,0,(date(m)-1),1,date(y));
$raw_old_log = mysql_query('SELECT Post_count FROM '.$db_pre.'activity WHERE NatID = \''.$id.'\' AND Year = \''.date(Y,$blast_month).'\' AND Month = \''.date(m,$blast_month).'\'');
$num_old_log = mysql_num_rows($raw_old_log);
$raw_new_log = mysql_query('SELECT Post_count FROM '.$db_pre.'activity WHERE NatID = \''.$id.'\' AND Year = \''.date(Y,$last_month).'\' AND Month = \''.date(m,$last_month).'\'');
$num_new_log = mysql_num_rows($raw_new_log);

$raw_listed_PPD = mysql_query('SELECT PPD FROM '.$db_pre.'data WHERE NatID = \''.$id.'\'');
$dat_listed_PPD = mysql_fetch_array($raw_listed_PPD);

if($num_old_log==0 || $num_new_log==0) {
if($dat_listed_PPD['PPD']!='-123456.789') {
$output = 'Error : PPD is listed for row '.$id.' when no logs were made.'."\n";
if($fix==1) {
mysql_query('UPDATE '.$db_pre.'data SET PPD = \'-123456.789\' WHERE NatID = \''.$id.'\'');
$output .= 'PPD listing removed.'."\n\n";
} else {
$output .= "\n";
}}


} else {
//There are logs
$dat_new_log = mysql_fetch_array($raw_new_log);
$dat_old_log = mysql_fetch_array($raw_old_log);
$PPD = (($dat_new_log['Post_count'] - $dat_old_log['Post_count'])/date(t,$last_month));
if(round($PPD,3)!=$dat_listed_PPD['PPD']) {
$output = 'Error : PPD listed for '.$id.' in data table is incorrect.'."\n";
if($fix==1) {
mysql_query('UPDATE '.$db_pre.'data SET PPD = \''.round($PPD,3).'\' WHERE NatID = \''.$id.'\'');
$output .= 'Updated PPD record in data table'."\n\n";

} else {
$output .= "\n";
}

}

}


return $output;
}

?>