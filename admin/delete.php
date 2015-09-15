<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Forumlist Admin panel</title>
	<meta http-equiv="content-type"
 		content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" type="text/css" href="admin.css" />
</head>
<body>
<h1>Admin Panel</h1>
<?
include('../connect.php');

echo('Are you sure you want to delete row '.$_GET[ID].' of the table '.$_GET[table].' here is what it contains:');



if($_GET['table']=="Nations_data") { $idthing="NatID"; } else { $idthing="ID"; }
$data = mysql_query('SELECT * FROM '.$_GET['table'].' WHERE '.$idthing.' = '.$_GET['ID'].'');
$columns = mysql_num_fields($data);
$data2 = mysql_fetch_array($data);

echo('<table border=1>');
echo('<tr>');

for($i=0;$i<$columns;$i++) {
echo('<td>'.mysql_field_name($data,$i).'</td>');
}
echo('</tr><tr>');
for($j=0;$j<$columns;$j++) {
echo('<td>'.$data2[$j].'</td>');
}
echo('</tr></table><br />');

echo('<br /><a href="delete2.php?table='.$_GET['table'].'&ID='.$_GET['ID'].'">Yes I am sure I want to delete this row.</a>');
echo('<br /><a href="index.php">No, I accidently clicked delete, sorry.</a>');


?>
</body>
</html>