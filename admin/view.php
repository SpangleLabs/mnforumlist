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

if(isset($_GET['table'])) {
if($_GET['table']=="data") { $order_by = "NatID"; } else { $order_by = "ID"; }
} else { die('invalid table.'); }
echo('<h2>Editing '.$_GET['table'].' table.</h2>');

$raw_columns = mysql_query('SELECT * FROM '.$_GET['table'].'');
$num_columns = mysql_num_fields($raw_columns);

for($a=0;$a<$num_columns;$a++) {
$dat_columns = mysql_fetch_field($raw_columns);

if($dat_columns->primary_key==1) {
$column_primary_key = $dat_columns->name;
}
}

$data = mysql_query('SELECT * FROM '.$_GET['table'].' ORDER BY '.$column_primary_key.'');
$columns = mysql_num_fields($data);
$rows = mysql_num_rows($data);

echo('<a href="create.php?table='.$_GET['table'].'">Click here to create a new row</a>');

echo('<table border=1>
<tr>');

for($h=0;$h<$columns;$h++) {
if(mysql_field_name($data,$h)==$column_primary_key) { $add_name = '<br />(KEY)'; }
echo('<td>'.mysql_field_name($data,$h).$add_name.'</td>');
unset($add_name);
}
echo('<td>&nbsp;</td>');
echo('<td>&nbsp;</td>');

echo('</tr>');
for($i=0;$i<$rows;$i++) {
$table = mysql_fetch_array($data);
echo('<tr>');

for($j=0;$j<$columns;$j++) {
echo('<td>'.$table[$j].'</td>
');
}

echo('<td><a href="edit.php?table='.$_GET['table'].'&ID='.$table[mysql_field_name($data,0)].'">EDIT</a></td>
<td><a href="delete.php?table='.$_GET['table'].'&ID='.$table[mysql_field_name($data,0)].'">DELETE</a></td>
');

echo('</tr>');
}


echo('</table>');

?>