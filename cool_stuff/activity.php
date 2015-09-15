<?
include('header.php');
include('connect.php');

if(isset($_GET['ID'])) { } else {
die('No Nation selected');
}

if($_GET['ID']==0) { $sql_part = 'NatID LIKE \'%\''; } else { $sql_part = 'NatID = \''.$_GET['ID'].'\''; }
$raw_name = mysql_query('SELECT Name FROM '.$db_pre.'data WHERE '.$sql_part.'');
$dat_name = mysql_fetch_array($raw_name);
if($_GET['ID']==0) { $dat_name['Name'] = 'All'; }

$raw_fora = mysql_query('SELECT ID FROM '.$db_pre.'forums WHERE '.$sql_part.'');
$num_fora = mysql_num_rows($raw_fora);
if($num_fora!=1 || $_GET['ID']=='0') { $forum_word = 'fora'; } else { $forum_word='forum'; }

echo('<h1>Activity statistics of <a href="nation.php?ID='.$_GET['ID'].'">'.$dat_name['Name'].'</a>.</h1>
(<a href="nation.php?ID='.$_GET['ID'].'">'.$dat_name['Name'].'</a> has <a href="forums.php?ID='.$_GET['ID'].'">'.$num_fora.'</a> '.$forum_word.'.)<br />
<table border="1">
<tr>
<td>Date recorded</td>
<td>Total post count</td>
<td>Posts since last record</td>
</tr>');


$raw_firstlog = mysql_query('SELECT `Year`, `Month` FROM '.$db_pre.'activity WHERE '.$sql_part.' ORDER BY Year ASC, Month ASC');
$dat_firstlog = mysql_fetch_array($raw_firstlog);
$raw_lastlog = mysql_query('SELECT `Year`, `Month` FROM '.$db_pre.'activity WHERE '.$sql_part.' ORDER BY Year DESC, Month DESC');
$dat_lastlog = mysql_fetch_array($raw_lastlog); 
$graph_URL='graph/graph.php?Name0='.$dat_name['Name'].'&Dots0=Diamond&Lcol0R=0&Lcol0G=0&Lcol0B=255&Dcol0R=0&Dcol0G=0&Dcol0B=255';

$total_logs = (($dat_lastlog['Year']-$dat_firstlog['Year'])*12)+($dat_lastlog['Month']-$dat_firstlog['Month'])+1;

for($a=0;$a<$total_logs;$a++) {
$time = gmmktime(1,1,1,$dat_firstlog['Month'],1,$dat_firstlog['Year']);
$raw_log[$a] = mysql_query('SELECT `Post_count` FROM '.$db_pre.'activity WHERE '.$sql_part.' AND Year = \''.$dat_firstlog['Year'].'\' AND Month = \''.$dat_firstlog['Month'].'\'');

if($_GET['ID']==0) {
$num_log[$a] = mysql_num_rows($raw_log[$a]);

for($b=0;$b<$num_log[$a];$b++) {
$raw_dat_log[$a] = mysql_fetch_array($raw_log[$a]);
$dat_log[$a]['rawPost_count'] += $raw_dat_log[$a]['Post_count'];
}
$dat_log[$a]['Post_count'] = $dat_log[$a]['rawPost_count']/$num_log[$a];


} else {
$dat_log[$a] = mysql_fetch_array($raw_log[$a]);
}


$dat_firstlog['Month']++;
if($dat_firstlog['Month']>=13) {
$dat_firstlog['Year']++;
$dat_firstlog['Month'] = 1;
}

echo('<tr><td>1st '.gmdate(M,$time).' '.gmdate(Y,$time).'</td>
<td>'.$dat_log[$a]['Post_count'].'</td>');

if($dat_log[$a-1]['Post_count']!='' && $dat_log[$a]['Post_count']!='') {
$month_posts = ($dat_log[$a]['Post_count']-$dat_log[$a-1]['Post_count']);
echo('<td>'.$month_posts.'</td></tr>');
$graph_URL .= '&Lab'.$a.'='.gmdate(M,$time).gmdate(y,$time).'&Data0-'.$a.'='.$month_posts;
} else {
echo('<td>&nbsp;</td></tr>');
$graph_URL .= '&Lab'.$a.'='.gmdate(M,$time).gmdate(y,$time).'&Data0-'.$a.'=0';
}

}


if($_GET['ID']==19) { $graph_URL .= '&Vert_max=1200'; }
echo('<tbody><img src="'.$graph_URL.'" alt="activity Graph" /></tbody></table>');


include('footer.php');


?>
