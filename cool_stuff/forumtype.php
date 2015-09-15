<?
include('header.php');
include('connect.php');


if(isset($_GET[type])) {


echo('<a href="forumtype.php">Back to forums list</a>
<h1>Statistics for '.$_GET[type].' Fora.</h1>
<table border="1">
<tr>
<td>Nation</td>
<td>Address</td>
<td>Status</td>
</tr>');

$forum = mysql_query("SELECT NatID, Forum, Forum_status FROM ".$db_pre."forums WHERE Type = '".$_GET[type]."'");
$fora = mysql_num_rows($forum);

for($i=1;$i<=$fora;$i++) {
$forum_info = mysql_fetch_array($forum);
$name = mysql_fetch_array(mysql_query("SELECT Name FROM ".$db_pre."data WHERE NatID = '".$forum_info[NatID]."'"));
echo('<tr>
<td><a href="nation.php?ID='.$forum_info[NatID].'">'.$name[Name].'</a></td>
<td><a href="'.function_spamstop($forum_info[Forum]).'">'.function_spamstop($forum_info[Forum]).'</a></td>
<td>'.$forum_info[Forum_status].'</td>
</tr>');

}

echo('</table>');

} else {

echo('<a href="index.php">Back to list</a>');
echo('<h1>Forum type statistics</h1>');

echo('<table border="1">
<tr>
<td>Type</td>
<td>Amount</td>
<td>In use</td>
</tr>');


$forum_type = mysql_query("SELECT DISTINCT Type FROM ".$db_pre."forums ORDER BY Type");

$num_forum_types = mysql_num_rows($forum_type);


for($i=1;$i<=$num_forum_types;$i++) {
$forum_types = mysql_fetch_array($forum_type);

$amount_forums = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."forums WHERE Type = '".$forum_types[Type]."'"));

$in_use_forums = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."forums WHERE Forum_status = 'In use' AND Type = '".$forum_types[Type]."'"));


echo('<tr>
<td><a href="forumtype.php?type='.$forum_types[Type].'">'.$forum_types[Type].'</a></td>
<td>'.$amount_forums.'</td>
<td>'.$in_use_forums.'</td>
</tr>');
}

echo('</table>');

}




include('footer.php');
?>