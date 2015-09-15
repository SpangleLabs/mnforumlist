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
<h1>Record post counts</h1>

<form action="post_count2.php" method="post">
<table border=1>
<tr>
<td>Number</td>
<td>Post count</td>
<td>Forum ID</td>
<td>Nation ID</td>
<td>Forum link</td>
<td>Type</td>
</tr>

<?
include('../../connect.php');
include('function.count.php');

$live_forums = mysql_query("SELECT ID, NatID, Forum, Type FROM ".$db_pre."forums WHERE Forum_status = 'In use' ORDER BY ID");
$forums = mysql_num_rows($live_forums);

echo('<b>'.$forums.'</b> Forums to check.');

for($i=0;$i<$forums;$i++) {
$live_fora = mysql_fetch_array($live_forums);

echo('<tr>
<td>'.$i.'</td>
<td><input type="text" name="Post_count_'.$live_fora[ID].'" value="'.function_postcount($live_fora[Forum],$live_fora[Type]).'" /></td>
<td>'.$live_fora[ID].'</td>
<td>'.$live_fora[NatID].'</td>
<td><a href="'.$live_fora[Forum].'">'.$live_fora[Forum].'</a></td>
<td>'.$live_fora[Type].'</td>
</tr>
');}


?>
</table>
<input type="submit" value="record post counts" />

</form>
</body>
</html>