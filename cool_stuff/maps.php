<?
include('header.php');
include('connect.php');

if(isset($_GET[ID])) { } else {
die('No Nation selected');
}

$name = mysql_fetch_array(mysql_query("SELECT Name, NatID FROM ".$db_pre."data WHERE NatID = '".$_GET[ID]."'"));

$maps = mysql_query("SELECT Map_company, Full_address, Map_address FROM ".$db_pre."maps WHERE NatID = '".$_GET[ID]."'");

$rows = mysql_num_rows($maps);


echo('<h1>Maps of <a href="nation.php?ID='.$name[NatID].'">'.$name[Name].'</a>.</h1>');


for($i=1;$i<=$rows;$i++) {

$map = mysql_fetch_array($maps);
echo('<h2><a href="maptype.php?type='.$map[Map_company].'">'.$map[Map_company].'</a></h2>');
echo('Map company address: <a href="">'.$map[Full_address].'</a><br />');
echo('Map: <br />
<img src="'.$map[Map_address].'" alt="Map'.$i.'" />');

}
if($rows=="0") {
echo('This nation is not on any maps.');
}



include('footer.php');
?>