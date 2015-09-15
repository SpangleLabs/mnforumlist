<?include('header.php');
include('connect.php');

echo('<form action="add_new3.php" method="post">
<input type="hidden" name="Name" value="'.$_POST['Name'].'" />
<input type="hidden" name="Full_name" value="'.$_POST['Full_name'].'" />
<input type="hidden" name="Status" value="'.$_POST['Status'].'" />
<input type="hidden" name="FAOF_D" value="'.$_POST['FAOF_D'].'" />
<input type="hidden" name="FAOF_M" value="'.$_POST['FAOF_M'].'" />
<input type="hidden" name="FAOF_Y" value="'.$_POST['FAOF_Y'].'" />
<input type="hidden" name="Language" value="'.$_POST['Language'].'" />
<input type="hidden" name="Num_fora" value="'.$_POST['Num_fora'].'" />
<input type="hidden" name="Num_sites" value="'.$_POST['Num_sites'].'" />');



if($_POST['Num_fora']!=0) { echo('<table border="1">'); }

for($a=0;$a<$_POST['Num_fora'];$a++) {
echo('<tr>
<td>'.function_lang('ADDFORM_FORUM_ADDR',$conf_lang,$db_pref).'</td>
<td><input type="text" name="Forum'.$a.'_address" /></td>
</tr><tr>
<td>'.function_lang('ADDFORM_FORUM_STATUS',$conf_lang,$db_pref).'</td>
<td><input type="radio" name="Forum'.$a.'_status" value="In use" />'.function_lang('ADDFORM_STATUS_ALIVE',$conf_lang,$db_pref).'<br />
<input type="radio" name="Forum'.$a.'_status" value="Dead" />'.function_lang('ADDFORM_STATUS_DEAD',$conf_lang,$db_pref).'</td>
</tr><tr>
<td>'.function_lang('ADDFORM_FORUM_TYPE',$conf_lang,$db_pref).'</td>
<td><select name="Forum'.$a.'_type">');
$raw_forumtypes = mysql_query('SELECT DISTINCT `Type` FROM `'.$db_pref.'forums` WHERE `Type` <> \'Unknown\' ORDER BY `Type`');
$num_forumtypes = mysql_num_rows($raw_forumtypes);
for($b=0;$b<$num_forumtypes;$b++) {
$dat_forums = mysql_fetch_array($raw_forumtypes);
echo('<option value="'.$dat_forums['Type'].'">'.$dat_forums['Type'].'</option>');
}
echo('<option value="'.Other.'">Other</option>
</select></td></tr>');
if($a!=($_POST['Num_fora']-1)) {
echo('<tr><td colspan="2"></td></tr>');
}}

if($_POST['Num_fora']!=0) { echo('</table>'); }


if($_POST['Num_sites']!=0) { echo('<br /><br /><table border="1">'); }

for($a=0;$a<$_POST['Num_sites'];$a++) {
echo('<tr>
<td>'.function_lang('ADDFORM_WEBSITE_ADDR',$conf_lang,$db_pref).'</td>
<td><input type="text" name="Website'.$a.'_address" /></td>
</tr><tr>
<td>'.function_lang('ADDFORM_WEBSITE_TYPE',$conf_lang,$db_pref).'</td>
<td><select name="Website'.$a.'_type">');
$raw_sitetypes = mysql_query('SELECT DISTINCT `Type` FROM `'.$db_pref.'websites` ORDER BY `Type`');
$num_sitetypes = mysql_num_rows($raw_sitetypes);
for($b=0;$b<$num_sitetypes;$b++) {
$dat_sitetypes = mysql_fetch_array($raw_sitetypes);
echo('<option value="'.$dat_sitetypes['Type'].'">'.$dat_sitetypes['Type'].'</option>');
}
echo('<option value="Other">Other</option>
</select></td>
</tr><tr>
<td>'.function_lang('ADDFORM_WEBSITE_STATUS',$conf_lang,$db_pref).'</td>
<td><input type="radio" name="Website'.$a.'_status" value="In use" />'.function_lang('ADDFORM_STATUS_INUSE',$conf_lang,$db_pref).'<br />
<input type="radio" name="Website'.$a.'_status" value="Dead" />'.function_lang('ADDFORM_STATUS_DEAD',$conf_lang,$db_pref).'</td>
</tr><tr>
<td>'.function_lang('ADDFORM_WEBSITE_LANGUAGE',$conf_lang,$db_pref).'</td>
<td><input type="text" name="Website'.$a.'_language" /></td>
</tr>');
if($a!=($_POST['Num_sites']-1)) {
echo('<tr><td colspan="2"></td></tr>');
}}

if($_POST['Num_sites']!=0) { echo('</table>'); }

echo('<input type="submit" value="'.function_lang('ADDFORM_SUBMIT',$conf_lang,$db_pref).'" />
</form>');


include('footer.php');?>