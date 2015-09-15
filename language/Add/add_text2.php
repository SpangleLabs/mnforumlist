<?
header('Content-Type:text/html; charset=UTF-8');
include('../../connect.php');

$sql_addtext = 'INSERT INTO `'.$db_pref.'lang_text` (`Text_Title`,`Language`,`Text`,`Translator`) VALUES (\''.$_POST['Text_Title'].'\',\''.$_POST['Language'].'\',\''.$_POST['Text'].'\',\''.$_POST['Translator'].'\')';
$raw_addtext = mysql_query($sql_addtext);

$sql_requests = 'SELECT `ID` FROM `'.$db_pref.'lang_request_text` WHERE `Fixed` = \'N\' AND `Language` = \''.$_POST['Language'].'\' AND `Text` = \''.$_POST['Text_Title'].'\'';
$raw_requests = mysql_query($sql_requests);
$num_requests = mysql_num_rows($raw_requests);
for($a=0;$a<$num_requests;$a++) {
$dat_requests = mysql_fetch_array($raw_requests);
$sql_fixrequests = 'UPDATE `'.$db_pref.'lang_request_text` SET `Fixed` = \'Y\' WHERE `ID` = \''.$dat_requests['ID'].'\'';
$raw_fixrequests = mysql_query($sql_fixrequests);
}

echo('Text added.. <a href="requestlist.php">Back to the list of requests</a>');



?>