<?
include('../../connect.php');
$quiet = 0;
//first check for double entries.
if($quiet==0) { echo('<h1>Checking for double entries.</h1>'); }
$array_uniquerequests = array();
$num_uniquerequests = 0;

$sql_requests = 'SELECT `ID`,`Language`,`Text` FROM `'.$db_pref.'lang_request_text` WHERE `Fixed` = \'N\'';
$raw_requests = mysql_query($sql_requests);
$num_requests = mysql_num_rows($raw_requests);
for($a=0;$a<$num_requests;$a++) {
$dat_requests = mysql_fetch_array($raw_requests);
$key = $dat_requests['Language'].'-<>-'.$dat_requests['Text'];
if(in_array($key,$array_uniquerequests)) {
$raw_deleterequest = mysql_query('UPDATE `'.$db_pref.'lang_request_text` SET `Fixed` = \'Y\' WHERE `ID` = \''.$dat_requests['ID'].'\'');
if($quiet==0) { echo('Removed an entry.<br />'); }
} else {
$array_uniquerequests[$num_uniquerequests] = $key;
$num_uniquerequests++;
if($quiet==0) { echo('Here&#39;s a unique entry.<br />'); }
}
unset($key);
}


//Now check to see if the requests are still valid
if($quiet==0) { echo('<h1>Checking requests have not been fulfilled</h1>'); }

$sql_requests = 'SELECT `ID`,`Language`,`Text` FROM `'.$db_pref.'lang_request_text` WHERE `Fixed` = \'N\'';
$raw_requests = mysql_query($sql_requests);
$num_requests = mysql_num_rows($raw_requests);
for($a=0;$a<$num_requests;$a++) {
$dat_requests = mysql_fetch_array($raw_requests);
$sql_checkrequest = 'SELECT `ID` FROM `'.$db_pref.'lang_text` WHERE `Language` = \''.$dat_requests['Language'].'\' AND `Text` = \''.$dat_requests['Text'].'\'';
$raw_checkrequest = mysql_query($sql_checkrequest);
$num_checkrequest = mysql_num_rows($raw_checkrequest);
if($num_checkrequest==0) {
if($quiet==0) { echo('This text element needs to be created.<br />'); }
} else {
if($quiet==0) { echo('This text element already exists.<br />'); }
$raw_deleterequest = mysql_query('UPDATE `'.$db_pref.'lang_request_text` SET `Fixed` = \'Y\' WHERE `ID` = \''.$dat_requests['ID'].'\'');
}




}


?>
