<?

function function_action_killnation($NatID,$db_pre) {

$raw_data = mysql_query('SELECT `Name` FROM '.$db_pre.'data WHERE `NatID` = \''.$NatID.'\'');
$dat_data = mysql_fetch_array($raw_data);

mysql_query('UPDATE '.$db_pre.'data SET `Status` = \''.Dead.'\' WHERE NatID = \''.$NatID.'\'');

$raw_forums = mysql_query('SELECT ID FROM '.$db_pre.'forums WHERE NatID = \''.$NatID.'\'');
$num_forums = mysql_num_rows($raw_forums);

for($a=0;$a<$num_forums;$a++) {
$dat_forums = mysql_fetch_array($raw_forums);
function_action_killforum($dat_forums['ID'],$db_pre);
}

if($a==0) {
$output = 'Nation set to dead, it had no fora.';
} else {
$output = 'Nation set to dead, along with it&#39;s '.$a.' fora.';
}

return $output;
}

?>