<?

echo('<form action="action.addnation3.php" method="post">
<input type="hidden" name="Name" value="'.$_POST['Name'].'" />
<input type="hidden" name="Full_name" value="'.$_POST['Full_name'].'" />
<input type="hidden" name="Status" value="'.$_POST['Status'].'" />
<input type="hidden" name="FAOF_D" value="'.$_POST['FAOF_D'].'" />
<input type="hidden" name="FAOF_M" value="'.$_POST['FAOF_M'].'" />
<input type="hidden" name="FAOF_Y" value="'.$_POST['FAOF_Y'].'" />
<input type="hidden" name="Language" value="'.$_POST['Language'].'" />
<input type="hidden" name="Num_fora" value="'.$_POST['Num_fora'].'" />
<input type="hidden" name="Num_sites" value="'.$_POST['Num_sites'].'" />




<table border="1">');

for($a=0;$a<$_POST['Num_fora'];$a++) {
echo('<tr>
<td>Forum address</td>
<td><input type="text" name="Forum'.$a.'_address" /></td>
</tr><tr>
<td>Forum Status</td>
<td><input type="text" name="Forum'.$a.'_status" /></td>
</tr><tr>
<td>Forum Type</td>
<td><input type="text" name="Forum'.$a.'_type" /></td>
</tr><tr><td></td><td></td></tr>');
}

echo('</table><br /><br /><table border="1">');

for($a=0;$a<$_POST['Num_sites'];$a++) {
echo('<tr>
<td>Website address</td>
<td><input type="text" name="Website'.$a.'_address" /></td>
</tr><tr>
<td>Website Type</td>
<td><input type="text" name="Website'.$a.'_type" /></td>
</tr><tr>
<td>Website Status</td>
<td><input type="text" name="Website'.$a.'_status" /></td>
</tr><tr>
<td>Language</td>
<td><input type="text" name="Website'.$a.'_language" /></td>
</tr><tr><td></td><td></td></tr>');
}

echo('</table>
<input type="submit" value="Add nation" />
</form>');


print_r($_POST);


?>