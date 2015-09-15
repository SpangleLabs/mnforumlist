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
if(isset($_GET['ID'])) {} else { die('invalid ID.'); }
echo('<h2>Editing '.$_GET['table'].' row '.$_GET['ID'].'.</h2>
<form action="edit2.php" method="post">');



$raw_columns = mysql_query('SELECT * FROM '.$_GET['table'].'');
$num_columns = mysql_num_fields($raw_columns);

for($a=0;$a<$num_columns;$a++) {
$dat_columns = mysql_fetch_field($raw_columns);

if($dat_columns->primary_key==1) {
$column_primary_key = $dat_columns->name;
}
}


$columns = $num_columns;

$data = mysql_query('SELECT * FROM '.$_GET['table'].' WHERE '.$column_primary_key.' = \''.$_GET['ID'].'\'');
$data2 = mysql_fetch_array($data);

echo('<table border=1>');

echo('<tr><td>'.mysql_field_name($data,'0').'</td><td><input size="100" name="0" type="text" value="'.str_replace('&','&amp;',$data2[0]).'" disabled="true"></td></tr>');

for($i=1;$i<$columns;$i++) {
echo('<tr><td>'.mysql_field_name($data,$i).'</td><td><input size="100" name="'.mysql_field_name($data,$i).'" type="text" value="'.str_replace('&','&amp;',$data2[$i]).'"></td></tr>');
}

echo('
</table>
<input name="table" type="hidden" value="'.$_GET['table'].'">
<input name="row" type="hidden" value="'.$_GET['ID'].'">
<input type="submit" value="EDIT!">

</form>');

?>