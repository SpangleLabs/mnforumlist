<?
include('../connect.php');
die('this code has served it&#39;s duty and is now decommissioned.');

$raw_logs = mysql_query('SELECT ID, Day, Month, Year FROM '.$db_pre.'activity ORDER BY ID');
$num_logs = mysql_num_rows($raw_logs);

for($a=0;$a<$num_logs;$a++) {
$dat_logs = mysql_fetch_array($raw_logs);

$new_date = floor($dat_logs['Year']*365.2425);
$new_date += gmdate('z',gmmktime(1,0,0,$dat_logs['Month'],$dat_logs['Day'],$dat_logs['Year']))+1;


mysql_query('UPDATE '.$db_pre.'activity SET Date = \''.$new_date.'\' WHERE ID = \''.$dat_logs['ID'].'\'');
//echo('<br />');

}



?>