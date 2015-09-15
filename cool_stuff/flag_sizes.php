<?
die();
include('../connect.php');

$raw_flags = mysql_query('SELECT `ID`,`File_name` FROM `'.$db_pref.'flags`');
$num_flags = mysql_num_rows($raw_flags);

for($a=0;$a<$num_flags;$a++) {
$dat_flags = mysql_fetch_array($raw_flags);


if(substr($dat_flags['File_name'],-3)=='png') {
$img = imagecreatefrompng('../'.$dat_flags['File_name']);
} elseif(substr($dat_flags['File_name'],-3)=='gif') {
$img = imagecreatefromgif('../'.$dat_flags['File_name']);
} elseif(substr($dat_flags['File_name'],-3)=='jpg') {
$img = imagecreatefromjpeg('../'.$dat_flags['File_name']);
} elseif(substr($dat_flags['File_name'],-3)=='PNG') {
$img = imagecreatefrompng('../'.$dat_flags['File_name']);
} else {
echo('<b>ARRRGGHHH '.$dat_flags['ID'].'</b><br />');
}

$length_x = imagesx($img);
$length_y = imagesy($img);

imagedestroy($img);

mysql_query('UPDATE `'.$db_pref.'flags` SET `Length_X` = \''.$length_x.'\', `Length_Y` = \''.$length_y.'\' WHERE `ID` = \''.$dat_flags['ID'].'\'');
echo('Done '.$dat_flags['ID'].'<br />');
}


?>