<?
include('header.php');
include('connect.php');

if(isset($_GET['ID'])) { } else {
die('No Nation selected');
}

$name = mysql_fetch_array(mysql_query("SELECT Name, NatID FROM ".$db_pre."data WHERE NatID = '".$_GET['ID']."'"));

$raw_websites = mysql_query("SELECT Address, Status, Type, Flash_required, Language FROM ".$db_pre."websites WHERE NatID = '".$_GET[ID]."'");
$num_websites = mysql_num_rows($raw_websites);

echo('
<h1>Websites of <a href="nation.php?ID='.$name['NatID'].'">'.$name['Name'].'</a>.</h1>

<table border="1">
<tr>
<td>Address</td><td>Status</td><td>Type</td><td>Flash required</td><td>Language</td>
</tr>');


for($a=1;$a<=$num_websites;$a++) {
$dat_websites = mysql_fetch_array($raw_websites);
echo('<tr>
<td><a href="'.function_spamstop($dat_websites['Address']).'">'.function_spamstop($dat_websites['Address']).'</a></td>
<td>'.$dat_websites['Status'].'</td>
<td><a href="websitetype.php?type='.$dat_websites['Type'].'">'.$dat_websites['Type'].'</a></td>
<td>'.$dat_websites['Flash_required'].'</td>
<td>'.$dat_websites['Language'].'</td>
</tr>');
}

echo('</table>');

include('footer.php');
?>