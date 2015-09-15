<?
include('../connect.php');

echo('Here are all the nations you have not rated :D');

echo('<br /><b>Alive:</b><br /><br />');

$raw_alive = mysql_query('SELECT `NatID`,`Name` FROM `'.$db_pref.'data` WHERE `Status` = \'Alive\' ORDER BY `Name`');
$num_alive = mysql_num_rows($raw_alive);

for($a=0;$a<$num_alive;$a++) {
$dat_alive = mysql_fetch_array($raw_alive);

$raw_ratings = mysql_query('SELECT `ID` FROM `'.$db_pref.'ratings` WHERE `NatID` = \''.$dat_alive['NatID'].'\'');
$num_ratings = mysql_num_rows($raw_ratings);
if($num_ratings==0) {
echo('<a href="add_rating2.php?ID='.$dat_alive['NatID'].'">'.$dat_alive['Name'].'</a><br />');
}}

echo('<br /><br /><br /><b>Dead:</b><br /><br />');
$raw_alive = mysql_query('SELECT `NatID`,`Name` FROM `'.$db_pref.'data` WHERE `Status` = \'Dead\' ORDER BY `Name`');
$num_alive = mysql_num_rows($raw_alive);

for($a=0;$a<$num_alive;$a++) {
$dat_alive = mysql_fetch_array($raw_alive);

$raw_ratings = mysql_query('SELECT `ID` FROM `'.$db_pref.'ratings` WHERE `NatID` = \''.$dat_alive['NatID'].'\'');
$num_ratings = mysql_num_rows($raw_ratings);
if($num_ratings==0) {
echo('<a href="add_rating2.php?ID='.$dat_alive['NatID'].'">'.$dat_alive['Name'].'</a><br />');
}}

?>