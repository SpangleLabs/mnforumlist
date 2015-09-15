<?

function function_action_editculture($ID,$newcomment,$db_pref) {
$raw_culture = mysql_query('SELECT `NatID` FROM `'.$db_pref.'culture` WHERE `ID` = \''.$ID.'\'');
$num_culture = mysql_num_rows($raw_culture);
if($num_culture==1) {

mysql_query('UPDATE `'.$db_pref.'culture` SET `Comment` = \''.$newcomment.'\' WHERE `ID` = \''.$ID.'\'');
$output = 'Updated comment for cultural item ID '.$ID.'.<br />';

} else {
$output = 'Cultural item by this ID number does not exist.<br />';
}

return $output;
}

?>