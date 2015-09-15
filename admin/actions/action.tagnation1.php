<?
include('../../connect.php');

echo('<form action="action.tagnation2.php" method="post">
Nation: <select name="Nation">');
$sql_nations = 'SELECT `NatID`,`Name` FROM `'.$db_pref.'data` ORDER BY `Name`';
$raw_nations = mysql_query($sql_nations);
$num_nations = mysql_num_rows($raw_nations);
for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);
echo('<option value="'.$dat_nations['NatID'].'">'.$dat_nations['Name'].'</option>');
}
echo('</select><br />
Category: <select name="Category">');
$sql_categories = 'SELECT `ID`,`Name` FROM `'.$db_pref.'tags_data` ORDER BY `Name`';
$raw_categories = mysql_query($sql_categories);
$num_categories = mysql_num_rows($raw_categories);
for($a=0;$a<$num_categories;$a++) {
$dat_categories = mysql_fetch_array($raw_categories);
echo('<option value="'.$dat_categories['ID'].'">'.$dat_categories['Name'].'</option>');
}
echo('</select><br />
Current:<br />
<input type="radio" name="Current" value="Y" />Yes<br />
<input type="radio" name="Current" value="n" />No<br /><br />

<input type="submit" value="Add nation to this category" />
</form>');



?>