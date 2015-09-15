<?
include('../../connect.php');
include('function.count.php');


if(!isset($_GET['Y']) || !isset($_GET['M']) || !isset($_GET['D'])) {
die('Date not specified. Should be in the format of "?Y=yyyy&M=mm&D=dd');
}

if(!is_dir('../../saved_forums/nations/'.$_GET['Y'].'-'.$_GET['M'].'-'.$_GET['D'])) {
die('No forums saved that day.');
}

echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<input type="hidden" name="Year" value="'.$_GET['Y'].'" />
<input type="hidden" name="Month" value="'.$_GET['M'].'" />
<input type="hidden" name="Day" value="'.$_GET['D'].'" />

<table border=1>
<tr>
<td>Number</td>
<td>Post count</td>
<td>Forum ID</td>
<td>Nation ID</td>
<td>Forum link</td>
<td>Type</td>
</tr>');




$handle = opendir('../../saved_forums/nations/'.$_GET['Y'].'-'.$_GET['M'].'-'.$_GET['D']);
for($a=0;$file = readdir($handle);$a++) {
if ($file != "." && $file != "..") {
$forums_array[$a] = $file;
}} closedir($handle);
sort($forums_array);


$num_forums_array = count($forums_array);
echo('<b>'.$num_forums_array.'</b> Forums to check.');

for($a=0;$a<$num_forums_array;$a++) {
$raw_forum = mysql_query('SELECT NatID, Type FROM '.$db_pre.'forums WHERE ID = \''.($forums_array[$a]/2*2).'\'');
$dat_forum = mysql_fetch_array($raw_forum);

$forum_address[$a] = 'http://mnforumlist.com/saved_forums/nations/'.$_GET['Y'].'-'.$_GET['M'].'-'.$_GET['D'].'/'.$forums_array[$a];

$forum_ID[$a] = substr(0,4,$forums_array[$a])*2/2;

$post_count[$forums_array[$a]] = function_postcount($forum_address[$a],$dat_forum['Type']);

echo('<tr>
<td>'.$a.'</td>
<td><input type="text" name="Post_count_'.$forums_array[$a].'" value="'.$post_count[$forums_array[$a]].'" /></td>
<td>'.$forums_array[$a].'</td>
<td>'.$dat_forum['NatID'].'</td>
<td><a href="'.$forum_address[$a].'">'.$forum_address[$a].'</a></td>
<td>'.$dat_forum[Type].'</td>
</tr>
');

}




?>
</table>
<input type="submit" value="record post counts" />

</form>
</body>
</html>