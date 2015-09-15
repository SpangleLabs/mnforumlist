<?
include('../../connect.php');

$raw_texts = mysql_query('SELECT DISTINCT `Text_Title` FROM `'.$db_pref.'lang_text` ORDER BY `Text_Title`');
$num_texts = mysql_num_rows($raw_texts);

$raw_langs = mysql_query('SELECT `ID`,`Name` FROM `'.$db_pref.'langs` ORDER BY `Name`');
$num_langs = mysql_num_rows($raw_langs);
for($a=0;$a<$num_langs;$a++) {
$dat_langs = mysql_fetch_array($raw_langs);
$array_langs[$a] = $dat_langs['Name'];
$array_langID[$a] = $dat_langs['ID'];
}


for($a=0;$a<$num_texts;$a++) {
$dat_texts = mysql_fetch_array($raw_texts);
for($b=0;$b<$num_langs;$b++) {
$raw_langtext = mysql_query('SELECT `ID` FROM `'.$db_pref.'lang_text` WHERE `Language` = \''.$array_langID[$b].'\' AND `Text_Title` = \''.$dat_texts['Text_Title'].'\'');
$num_langtext = mysql_num_rows($raw_langtext);
if($num_langtext==0) {

$raw_requested = mysql_query('SELECT `ID` FROM `'.$db_pref.'lang_request_text` WHERE `Language` = \''.$array_langID[$b].'\' AND `Text` = \''.$dat_texts['Text_Title'].'\'');
$num_requested = mysql_num_rows($raw_requested);
if($num_requested==0) {
echo('<br />No entry for {'.$dat_texts['Text_Title'].'} in '.$array_langs[$b].', requested...<br />');
$sql_addtextrequest = 'INSERT INTO `'.$db_pref.'lang_request_text` (`Language`,`Text`,`Date`) VALUES (\''.$array_langID[$b].'\',\''.$dat_texts['Text_Title'].'\',\''.gmmktime().'\')';
$raw_addtextrequest = mysql_query($sql_addtextrequest);
} else {
echo('<br />No entry for {'.$dat_texts['Text_Title'].'} in '.$array_langs[$b].', already requested...<br />');
}



} elseif($num_langtext==1) {
echo('ok ');
} else {
echo('<br />too many entries for {'.$dat_texts['Text_Title'].'} in '.$array_langs[$b].'...<br />');
}


}
}


?>