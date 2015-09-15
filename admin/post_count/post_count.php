<?
include('../../connect.php');
include('function.count.php');

$sql_live_forums = 'SELECT 
 forums.ID as Forum_ID, 
 forums.NatID as Nation_ID, 
 forums.Forum as Forum_Link, 
 forums.Forum_Count as Forum_Link_Count, 
 forums.Type as Forum_Type, 
 forums.Type_Count as Forum_Type_Count, 
 forums.Forum_status as Forum_Status, 
 data.Name as Nation_Name 
 FROM `'.$db_pref.'forums` forums
 LEFT JOIN `'.$db_pref.'data` data ON data.NatID = forums.NatID
 WHERE Forum_Status = \'In use\'
 ORDER BY Forum_ID ASC';
$raw_live_forums = mysql_query($sql_live_forums);
$num_live_forums = mysql_num_rows($raw_live_forums);

echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Forumlist Admin panel post logging.</title>
	<meta http-equiv="content-type"
 		content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" type="text/css" href="admin.css" />
</head>
<body>
<h1>Record post counts</h1>

<form action="post_count2.php" method="post">
Year: <input type="text" name="Year" value="'.gmdate('Y').'" /><br />
Month: <input type="text" name="Month" value="'.gmdate('m').'" /><br />
Day: <input type="text" name="Day" value="'.gmdate('d').'" /><br /><br />


<table border=1>
<tr>
<td>Number</td>
<td>Post count</td>
<td>Forum</td>
<td>Nation</td>
<td>Forum Type</td>
</tr><tbody>');

$worked = 0;
for($a=0;$a<$num_live_forums;$a++) {
$dat_live_forums = mysql_fetch_array($raw_live_forums);
$sql_nation_name = 'SELECT `Name` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$raw_live_fora['NatID'].'\'';
$raw_nation_name = mysql_query($sql_nation_name);
$dat_nation_name = mysql_fetch_array($raw_nation_name);

unset($posts);
$posts = function_postcount($dat_live_forums['Forum_Link_Count'],$dat_live_forums['Forum_Type_Count']);
if(is_numeric($posts)) {
$worked++;
}
echo('<tr>
<td>'.$a.'</td>
<td><input type="text" name="Post_count_'.$a.'" value="'.$posts.'" /></td>
<td><a href="'.$dat_live_forums['Forum_Link'].'">'.$dat_live_forums['Forum_Link'].'</a> ('.$dat_live_forums['Forum_ID'].')
<input type="hidden" name="Forum_Link_'.$a.'" value="'.$dat_live_forums['Forum_Link'].'" />
<input type="hidden" name="Forum_ID_'.$a.'" value="'.$dat_live_forums['Forum_ID'].'" /></td>
<td>'.$dat_live_forums['Nation_Name'].' ('.$dat_live_forums['Nation_ID'].')
<input type="hidden" name="Nation_Name_'.$a.'" value="'.$dat_live_forums['Nation_Name'].'" />
<input type="hidden" name="Nation_ID_'.$a.'" value="'.$dat_live_forums['Nation_ID'].'" /></td>
<td>'.$dat_live_forums['Forum_Type'].'</td>
</tr>
');
}


echo('
</tbody>
<thead>
<b>'.$num_live_forums.'</b> to check, <b>'.$worked.'</b> automatically checked, <b>'.($num_live_forums-$worked).'</b> to do manually. (auto checker had <b>'.round(($worked/$num_live_forums)*100,3).'%</b> success rate.)
</thead></table>');
?>
<input type="submit" value="Record post counts!" />

</form>
</body>
</html>