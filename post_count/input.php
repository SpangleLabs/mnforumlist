<form action="output.php" method="get">
<table>
<tr>
<td>URL of the forum:</td>
<td><input type="text" name="Url" size="40"/></td>
</tr>
<tr>
<td>Type of forum:</td>
<td>
<select name="Type">
<?

$types = 'Aceboard
Proboards
Excoboard
PhpBB2
Invision
Ezboard
PhpBB3
PhpBB2-Dutch
Burning Board
Yuku
SMF
Unknown
Zetaboards
PhpBB2-French
Freewebs
MyBB
AWCforum
Google Group
Yahoo Group
Ning
e107
PhpBB3-Dutch
MyBB-Russ
Other
Orkut
PunBB';
$array_types = explode("\n",$types);
$num_types = count($array_types);

for($a=0;$a<$num_types;$a++) {
echo('<option value="'.$array_types[$a].'">'.$array_types[$a].'</option>');
}

?>
</select>
</td>
</tr>
</table>
<input type="submit" value="Submit" />
</form>