<?
include('../../connect.php');
echo('For which nation do you wish to change the main flag?
<form action="action.changemainflag2.php" method="get" />
<select name="NatID">');

$raw_nations = mysql_query('SELECT `NatID`,`Name` FROM `'.$db_pref.'data` WHERE `Flag_main` != \'0\' ORDER BY `Name`');
$num_nations = mysql_num_rows($raw_nations);

for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);

echo('<option value="'.$dat_nations['NatID'].'">'.$dat_nations['Name'].'</option>');


}

echo('</select>
<input type="submit" value="Choose flag" />
</form>');
?>