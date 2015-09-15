<?
include('header.php');
include('connect.php');
if(!isset($_GET['ID'])) {
echo('No website ID specified.');
include('footer.php');
die();
}
$raw_site = mysql_query('SELECT `NatID`,`Address` FROM `'.$db_pref.'websites` WHERE `ID` = \''.$_GET['ID'].'\'');
$num_site = mysql_num_rows($raw_site);
if($num_site==0) {
echo('No site exists with this ID number.');
include('footer.php');
die();
}
$dat_site = mysql_fetch_array($raw_site);
echo('Website address: <a href="'.$dat_site['Address'].'">'.$dat_site['Address'].'</a><br />');

$raw_nation = mysql_query('SELECT `Name` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$dat_site['NatID'].'\'');
$dat_nation = mysql_fetch_array($raw_nation);
echo('Nation name: <a href="nation.php?ID='.$dat_site['NatID'].'">'.$dat_nation['Name'].'</a><br />');

$raw_logs = mysql_query('SELECT `Date`,`Folder` FROM `'.$db_pref.'websites_archives` WHERE `SiteID` = \''.$_GET['ID'].'\'');
$num_logs = mysql_num_rows($raw_logs);

if($num_logs==0) {
echo('No website archives for this website.');
include('footer.php');
die();
}

if($num_logs==1) { echo('There is 1 log'); } else { echo('There are '.$num_logs.' logs'); }
echo('<table border="1"><tr><td>Date</td><td>Link</td></tr>');
for($a=0;$a<$num_logs;$a++) {
$dat_logs = mysql_fetch_array($raw_logs);

echo('<tr>
<td>'.date("d\/m\/Y",$dat_logs['Date']).'</td>
<td><a href="'.$dat_logs['Folder'].'">'.$dat_logs['Folder'].'</a></td>
</tr>');


}
echo('</table>');


?>