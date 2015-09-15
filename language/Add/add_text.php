<?
include('../../connect.php');
echo('<html>
<head>
	<meta http-equiv="content-type"
 		content="text/html;charset=utf-8" />
</head>
<body>');
$sql_request = 'SELECT `Language`,`Text` FROM `'.$db_pref.'lang_request_text` WHERE `ID` = \''.$_GET['ID'].'\'';
$raw_request = mysql_query($sql_request);
$dat_request = mysql_fetch_array($raw_request);

echo('<form action="add_text2.php" method="post" accept-charset="UTF-8">
Text title: <input type="text" name="Text_Title" value="'.$dat_request['Text'].'" /><br />
Language: <select type="text" name="Language">');
$sql_languages = 'SELECT `ID`,`Name` FROM `'.$db_pref.'langs`';
$raw_languages = mysql_query($sql_languages);
$num_languages = mysql_num_rows($raw_languages);
for($a=0;$a<$num_languages;$a++) {
$dat_languages = mysql_fetch_array($raw_languages);
if($dat_languages['ID']==$dat_request['Language']) {
echo('<option value="'.$dat_languages['ID'].'" selected="selected">'.$dat_languages['Name'].'</option>');
} else {
echo('<option value="'.$dat_languages['ID'].'">'.$dat_languages['Name'].'</option>');
}}
$sql_english = 'SELECT `Text` FROM `'.$db_pref.'lang_text` WHERE `Language` = \'1\' AND `Text_Title` = \''.$dat_request['Text'].'\'';
$raw_english = mysql_query($sql_english);
$dat_english = mysql_fetch_array($raw_english);
$array_from = array('<','>');
$array_to = array('&lt;','&gt;');
$english = str_replace($array_from,$array_to,$dat_english['Text']);

echo('</select><br /><br />
text in english:
<table border="1">
<tr>
<td>'.$english.'</td>
</tr>
</table><br />
Translation:<br />
<textarea name="Text" rows="5" cols="50"></textarea><br />
Translator: <input type="text" name="Translator" /><br /><br />


<input type="submit" value="Add translation." />
</form>');


?>