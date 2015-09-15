<?
include('header.php');
include('connect.php');


if(isset($_GET['type'])) {

echo('
<a href="websitetype.php">Back to websites list</a>
<h1>Statistics for '.$_GET['type'].' Websites.</h1>
<table border="1">
<tr>
<td>Nation</td>
<td>Address</td>
<td>Status</td>
<td>Flash_required</td>
<td>Language</td>
</tr>');

$raw_websites = mysql_query("SELECT NatID, Address, Status, Flash_required, Language FROM ".$db_pre."websites WHERE Type = '".$_GET['type']."'");
$num_websites = mysql_num_rows($raw_websites);

for($a=1;$a<=$num_websites;$a++) {
$dat_websites = mysql_fetch_array($raw_websites);
$name = mysql_fetch_array(mysql_query("SELECT Name FROM ".$db_pre."data WHERE NatID = '".$dat_websites['NatID']."'"));
echo('<tr>
<td><a href="nation.php?ID='.$dat_websites['NatID'].'">'.$name['Name'].'</a></td>
<td><a href="'.spamstop($dat_websites['Address']).'">'.function_spamstop($dat_websites['Address']).'</a></td>
<td>'.$dat_websites['Status'].'</td>
<td>'.$dat_websites['Flash_required'].'</td>
<td>'.$dat_websites['Language'].'</td>
</tr>');

}

echo('</table>');

} else {

echo('<a href="index.php">Back to list</a>
<h1>Website type statistics</h1>

<table border="1">
<tr>
<td>Type</td>
<td>Amount</td>
<td>In use</td>
</tr>');


$raw_website_types = mysql_query("SELECT DISTINCT Type FROM ".$db_pre."websites ORDER BY Type");
$num_website_types = mysql_num_rows($raw_website_types);


for($a=1;$a<=$num_website_types;$a++) {
$dat_website_types = mysql_fetch_array($raw_website_types);

$amount_websites = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."websites WHERE Type = '".$dat_website_types['Type']."'"));

$in_use_websites = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."websites WHERE Status = 'In use' AND Type = '".$dat_website_types['Type']."'"));


echo('<tr>
<td><a href="websitetype.php?type='.$dat_website_types['Type'].'">'.$dat_website_types['Type'].'</a></td>
<td>'.$amount_websites.'</td>
<td>'.$in_use_websites.'</td>
</tr>');
}

echo('</table>');

}




include('footer.php');
?>