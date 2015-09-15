<?

include('../connect.php');

$raw_nations = mysql_query('SELECT `NatID`,`Name`,`Flag_main` FROM `'.$db_pref.'data` WHERE `Flag_main` != \'0\' ORDER BY `NatID`');
$num_nations = mysql_num_rows($raw_nations);

echo($num_nations.' flags<table border="1"><tr><td>Nation</td><td>Flag</td></tr>');
for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);
$raw_flag = mysql_query('SELECT `File_name` FROM `'.$db_pref.'flags` WHERE `ID` = \''.$dat_nations['Flag_main'].'\'');
$dat_flag = mysql_fetch_array($raw_flag);
echo('<tr><td>'.$dat_nations['Name'].' ('.$dat_nations['NatID'].')</td><td><img src="../'.$dat_flag['File_name'].'" /></td></tr>');

}
echo('</table>');

?>