<?
include('header.php');
include('connect.php');

$raw_nations = mysql_query('SELECT `Name` FROM `'.$db_pre.'data` WHERE `Status` = \'Alive\' ORDER BY `Name`');
$num_nations = mysql_num_rows($raw_nations);

echo('There are '.$num_nations.' nations to list.<br /><br />');

for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);
echo($dat_nations['Name'].'<br />');

}


include('footer.php');
?>