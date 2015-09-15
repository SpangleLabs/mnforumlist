<?
include('header.php');
include('connect.php');

$name = mysql_fetch_array(mysql_query('SELECT Name FROM '.$db_pre.'data WHERE NatID = \''.$_GET['ID'].'\''));

echo('<h1>'.function_lang('FLAGUP_TITLE',$conf_lang,$db_pref,array($name['Name'])).'</h1>

<form action="upload_flag2.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="NatID" value="'.$_GET['ID'].'" />
<table border="1">
<tr>
<td><b>'.function_lang('INFO_COL_TYPE',$conf_lang,$db_pref).':</b></td>
<td><input type="radio" name="Type" value="Main" />'.function_lang('FLAGUP_TYPE_MAIN',$conf_lang,$db_pref).' - '.function_lang('FLAGUP_WARNING_MAIN',$conf_lang,$db_pref).'<br />
<input type="radio" name="Type" value="Provincial" />'.function_lang('FLAGUP_TYPE_PROVINCE',$conf_lang,$db_pref).'<br />
<input type="radio" name="Type" value="Historic" />'.function_lang('FLAGUP_TYPE_HISTORIC',$conf_lang,$db_pref).'</td>
</tr><tr>
<td><b>'.function_lang('INFO_COL_UPLOAD',$conf_lang,$db_pref).':</b></td>
<td><input type="file" name="Flag" id="Flag" /></td>
</tr><tr>
<td><b>'.function_lang('INFO_COL_AREA',$conf_lang,$db_pref).':</b></td>
<td><input type="text" name="Area" /></td>
</tr><tr>
<td><b>'.function_lang('INFO_COL_DESC',$conf_lang,$db_pref).':</b></td>
<td><textarea name="Description" rows="3" cols="50"></textarea></td>
</tr><tr>
<td colspan="2"><input type="submit" value="'.function_lang('FLAGUP_SUBMIT',$conf_lang,$db_pref).'" /></td>
</tr>
</table>
</form>');


include('footer.php');
?>