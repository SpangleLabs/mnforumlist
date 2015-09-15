<?
die();
include('../connect.php');

$raw_flags = mysql_query('SELECT `NatID`,`ID`,`File_name`,`Length_X`,`Length_Y` FROM `'.$db_pref.'flags` WHERE `ThumbID` = \'0\' AND `Type` != \'Thumbnail\'');
$num_flags = mysql_num_rows($raw_flags);

if($num_flags==0) {
die('No more flags to make thumbnails for.');
} else {
echo('Only need to make '.$num_flags.' more thumbnails.<br /><br />');
}

$dat_flags = mysql_fetch_array($raw_flags);

$img = imagecreatefrompng('../'.$dat_flags['File_name']);
echo('Loaded flag as image.<br />');

$new_Y = 16;
$new_X = $dat_flags['Length_X']*$new_Y/$dat_flags['Length_Y'];
echo('Calculated new size.<br />');

$img_thumb = imagecreatetruecolor($new_X,$new_Y);
imagecopyresized($img_thumb,$img,0,0,0,0,$new_X,$new_Y,$dat_flags['Length_X'],$dat_flags['Length_Y']);
echo('Resized image.<br />');

$explode_name = explode('.',$dat_flags['File_name']);
array_pop($explode_name);
$name = implode('.',$explode_name);
$name = $name.'.thumb.png';
echo('Calculated new name.<br />');

imagepng($img_thumb,'../'.$name);
echo('Saved image.<br />');

mysql_query('INSERT INTO `'.$db_pref.'flags` (`NatID`,`File_name`,`Type`,`Length_X`,`Length_Y`) VALUES
(\''.$dat_flags['NatID'].'\',\''.$name.'\',\'Thumbnail\',\''.$new_Y.'\',\''.$new_X.'\')');
$upload_thumb_ID = mysql_fetch_array(mysql_query('SELECT LAST_INSERT_ID()'));
$upload_thumb_ID = $upload_thumb_ID[0];
echo('Added to flags table. ID='.$upload_thumb_ID.'<br />');

mysql_query('UPDATE `'.$db_pref.'flags` SET `ThumbID` = \''.$upload_thumb_ID.'\' WHERE `ID` = \''.$dat_flags['ID'].'\'');
echo('Updated flags table.<br />');

$raw_natmain = mysql_query('SELECT `NatID` FROM `'.$db_pref.'data` WHERE `Flag_main` = \''.$dat_flags['ID'].'\'');
$num_natmain = mysql_num_rows($raw_natmain);
for($a=0;$a<$num_natmain;$a++) {
$dat_natmain = mysql_fetch_array($raw_natmain);
mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_thumb` = \''.$upload_thumb_ID.'\' WHERE `NatID` = \''.$dat_natmain['NatID'].'\'');
}
echo('Updated data table.<br />');

?>