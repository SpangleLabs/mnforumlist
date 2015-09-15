<?
include('header.php');
include('connect.php');

//Check ID has been set.
if(!isset($_GET['ID'])) {
echo(function_lang('NO_NATID',$conf_lang,$db_pref));
include('footer.php');
die();
}

$raw_forum = mysql_query('SELECT `NatID`, `Forum`,`Forum_status` FROM '.$db_pre.'forums WHERE `ID` = \''.$_GET['ID'].'\'');
$dat_forum = mysql_fetch_array($raw_forum);
$raw_nation = mysql_query('SELECT `Name` FROM '.$db_pre.'data WHERE `NatID` = \''.$dat_forum['NatID'].'\'');
$dat_nation = mysql_fetch_array($raw_nation);

echo('<h1>'.function_lang('FORUMLOGS_TITLE',$conf_lang,$db_pref,array($_GET['ID'])).'</h1>
'.function_lang('FORUMLOGS_INFO',$conf_lang,$db_pref,array($dat_forum['NatID'],$dat_nation['Name'],$dat_forum['Forum_status'],function_spamstop($dat_forum['Forum']))));

$raw_logs = mysql_query('SELECT `Year`, `Month`, `Day`, `Post_count` FROM '.$db_pre.'activity_forums WHERE `ForumID` = \''.$_GET['ID'].'\' ORDER BY `Year`,`Month`,`Day`');
$num_logs = mysql_num_rows($raw_logs);

echo('<table border="1"><tr>
<td>'.function_lang('INFO_COL_DATE',$conf_lang,$db_pref).'</td>
<td>'.function_lang('INFO_COL_POSTCOUNT',$conf_lang,$db_pref).'</td>
</tr>');

for($a=0;$a<$num_logs;$a++) {
$dat_logs = mysql_fetch_array($raw_logs);

echo('<tr><td>'.str_pad($dat_logs['Day'],2,0,STR_PAD_LEFT).'/'.str_pad($dat_logs['Month'],2,0,STR_PAD_LEFT).'/'.$dat_logs['Year'].'</td><td>'.$dat_logs['Post_count'].'</td></tr>');
}
echo('</table>');
include('footer.php');
?>