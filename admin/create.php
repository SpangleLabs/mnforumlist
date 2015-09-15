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

if(isset($_GET['table'])) {} else { die('invalid table.'); }
echo('<h2>Creating row on '.$_GET['table'].' table.</h2>
<form action="create2.php" method="post">');

$data = mysql_query('SELECT * FROM '.$_GET['table'].'');
$columns = mysql_num_fields($data);
$rows = mysql_num_rows($data)+1;
$ID_column = mysql_field_name($data,'0');
$id = mysql_fetch_array(mysql_query('SELECT * FROM '.$_GET['table'].' ORDER BY '.$ID_column.' DESC'));


echo('<table border=1>');

echo('<tr><td>'.mysql_field_name($data,'0').'</td><td><input name="'.mysql_field_name($data,'0').'" type="text" value="'.($id[$ID_column]+1).'"></td></tr>');

for($i=1;$i<$columns;$i++) {
echo('<tr><td>'.mysql_field_name($data,$i).'</td><td><input name="'.mysql_field_name($data,$i).'" type="text" value=""></td></tr>');
}

echo('
</table>
<input name="table" type="hidden" value="'.$_GET['table'].'">
<input type="submit" value="CREATE!">

</form>');

?>