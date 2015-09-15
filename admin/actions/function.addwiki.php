<?

function function_action_addwiki($name,$link,$first_bit,$last_bit,$db_pref) {


$sql_addwiki = 'INSERT INTO `'.$db_pref.'wikis` (`Name`,`Link`,`First_bit`,`Last_bit`) VALUES (\''.$name.'\',\''.$link.'\',\''.$first_bit.'\',\''.$last_bit.'\')';
$raw_addwiki = mysql_query($sql_addwiki);

if($raw_addwiki==1) {
$output = 'Wiki has been added.';
} else {
$output = 'Wiki could not be added';
}

return $output;
}

?>