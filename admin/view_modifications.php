<?
include('../connect.php');

$raw_modifications = mysql_query('SELECT `ID`,`NatID`,`Type`,`Timestamp`,`Name`,`IP`,`Suggestion` FROM `'.$db_pref.'modifications` WHERE `Fixed` = \'N\'');
$num_modifications = mysql_num_rows($raw_modifications);

echo('There are '.$num_modifications.' requests waiting to be fixed.<br />
<a href="index.php">Click here</a> to go back to the admin panel.<table border="1">
<tr>
<td>ID</td>
<td>Nation</td>
<td>Type</td>
<td>Name</td>
<td>Time submitted</td>
<td>Suggestion.</td>
<td>&nbsp;</td>
<td>&nbsp;</td></tr>');

for($a=0;$a<$num_modifications;$a++) {
$dat_modifications = mysql_fetch_array($raw_modifications);
$raw_name = mysql_query('SELECT `Name` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$dat_modifications['NatID'].'\'');
$dat_name = mysql_fetch_array($raw_name);
$link = 'No Easyfix available';
if($dat_modifications['Type']=="Basic_data") { $link = '<a href="view_mod_easyfix_basic.php?ID='.$dat_modifications['ID'].'">Easy fix system</a>'; }
echo('<tr>
<td>'.$dat_modifications['ID'].'</td>
<td>'.$dat_name['Name'].' ('.$dat_modifications['NatID'].')</td>
<td>'.$dat_modifications['Type'].'</td>
<td>'.$dat_modifications['Name'].' ('.$dat_modifications['IP'].')</td>
<td>'.date("d\/m\/Y  H:i:s",$dat_modifications['Timestamp']).'</td>
<td>'.$dat_modifications['Suggestion'].'</td>
<td><a href="view_mod_fixed.php?ID='.$dat_modifications['ID'].'">I have fixed this</a></td>
<td>'.$link.'</td></tr>');

}

echo('</table>');
?>