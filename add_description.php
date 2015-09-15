<?
include('header.php');
include('connect.php');

echo('
<form action="add_description2.php" method="post">
<input type="hidden" name="NatID" value="'.$_GET['ID'].'" />
<table border="1">
<tr>
<td>'.function_lang('DESC',$conf_lang,$db_pref).'</td>
<td><textarea name="Desc" rows="15" cols="70">'.function_lang('DESC',$conf_lang,$db_pref).'</textarea></td>
</tr><tr>
<td>'.function_lang('YOURNAME',$conf_lang,$db_pref).'</td>
<td><input type="text" name="Name" /></td>
</tr><tr>
<td>Recaptcha</td>
<td>');
require_once('recaptchalib.php');
$publickey = "6Ldj_7sSAAAAAB3JtyCKphu4Kogn8YeeYWZXINyp"; // you got this from the signup page
echo recaptcha_get_html($publickey);
echo('</td>
</tr><tr>
<td colspan="2">'.function_lang('WARNING_IP',$conf_lang,$db_pref).'<br />
<input type="submit" value="'.function_lang('DESC_SUBMIT',$conf_lang,$db_pref).'" /></td>
</tr>
</table>');

include('footer.php');
?>