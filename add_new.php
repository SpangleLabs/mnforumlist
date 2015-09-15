<?
include('header.php');

echo('
<h1>'.function_lang('ADDFORM_TITLE',$conf_lang,$db_pref).'</h1>
<br />

<form action="add_new2.php" method="post">
<table border="1">
<tr>
<td>'.function_lang('ADDFORM_NAME_SHORT',$conf_lang,$db_pref).'</td>
<td><input type="text" name="Name" /></td>
</tr><tr>
<td>'.function_lang('ADDFORM_NAME_LONG',$conf_lang,$db_pref).'</td>
<td><input type="text" size="60" name="Full_name" /></td>
</tr><tr>
<td>'.function_lang('ADDFORM_STATUS',$conf_lang,$db_pref).'</td>
<td><input type="radio" name="Status" value="Alive" />'.function_lang('ADDFORM_STATUS_ALIVE',$conf_lang,$db_pref).'<br />
<input type="radio" name="Status" value="Dead" />'.function_lang('ADDFORM_STATUS_DEAD',$conf_lang,$db_pref).'</td>
</tr><tr>
<td>'.function_lang('ADDFORM_FOUNDING_DATE',$conf_lang,$db_pref).'</td>
<td><input type="text" size="2" name="FAOF_D" />/<input type="text" size="2" name="FAOF_M" />/<input type="text" size="4" name="FAOF_Y" /> '.function_lang('ADDFORM_DATEFORMAT',$conf_lang,$db_pref).'</td>
</tr><tr>
<td>'.function_lang('ADDFORM_LANGUAGE',$conf_lang,$db_pref).'</td>
<td><input type="text" name="Language" /></td>
</tr><tr>
<td>'.function_lang('ADDFORM_NUM_FORUMS',$conf_lang,$db_pref).'</td>
<td><input type="text" size ="2" name="Num_fora" /></td>
</tr><tr>
<td>'.function_lang('ADDFORM_NUM_WEBSITES',$conf_lang,$db_pref).'</td>
<td><input type="text" size ="2" name="Num_sites" /></td>
</tr>
</table>
<input type="submit" value="'.function_lang('ADDFORM_PROCEED',$conf_lang,$db_pref).'" />



</form>');

include('footer.php');
?>