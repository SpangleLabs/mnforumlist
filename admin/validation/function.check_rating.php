<?

function function_check_rating($id,$db_pre,$fix) {

$dat_nation = mysql_fetch_array(mysql_query('SELECT `Rating` FROM `'.$db_pre.'data` WHERE `NatID` = \''.$id.'\''));
$raw_latestrating = mysql_query('SELECT `Total` FROM `'.$db_pre.'ratings` WHERE `NatID` = \''.$id.'\' ORDER BY `Date` DESC LIMIT 0,1');
$dat_latestrating = mysql_fetch_array($raw_latestrating);
$num_latestrating = mysql_num_rows($raw_latestrating);
if($num_latestrating==0) {
$dat_latestrating['Total'] = 0.0;
}

if($dat_latestrating['Total']!=$dat_nation['Rating']) {
$output = 'Error : Wrong OMRC rating listed in data table for row '.$id.".\n";

if($fix==1) {
mysql_query('UPDATE `'.$db_pre.'data` SET `Rating` = \''.$dat_latestrating['Total'].'\' WHERE `NatID` = \''.$id.'\'');

$output .= 'Fixed the error.'."\n\n";
} else { $output .= "\n"; }
}


return $output;
}

?>