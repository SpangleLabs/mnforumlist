<?
include('../../connect.php');
$raw_flags = mysql_query('SELECT `ID`,`File_name`,`Type`,`Area`,`Description` FROM `'.$db_pref.'flags` WHERE `NatID` = \''.$_GET['NatID'].'\' AND `Type` != \'Thumbnail\' ORDER BY `Type`,`Area`');
$num_flags = mysql_num_rows($raw_flags);

echo('Which flag do you want to be the new main flag?
<form action="action.changemainflag3.php" method="post">
<input type="hidden" name="NatID" value="'.$_GET['NatID'].'" />
<table border="1">
<tr>
<td>New Main flag</td>
<td>Flag</td>
<td>Type</td>
<td>Area</td>
<td>Description</td>
</tr>');
for($a=0;$a<$num_flags;$a++) {
$dat_flags = mysql_fetch_array($raw_flags);
echo('<tr>
<td><input type="radio" name="FlagID" value="'.$dat_flags['ID'].'" /></td>
<td><img src="../../'.$dat_flags['File_name'].'" /></td>
<td>'.$dat_flags['Type'].'</td>
<td>'.$dat_flags['Area'].'</td>
<td>'.$dat_flags['Description'].'</td>
</tr>');


}
echo('</table><input type="submit" value="Set main flag" /></form>');


?>