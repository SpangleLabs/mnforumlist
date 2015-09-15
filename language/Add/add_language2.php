<?
die('SPANGLE HAS TO ENABLE THIS FIRST');
header('Content-Type:text/html; charset=UTF-8');
include('../../connect.php');

$password = 'Freddo';
if($_POST['Password']!=$password) { die('invalid password.'); }

$a = 0;
while(isset($_POST['Text_Title'.$a])) {

$sql_inserttext[$a] = 'INSERT INTO `'.$db_pref.'lang_text` (`Text_Title`,`Language`,`Text`,`Translator`) VALUES (\''.$_POST['Text_Title'.$a].'\',\'{LANGID}\',\''.$_POST['Text'.$a].'\',\''.$_POST['Translator'].'\')';

$a++;
}

$sql_insert = 'INSERT INTO `'.$db_pref.'langs` (`Name`,`Entries`) VALUES (\''.$_POST['Name'].'\',\''.$a.'\')';
$raw_insert = mysql_query($sql_insert);
$sql_langid = 'SELECT `ID` FROM `'.$db_pref.'langs` WHERE `Name` = \''.$_POST['Name'].'\'';
$raw_langid = mysql_query($sql_langid);
$dat_langid = mysql_fetch_array($raw_langid);


for($b=0;$b<$a;$b++) {

$sql_inserttext[$b] = str_replace('{LANGID}',$dat_langid['ID'],$sql_inserttext[$b]);
$raw_inserttext = mysql_query($sql_inserttext[$b]);
echo($sql_inserttext[$b].'<br /><br />');
}

echo('Added language. <a href="add_language.php">Click here</a> to add another.');

?>