<?
include('header.php');
include('connect.php');

if(isset($_GET[ID])) { } else {
die('No Nation selected');
}

$name = mysql_fetch_array(mysql_query("SELECT Name, NatID FROM ".$db_pre."data WHERE NatID = '".$_GET[ID]."'"));

$forums = mysql_query("SELECT Forum, Forum_status, Type FROM ".$db_pre."forums WHERE NatID = '".$_GET[ID]."'");

$rows = mysql_num_rows($forums);


echo('<h1>Forums of <a href="nation.php?ID='.$name[NatID].'">'.$name[Name].'</a>.</h1>

<table border="1">
<tr>
<td>Address</td><td>Status</td><td>Type</td>
</tr>');


for($i=1;$i<=$rows;$i++) {
$forum = mysql_fetch_array($forums);
echo('<tr>');
echo('<td><a href="'.function_spamstop($forum[Forum]).'">'.function_spamstop($forum[Forum]).'</a></td>');
echo('<td>'.$forum[Forum_status].'</td>');
echo('<td><a href="forumtype.php?type='.$forum[Type].'">'.$forum[Type].'</a></td>');
echo('</tr>');
}

echo('</table>');

include('footer.php');
?>