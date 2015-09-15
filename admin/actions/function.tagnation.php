<?

function function_action_tagnation($nation,$category,$current,$start,$end,$db_pref) {

$sql_tagnation = 'INSERT INTO `'.$db_pref.'tags_tagged` (`NatID`,`Tag_ID`,`Current`,`Date_Added`,`Date_Removed`)
 VALUES (\''.$nation.'\',\''.$category.'\',\''.$current.'\',\''.$start.'\',\''.$end.'\')';
$raw_tagnation = mysql_query($sql_tagnation);

if($raw_tagnation==1) {
$output = 'Nation has been tagged.';
} else {
$output = 'Nation could not be tagged.';
}

return $output;
}

?>