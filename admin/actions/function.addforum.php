<?

function function_action_addforum($natID,$url,$status,$type,$db_pre) {

mysql_query('INSERT INTO '.$db_pre.'forums (NatID,Forum,Forum_Count,Forum_status,Type,Type_Count) VALUES (\''.$natID.'\',\''.$url.'\',\''.$url.'\',\''.$status.'\',\''.$type.'\',\''.$type.'\')');

$output = 'Forum has been added to nation id '.$natID.'.';

if($status!="In use") {
$raw_logs = mysql_query('SELECT ID, Post_count FROM '.$db_pre.'activity WHERE NatID = \''.$natID.'\'');
$num_logs = mysql_num_rows($raw_logs);

for($a=0;$a<$num_logs;$a++) {
$dat_logs = mysql_fetch_array($raw_logs);
$posts = str_replace(' posts','',$status);
mysql_query('UPDATE '.$db_pre.'activity SET Post_count = \''.($dat_logs['Post_count']+$posts).'\' WHERE ID = \''.$dat_logs['ID'].'\'');
}
$output .= ' Updated all '.$a.' previous activity logs.';

}

return $output;
}

?>