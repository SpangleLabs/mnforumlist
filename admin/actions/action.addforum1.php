<form action="action.addforum2.php" method="post">
<table>
<tr>
<td>Nation:</td>
<td><select name="NatID">
<?
include('../../connect.php');
$raw_nations = mysql_query('SELECT NatID, Name FROM '.$db_pre.'data ORDER BY Name');
$num_nations = mysql_num_rows($raw_nations);

for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);
if($_GET['NatID']==$dat_nations['NatID']) { $add = ' selected="selected"'; } else { $add = ''; }
echo('<option value="'.$dat_nations['NatID'].'"'.$add.'>'.$dat_nations['Name'].'</option>');
}
?>
</select></td>
</tr><tr>
<td>URL:</td>
<td><input type="text" name="URL" /></td>
</tr><tr>
<td>Status</td>
<td><input type="text" name="status" /></td>
</tr><tr>
<td>Type</td>
<td><select name="Type">
<?
$raw_forums = mysql_query('SELECT DISTINCT Type FROM '.$db_pre.'forums ORDER BY Type');
$num_forums = mysql_num_rows($raw_forums);

for($b=0;$b<$num_forums;$b++) {
$dat_forums = mysql_fetch_array($raw_forums);
echo('<option value="'.$dat_forums['Type'].'">'.$dat_forums['Type'].'</option>');

}


?></select></td>
</tr>
</table>
<input type="submit" value="Add forum" />
</form>