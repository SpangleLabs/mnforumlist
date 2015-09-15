<?
include('../connect.php');

$raw_modifications = mysql_query('SELECT `ID`,`NatID`,`Type`,`Timestamp`,`Name`,`IP`,`Suggestion` FROM `'.$db_pref.'modifications` WHERE `ID` = \''.$_GET['ID'].'\' AND`Fixed` = \'N\'');
$num_modifications = mysql_num_rows($raw_modifications);
if($num_modifications!=1) {
die('This modification does not exist or you have fixed it already.');
}
$dat_modifications = mysql_fetch_array($raw_modifications);
$raw_name = mysql_query('SELECT `Name` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$dat_modifications['NatID'].'\'');
$dat_name = mysql_fetch_array($raw_name);

echo('<table border="1">
<tr>
<td>ID</td>
<td>Nation</td>
<td>Type</td>
<td>Name</td>
<td>Time submitted</td>
<td>Suggestion.</td>
</tr><tr>
<td>'.$dat_modifications['ID'].'</td>
<td>'.$dat_name['Name'].'</td>
<td>'.$dat_modifications['Type'].'</td>
<td>'.$dat_modifications['Name'].' ('.$dat_modifications['IP'].')</td>
<td>'.date("d\/m\/Y  H:i:s",$dat_modifications['Timestamp']).'</td>
<td>'.$dat_modifications['Suggestion'].'</td>
<td><a href="view_mod_fixed.php?ID='.$dat_modifications['ID'].'">I have fixed this</a></td></tr>
</table>
Are you sure you have fixed this modification?<br />
<a href="view_mod_fixed2.php?ID='.$_GET['ID'].'">Yes I have</a><br />
<a href="view_modifications.php">No I haven&#39;t, sorry.</a>');


?>