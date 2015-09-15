<?
include('header.php');
include('connect.php');

$nation_name = mysql_fetch_array(mysql_query('SELECT Name FROM '.$db_pre.'data WHERE NatID = \''.$_GET['ID'].'\''));

echo('
<h1>Cultural items of '.$nation_name['Name'].'</h1>');

$culture_data = mysql_query('SELECT * FROM '.$db_pre.'culture WHERE NatID = \''.$_GET['ID'].'\' ORDER BY File_name');
$cultural_items = mysql_num_rows($culture_data);

echo($nation_name['Name'].' has uploaded '.$cultural_items.' cultural items.');

$folder_num = $_GET['ID'];
if($folder_num<10) { $folder_num='0'.$folder_num; }
if($folder_num<100) { $folder_num='0'.$folder_num; }
if($folder_num<1000) { $folder_num='0'.$folder_num; }

echo('<table border="1"><tr>
<td>Link</td>
<td>Comment</td>
<td>Date uploaded</td>
<td>File size (KiB)</td>
</tr>');
for($a=1;$a<=$cultural_items;$a++) {
$culture = mysql_fetch_array($culture_data);
echo('<tr>
<td><a href="culture/'.$folder_num.'/'.$culture['File_name'].'">'.$culture['File_name'].'</a></td>
<td>'.$culture['Comment'].'</td>
<td>'.date(d,$culture['Date_uploaded']).'/'.date(m,$culture['Date_uploaded']).'/'.date(Y,$culture['Date_uploaded']).'</td>
<td>'.round($culture['File_size']/1024,2).'</td>
</tr>');
}
echo('</table>');


include('footer.php');
?>