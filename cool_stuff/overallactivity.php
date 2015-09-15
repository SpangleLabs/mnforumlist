<?
include('../connect.php');

echo('<table border="1">
<tr>
<td>Month</td>
<td>Total posts</td>
<td>Total logs</td>
<td>Average per forum</td></tr>');

for($a=1;$a<=12;$a++) {
$raw_month_activity = mysql_query('SELECT `Post_count` FROM `'.$db_pref.'activity_forums` WHERE `Month` = \''.$a.'\'');
$num_month_activity = mysql_num_rows($raw_month_activity);

$month_logs[$a] = 0;
$month_total[$a] = 0;
for($b=0;$b<$num_month_activity;$b++) {
$dat_month_activity = mysql_fetch_array($raw_month_activity);

if(($dat_month_activity['Post_count']/2) != 0) {
$month_logs[$a]++;
$month_total[$a] += $dat_month_activity['Post_count'];
}
}
echo('<tr><td>'.$a.'</td>
<td>'.$month_total[$a].'</td>
<td>'.$month_logs[$a].'</td>
<td>'.($month_total[$a]/$month_logs[$a]).'</td>
</tr>');
}

echo('</table>



<img src="../graph/graph.php?Name0='.$dat_name['Name'].'&Dots0=Diamond&Lcol0R=0&Lcol0G=0&Lcol0B=255&Dcol0R=0&Dcol0G=0&Dcol0B=255');
for($a=1;$a<=12;$a++) {
echo('&Lab'.($a-1).'='.gmdate(M,gmmktime(0,0,0,$a,1,2009)).'&Data0-'.($a-1).'='.($month_total[$a]/$month_logs[$a]));
}
echo('" alt="graph" />');
?>