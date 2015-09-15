<?
include('header.php');
include('connect.php');


if(isset($_GET[type])) {

$map_address = mysql_fetch_array(mysql_query("SELECT Full_address FROM ".$db_pre."maps WHERE Map_company = '".$_GET[type]."'"));


echo('<a href="maptype.php">Back to maps list</a>
<h1>Statistics for <a href="'.$map_address[Full_address].'">'.$_GET[type].'</a> Map.</h1>
<table border="1">
<tr>
<td>Nation</td>
<td>Map</td>
</tr>');

$name = mysql_query("SELECT NatID, Name FROM ".$db_pre."data ORDER BY Name");
$names = mysql_num_rows($name);

for($i=1;$i<=$names;$i++) {
$namey = mysql_fetch_array($name);
$map = mysql_query("SELECT NatID, Map_address, Map_company FROM ".$db_pre."maps WHERE NatID = '".$namey[NatID]."' AND Map_company = '".$_GET[type]."'");
$maps = mysql_num_rows($map);
$map_info = mysql_fetch_array($map);

if($map_info[Map_company]==$_GET[type]) {
echo('<tr>
<td><a href="nation.php?ID='.$map_info[NatID].'">'.$namey[Name].'</a></td>
<td><a href="'.$map_info[Map_address].'">'.$map_info[Map_address].'</a></td>
</tr>');
}

}

echo('</table>');

} else {

echo('<a href="index.php">Back to list</a>');
echo('<h1>Map company statistics</h1>');

echo('<table border="1">
<tr>
<td>Name</td>
<td>members</td>
</tr>');


$map_type = mysql_query("SELECT DISTINCT Map_company FROM ".$db_pre."maps ORDER BY Map_company");

$num_map_types = mysql_num_rows($map_type);


for($i=1;$i<=$num_map_types;$i++) {
$map_types = mysql_fetch_array($map_type);

$amount_members = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."maps WHERE Map_company = '".$map_types[Map_company]."'"));


echo('<tr>
<td><a href="maptype.php?type='.$map_types[Map_company].'">'.$map_types[Map_company].'</a></td>
<td>'.$amount_members.'</td>
</tr>');
}

echo('</table>');

}




include('footer.php');
?>