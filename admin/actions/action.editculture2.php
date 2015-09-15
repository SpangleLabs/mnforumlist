<?
include('../../connect.php');
$raw_cultureitems = mysql_query('SELECT `ID`,`File_name`,`Date_uploaded`,`File_type`,`File_size`,`Comment` FROM `'.$db_pref.'culture` WHERE `NatID` = \''.$_POST['NatID'].'\' ORDER BY `File_name`');
$num_cultureitems = mysql_num_rows($raw_cultureitems);

echo('Which cultural item do you want to delete?
<form action="action.editculture3.php" method="post"><table border="1">
<tr>
<td>Cultural item</td>
<td>Date uploaded</td>
<td>File type</td>
<td>File size</td>
<td>Old Comment</td>
<td>New Comment</td>
</tr>');
for($a=0;$a<$num_cultureitems;$a++) {
$dat_cultureitems = mysql_fetch_array($raw_cultureitems);
$file_addr = '../../culture/'.str_pad($_POST['NatID'],4,'0',STR_PAD_LEFT).'/'.$dat_cultureitems['File_name'];

echo('<tr>
<td><a href="'.$file_addr.'">'.$dat_cultureitems['File_name'].'</a></td>
<td>'.date('H:i:s d\/m\/Y',$dat_cultureitems['Date_uploaded']).'</td>
<td>'.$dat_cultureitems['File_type'].'</td>
<td>'.$dat_cultureitems['File_size'].'</td>
<td>'.$dat_cultureitems['Comment'].'</td>
<td><textarea name="comments'.$dat_cultureitems['ID'].'" rows="3" cols="50">'.$dat_cultureitems['Comment'].'</textarea></td>
</tr>');


}
echo('</table><input type="submit" value="Edit cultural items" /></form>');


?>