<?
include('header.php');
include('connect.php');

$name = mysql_fetch_array(mysql_query('SELECT Name FROM '.$db_pre.'data WHERE NatID = \''.$_GET['ID'].'\''));

echo('<h1>'.function_lang('FLAG_TITLE',$conf_lang,$db_pref,array($_GET['ID'],$name['Name'])).'</h1>

'.function_lang('FLAG_UPLOADHERE',$conf_lang,$db_pref,array($_GET['ID'])).'
<table border="1">
<tr>
<td>'.function_lang('INFO_COL_FLAG',$conf_lang,$db_pref).'</td>
<td>'.function_lang('INFO_COL_TYPE',$conf_lang,$db_pref).'</td>
<td>'.function_lang('INFO_COL_AREA',$conf_lang,$db_pref).'</td>
<td>'.function_lang('INFO_COL_DESC',$conf_lang,$db_pref).'</td>
</tr>');

$raw_flags = mysql_query('SELECT `File_name`,`Type`,`Area`,`Description`,`Length_X`,`Length_Y` FROM `'.$db_pre.'flags` WHERE `NatID` = \''.$_GET['ID'].'\' AND `Type` != \'Thumbnail\' ORDER BY `Type`,`Area`');
$num_flags = mysql_num_rows($raw_flags);

for($a=1;$a<=$num_flags;$a++) {
$dat_flags = mysql_fetch_array($raw_flags);

if($dat_flags['Length_X']>300) {
$flag_X = 300;
$flag_Y = $dat_flags['Length_Y']/$dat_flags['Length_X']*$flag_X;
} else {
$flag_X = $dat_flags['Length_X'];
$flag_Y = $dat_flags['Length_Y'];
}

echo('
<tr>
<td><img src="'.$dat_flags['File_name'].'" alt="'.function_lang('FLAG_ALT',$conf_lang,$db_pref,array($dat_flags['Area'])).'" width="'.$flag_X.'" height="'.$flag_Y.'" /></td>
<td>'.$dat_flags['Type'].'</td>
<td>'.$dat_flags['Area'].'</td>
<td>'.$dat_flags['Description'].'</td>
</tr>');

}


echo('</table>');


include('footer.php');
?>