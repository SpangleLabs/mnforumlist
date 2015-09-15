<?
include('../../connect.php');

echo('<form action="action.addwikiarticle2.php" method="post">
Nation: <select name="NatID">');
$sql_nations = 'SELECT `NatID`,`Name` FROM `'.$db_pref.'data` ORDER BY `Name`';
$raw_nations = mysql_query($sql_nations);
$num_nations = mysql_num_rows($raw_nations);
for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);
echo('<option value="'.$dat_nations['NatID'].'">'.$dat_nations['Name'].'</option>');
}
echo('</select><br />
Wiki: <select name="WikiID">');
$sql_wikis = 'SELECT `ID`,`Name` FROM `'.$db_pref.'wikis` ORDER BY `Name`';
$raw_wikis = mysql_query($sql_wikis);
$num_wikis = mysql_num_rows($raw_wikis);
for($a=0;$a<$num_wikis;$a++) {
$dat_wikis = mysql_fetch_array($raw_wikis);
echo('<option value="'.$dat_wikis['ID'].'">'.$dat_wikis['Name'].'</option>');
}
echo('</select><br />
Link: <input type="text" name="Link" size="50" /><br />
Type:<br />
<input type="radio" name="Type" value="Main" />Main<br />
<input type="radio" name="Type" value="People" />People<br />
<input type="radio" name="Type" value="History" />History<br />
<input type="radio" name="Type" value="Culture" />Culture<br />
<input type="radio" name="Type" value="Places" />Places<br />
Description:<br />
<textarea name="Description" rows="5" cols="30">Describe the wiki article. (If it&#39;s not main)</textarea>

<input type="submit" value="Add wiki article" />
</form>');





?>