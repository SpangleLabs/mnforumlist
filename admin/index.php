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

$raw_requests = mysql_query('SELECT `ID` FROM `'.$db_pref.'modifications` WHERE `Fixed` = \'N\'');
$num_requests = mysql_num_rows($raw_requests);

if($num_requests!=0) {
echo('<h2>Modifications</h1>
There are '.$num_requests.' requests for modifications. <a href="view_modifications.php">Click here</a> to view them.');
}

echo('<h2>Database info:</h2>

<table border=1>
<tr><td>Name</td><td>Rows</td><td>Columns</td></tr>');

$raw_tables = mysql_query('SHOW TABLE STATUS');
$num_tables = mysql_num_rows($raw_tables);

for($a=0;$a<$num_tables;$a++) {
$dat_tables = mysql_fetch_array($raw_tables);
if(substr($dat_tables['Name'],0,8)=='Nations_') {
echo('<tr>
<td><a href="view.php?table='.$dat_tables['Name'].'">'.$dat_tables['Name'].'</a></td>
<td>'.mysql_num_rows(mysql_query("SELECT * FROM ".$dat_tables['Name'])).'</td>
<td>'.mysql_num_fields(mysql_query("SELECT * FROM ".$dat_tables['Name'])).'</td>
</tr>');
} elseif($_GET['Show']==1) {
echo('<tr>
<td><a href="view.php?table='.$dat_tables['Name'].'">'.$dat_tables['Name'].'</a></td>
<td>'.mysql_num_rows(mysql_query("SELECT * FROM ".$dat_tables['Name'])).'</td>
<td>'.mysql_num_fields(mysql_query("SELECT * FROM ".$dat_tables['Name'])).'</td>
</tr>');
}
}

echo('</table>
<a href="index.php?Show=1">Show all tables</a>');

echo('<h2>"Balanced" Actions</h2>
<a href="actions/index.php">Click here</a> ("Balanced" actions are actions that declare their effect over all needed tables.)');

echo('<h2>Validate database</h2>
<a href="validation/index_check.php">Click here</a>');


if(gmdate('d')==1) {
echo('<h2>Record post counts:</h2>
<a href="post_count/post_count.php">Click here</a>');
}
?>


</body>
</html>