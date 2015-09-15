<?
include('../../connect.php');

$sql_forums = 'SELECT 
 forums.ID as Forum_ID, 
 forums.NatID as Nation_ID, 
 forums.Forum as Forum_Link, 
 data.Name as Nation_Name 
 FROM `'.$db_pref.'forums` forums
 LEFT JOIN `'.$db_pref.'data` data ON data.NatID = forums.NatID
 WHERE Forum_Status = \'In use\'
 ORDER BY Forum_ID ASC';


//$sql_forums = 'SELECT `ID`,`Link` FROM `'.$db_pref.'Forums` WHERE `Status` = \'In Use\'';
$raw_forums = mysql_query($sql_forums);
$num_forums = mysql_num_rows($raw_forums);

echo('<table border="1" style="border-collapse: collapse">
<tr>
<td>ID</td>
<td>Nation</td>
<td>Link</td>
<td>Dec 2011</td>
<td>Jan 2012</td>
<td>Feb 2012</td>
<td>Mar 2012</td>
<td>D0</td>
<td>D1</td>
<td>D2</td>
<td>D^2,0</td>
<td>D^2,1</td>
<td>D^3,0</td>
<td>ID</td>
</tr>');
for($a=0;$a<$num_forums;$a++) {
$dat_forums = mysql_fetch_array($raw_forums);

$sql_dec = 'SELECT `Post_Count` FROM `'.$db_pref.'activity_forums` WHERE `ForumID` = \''.$dat_forums['Forum_ID'].'\' AND `Year` = \'2011\' AND `Month` = \'12\'';
$raw_dec = mysql_query($sql_dec);
$num_dec = mysql_num_rows($raw_dec);
if($num_dec==1) {
$dat_dec = mysql_fetch_array($raw_dec);
} else {
$dat_dec['Post_Count'] = '<b>Unavailable</b>';
}

$sql_jan = 'SELECT `Post_Count` FROM `'.$db_pref.'activity_forums` WHERE `ForumID` = \''.$dat_forums['Forum_ID'].'\' AND `Year` = \'2012\' AND `Month` = \'1\'';
$raw_jan = mysql_query($sql_jan);
$num_jan = mysql_num_rows($raw_jan);
if($num_jan==1) {
$dat_jan = mysql_fetch_array($raw_jan);
} else {
$dat_jan['Post_Count'] = '<b>Unavailable</b>';
}

$sql_feb = 'SELECT `Post_Count` FROM `'.$db_pref.'activity_forums` WHERE `ForumID` = \''.$dat_forums['Forum_ID'].'\' AND `Year` = \'2012\' AND `Month` = \'2\'';
$raw_feb = mysql_query($sql_feb);
$num_feb = mysql_num_rows($raw_feb);
if($num_feb==1) {
$dat_feb = mysql_fetch_array($raw_feb);
} else {
$dat_feb['Post_Count'] = '<b>Unavailable</b>';
}

$sql_mar = 'SELECT `Post_Count` FROM `'.$db_pref.'activity_forums` WHERE `ForumID` = \''.$dat_forums['Forum_ID'].'\' AND `Year` = \'2012\' AND `Month` = \'3\'';
$raw_mar = mysql_query($sql_mar);
$num_mar = mysql_num_rows($raw_mar);
if($num_mar==1) {
$dat_mar = mysql_fetch_array($raw_mar);
} else {
$dat_mar['Post_Count'] = '<b>Unavailable</b>';
}


echo('<tr>
<td>'.$dat_forums['Forum_ID'].'</td>
<td>'.$dat_forums['Nation_Name'].'</td>
<td><a href="'.$dat_forums['Forum_Link'].'">Link</a></td>
<td>'.$dat_dec['Post_Count'].'</td>
<td>'.$dat_jan['Post_Count'].'</td>
<td>'.$dat_feb['Post_Count'].'</td>
<td>'.$dat_mar['Post_Count'].'</td>
<td>'.($dat_jan['Post_Count']-$dat_dec['Post_Count']).'</td>
<td>'.($dat_feb['Post_Count']-$dat_jan['Post_Count']).'</td>
<td>'.($dat_mar['Post_Count']-$dat_feb['Post_Count']).'</td>
<td>'.(($dat_feb['Post_Count']-$dat_jan['Post_Count'])-($dat_jan['Post_Count']-$dat_dec['Post_Count'])).'</td>
<td>'.(($dat_mar['Post_Count']-$dat_feb['Post_Count'])-($dat_feb['Post_Count']-$dat_jan['Post_Count'])).'</td>
<td>'.((($dat_mar['Post_Count']-$dat_feb['Post_Count'])-($dat_feb['Post_Count']-$dat_jan['Post_Count']))-(($dat_feb['Post_Count']-$dat_jan['Post_Count'])-($dat_jan['Post_Count']-$dat_dec['Post_Count']))).'</td>
<td>'.$dat_forums['Forum_ID'].'</td>
</tr>');


}


echo('</table>');


?>