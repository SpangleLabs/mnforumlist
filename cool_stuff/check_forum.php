<?
include('connect.php');

$raw_forum = mysql_query('SELECT `NatID`, `Forum`,`Forum_status` FROM '.$db_pre.'forums WHERE `ID` = \''.$_GET['ID'].'\'');
$dat_forum = mysql_fetch_array($raw_forum);

$raw_nation = mysql_query('SELECT `Name` FROM '.$db_pre.'data WHERE NatID = \''.$dat_forum['NatID'].'\'');
$dat_nation = mysql_fetch_array($raw_nation);


echo('<a href="'.$dat_forum['Forum'].'">Click here</a> to go to this forum, it belongs to '.$dat_nation['Name'].' and it&#039;s status is "'.$dat_forum['Forum_status'].'"');

$raw_logs = mysql_query('SELECT `Year`, `Month`, `Day`, `Post_count` FROM '.$db_pre.'activity_forums WHERE `ForumID` = \''.$_GET['ID'].'\' ORDER BY `Year`,`Month`,`Day`');
$num_logs = mysql_num_rows($raw_logs);

echo('<table border="1"><tr><td>Date</td><td>postcount</td></tr>');

for($a=0;$a<$num_logs;$a++) {
$dat_logs = mysql_fetch_array($raw_logs);

echo('<tr><td>'.$dat_logs['Day'].'/'.$dat_logs['Month'].'/'.$dat_logs['Year'].'</td><td>'.$dat_logs['Post_count'].'</td></tr>');


}
?>