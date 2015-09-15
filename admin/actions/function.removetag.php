<?

function function_action_removetag($nation,$category,$db_pref) {

$sql_checktagged = 'SELECT `ID` FROM `'.$db_pref.'tags_tagged` WHERE `NatID` = \''.$nation.'\' AND `Tag_ID` = \''.$category.'\' AND `Current` = \'Y\'';
$raw_checktagged = mysql_query($sql_checktagged);
$num_checktagged = mysql_num_rows($raw_checktagged);
if($num_checktagged==1) {
$dat_checktagged = mysql_fetch_array($raw_checktagged);
$sql_removetag1 = 'UPDATE `'.$db_pref.'tags_tagged` SET `Current` = \'N\' WHERE `ID` = \''.$dat_checktagged['ID'].'\'';
$raw_removetag1 = mysql_query($sql_removetag1);
$sql_removetag2 = 'UPDATE `'.$db_pref.'tags_tagged` SET `Date_Removed` = \''.gmmktime().'\' WHERE `ID` = \''.$dat_checktagged['ID'].'\'';
$raw_removetag2 = mysql_query($sql_removetag2);
if(($raw_removetag1+$raw_removetag2)!=2) {
$output = 'Could not remove nation from this category.';
} else {
$output = 'Removed nation from this category.';
}

} else {
$output = 'Nation is not in this category.';
}

return $output;
}

?>