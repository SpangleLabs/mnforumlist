<?

function function_rssadd($event,$db_pref,$NatID,$link,$info) {

$NatID = $NatID;
$date = gmmktime();
$link = $link;
$raw_name = mysql_query('SELECT `Name` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$NatID.'\'');
$dat_name = mysql_fetch_array($raw_name); 


if($event=="NewNation") {
$title = 'UPDATE: '.$dat_name['Name'].' added.';
$message = $dat_name['Name'].' has been added to the forumlist.'.$info;

} elseif($event=="NewFlag") {
$title = 'UPDATE: '.$dat_name['Name'].' uploads new flag.';
$message = $dat_name['Name'].' has added a new flag to the forumlist.'.$info;

} elseif($event=="NewCulture") {
$title = 'UPDATE: '.$dat_name['Name'].' uploads new cultural item.';
$message = $dat_name['Name'].' has added a new cultural item to the forumlist.'.$info;

} elseif($event=="NewDescription") {
$title = 'UPDATE: New description added for '.$dat_name['Name'];
$message = 'A new description has been added for '.$dat_name['Name'].' on the forumlist.'.str_replace('<br />',"\n",$info);

}

mysql_query('INSERT INTO `'.$db_pref.'updates` (`NatID`,`Date`,`Title`,`Link`,`Description`) VALUES
(\''.$NatID.'\',\''.$date.'\',\''.$title.'\',\''.$link.'\',\''.$message.'\')');

return 1;
}


?>