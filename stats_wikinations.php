<?
include('connect.php');

if(!isset($_GET['ID'])) {
$raw_wikis = mysql_query('SELECT `ID`,`Name` FROM `'.$db_pref.'wikis` ORDER BY `Name`');
$num_wikis = mysql_num_rows($raw_wikis);
for($a=0;$a<$num_wikis;$a++) {
$dat_wikis = mysql_fetch_array($raw_wikis);
echo(($a+1).'): <a href="stats_wikinations.php?ID='.$dat_wikis['ID'].'">'.$dat_wikis['Name'].'</a><br />');
}

} else {
$raw_nations = mysql_query('SELECT `NatID`,`Name` FROM `'.$db_pref.'data` ORDER BY `Name`');
$num_nations = mysql_num_rows($raw_nations);
$b=1;
for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);

$raw_wikiarticle = mysql_query('SELECT `ID` FROM `'.$db_pref.'wikiarticles` WHERE `NatID` = \''.$dat_nations['NatID'].'\' AND `WikiID` = \''.$_GET['ID'].'\'');
$num_wikiarticle = mysql_num_rows($raw_wikiarticle);
if($num_wikiarticle==0) {
$link = 'http://micras.org/wiki/index.php?title='.$dat_nations['Name'];
echo($b.'): <a href="'.$link.'">'.$dat_nations['Name'].'</a>   ('.$dat_nations['NatID'].')<br />');
$b++;
}

}




}



?>