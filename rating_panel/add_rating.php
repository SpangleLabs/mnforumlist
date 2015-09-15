Please select the nation you wish to rate:
<form action="add_rating2.php" method="get">
<select name="ID">
<?
include('../connect.php');

$raw_nations = mysql_query('SELECT `NatID`, `Name` FROM `'.$db_pre.'data` WHERE `Status` = \'Alive\' ORDER BY `Name`');
$num_nations = mysql_num_rows($raw_nations);

for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);

echo('<option value="'.$dat_nations['NatID'].'">'.$dat_nations['Name'].'</option>');

}

?>
</select>
<input type="submit" value="Next step" />
</form>