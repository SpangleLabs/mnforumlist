<?
include('../../connect.php');

echo('
<html>
<head>	<meta http-equiv="content-type"
 		content="text/html;charset=utf-8" />
</head>
<body>
<a href="requestlist-cleanup.php">Remove double entries and entires that have already been added.</a><table border="1">
<tr>
<td><b>ID</b></td>
<td><b>Language</b></td>
<td><b>Text</b></td>
<td><b>Date</b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>');

$sql_requests = 'SELECT `ID`,`Language`,`Text`,`Date` FROM `'.$db_pref.'lang_request_text` WHERE `Fixed` = \'N\' ORDER BY `Language`,`Text`';
$raw_requests = mysql_query($sql_requests);
$num_requests = mysql_num_rows($raw_requests);
for($a=0;$a<$num_requests;$a++) {
$dat_requests = mysql_fetch_array($raw_requests);
$sql_language = 'SELECT `Name` FROM `'.$db_pref.'langs` WHERE `ID` = \''.$dat_requests['Language'].'\'';
$raw_language = mysql_query($sql_language);
$dat_language = mysql_fetch_array($raw_language);

echo('<tr>
<td>'.$dat_requests['ID'].'</td>
<td>'.$dat_language['Name'].'</td>
<td>'.$dat_requests['Text'].'</td>
<td>'.gmdate('H:i:s d\/m\/Y',$dat_requests['Date']).'</td>
<td><a href="add_text.php?ID='.$dat_requests['ID'].'">ADD</a></td>
<td><a href="del_request.php?ID='.$dat_requests['ID'].'">DELETE</a></td>
</tr>');

}
echo('</table>
</body></html>');

?>