<?
include('../connect.php');

$raw_months = mysql_query('SELECT DISTINCT `Day`, `Month`, `Year` FROM `'.$db_pref.'activity` ORDER BY `Year`,`Month` ASC');
$num_months = mysql_num_rows($raw_months);
echo($num_months);

$dat_total_last = 0;
echo('<table border="1">
<tr><td>Year</td>
<td>Month</td>
<td>Total Logs</td>
<td>post change (average)</td>
<td>PPD (average)</td>
<td>post change as percentage of old posts (average)</td>
</tr>');
for($a=0;$a<$num_months;$a++) {
$dat_months = mysql_fetch_array($raw_months);

$last_month = $dat_months['Month']-1;
$last_year = $dat_months['Year'];
if($last_month==0) {
$last_month = 12;
$last_year--;
}
$num_logs = 0;
$new_time = gmmktime(0,0,0,$dat_months['Month'],1,$dat_months['Year']);
$old_time = gmmktime(0,0,0,$last_month,1,$last_year);
$days = (($new_time-$old_time)/(60*60*24));
$raw_nations = mysql_query('SELECT `NatID`, `Post_count` FROM `'.$db_pref.'activity` WHERE `Year` = \''.$dat_months['Year'].'\' AND `Month` = \''.$dat_months['Month'].'\' AND `NatID` != \'47\'');
$num_nations = mysql_num_rows($raw_nations);
for($b=0;$b<$num_nations;$b++) {
$dat_nations = mysql_fetch_array($raw_nations);
$raw_old_log = mysql_query('SELECT `Post_count` FROM `'.$db_pref.'activity` WHERE `Year` = \''.$last_year.'\' AND `Month` = \''.$last_month.'\' AND `NatID` = \''.$dat_nations['NatID'].'\' AND `Post_count` < \''.$dat_nations['Post_count'].'\'');
$num_old_log = mysql_num_rows($raw_old_log);
if($num_old_log==1) {
$dat_old_log = mysql_fetch_array($raw_old_log);
$posts_change[$b] = $dat_nations['Post_count']-$dat_old_log['Post_count'];
$PPD[$b] = $posts_change[$b]/$days;
$post_percentage[$b] = ($posts_change[$b]/$dat_old_log['Post_count'])*100;
$num_logs++;
}

}

echo('<tr>
<td>'.$dat_months['Year'].'</td>
<td>'.$dat_months['Month'].'</td>
<td>'.$num_logs.'</td>
<td>'.array_sum($posts_change).' ('.array_sum($posts_change)/$num_logs.')</td>
<td>'.array_sum($PPD).' ('.array_sum($PPD)/$num_logs.')</td>
<td>'.array_sum($post_percentage).' ('.array_sum($post_percentage)/$num_logs.')</td>
</tr>');

unset($posts_change,$PPD,$post_percentage);
}



?>