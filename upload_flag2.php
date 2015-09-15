<?
include('header.php');
include('connect.php');
$upload_time = gmmktime();

$raw_name = mysql_query('SELECT Name FROM '.$db_pre.'data WHERE NatID = \''.$_POST['NatID'].'\'');
$dat_name = mysql_fetch_array($raw_name);
$upload_folder = str_pad($_POST['NatID'],4,'0',STR_PAD_LEFT);
if(!is_dir('flags/'.$upload_folder)) { mkdir('flags/'.$upload_folder); }

////////////////////////////////////////CHECK FLAG IS SAFE////////////////////////////////////////
move_uploaded_file($_FILES['Flag']['tmp_name'],'flags/.temp/'.$upload_time.'-'.md5($upload_time).'.png');
//$mime = system('mimetype flags/.temp/'.$upload_time.'-'.md5($upload_time).'.png');
//die($mime);
//$mime = explode(' ',$mime);
//$upload_filetype = $mime[1];
//$finfo = finfo_open(FILEINFO_MIME, "/usr/share/misc/magic"); // return mime type ala mimetype extension
//$upload_filetype = finfo_file($finfo,'flags/.temp/'.$upload_time.'-'.md5($upload_time).'.png');
//finfo_close($finfo);
$upload_filetype = $_FILES['Flag']['type'];

if(function_whitelist($upload_filetype)==0) {

echo(function_lang('UPLOAD_UNSAFE',$conf_lang,$db_pref,array($future_file_name)));
function_email("Flag Upload Failed",$_FILES,$nation_name['Name'],$_POST['NatID']);
unlink('flags/.temp/'.$upload_time.'-'.md5($upload_time).'.png');
include('footer.php');
die();
}
////////////////////////////////////////FIND FILE FORMAT, OPEN AS $IMG////////////////////////////////////////
if($upload_filetype=="image/png" || $upload_filetype=="image/x-png") {
$img = imagecreatefrompng('flags/.temp/'.$upload_time.'-'.md5($upload_time).'.png');
} elseif($upload_filetype=="image/gif") {
$img = imagecreatefromgif('flags/.temp/'.$upload_time.'-'.md5($upload_time).'.png');
} elseif($upload_filetype=="image/jpeg" || $upload_filetype=="image/pjpeg") {
$img = imagecreatefromjpeg('flags/.temp/'.$upload_time.'-'.md5($upload_time).'.png');
} else {
echo(function_lang('FLAGUP_UNSUPPORTED',$conf_lang,$db_pref));
function_email("Flag Upload Failed",$_FILES,$dat_name['Name'],$_POST['NatID']);
include('footer.php');
die();
}
////////////////////////////////////////CALCULATE NEW NAME AS .PNG////////////////////////////////////////
$upload_filename = $_FILES['Flag']['name'];
$upload_filename_explode = explode('.',$upload_filename);
array_pop($upload_filename_explode);
$upload_filename = implode('.',$upload_filename_explode);
$upload_filename = $upload_filename.'.png';
$upload_dest = 'flags/'.$upload_folder.'/'.$upload_filename;
////////////////////////////////////////SAVE AS .PNG////////////////////////////////////////
imagepng($img,$upload_dest,9);
////////////////////////////////////////ADD TO DATABASE////////////////////////////////////////
$upload_X = imagesx($img);
$upload_Y = imagesy($img);
mysql_query('INSERT INTO `'.$db_pref.'flags` (`NatID`,`File_name`,`Type`,`Area`,`Description`,`Length_X`,`Length_Y`) VALUES
(\''.$_POST['NatID'].'\',\''.$upload_dest.'\',\''.$_POST['Type'].'\',\''.$_POST['Area'].'\',\''.$_POST['Description'].'\',\''.$upload_X.'\',\''.$upload_Y.'\')');
$upload_ID = mysql_fetch_array(mysql_query('SELECT LAST_INSERT_ID()'));
$upload_ID = $upload_ID[0];


//////////////////////////////////////// - MAKE THUMBNAIL////////////////////////////////////////
$upload_thumb_Y = 16;
$upload_thumb_X = $upload_X*$upload_thumb_Y/$upload_Y;
$img_thumb = imagecreatetruecolor($upload_thumb_X,$upload_thumb_Y);
imagecopyresized($img_thumb,$img,0,0,0,0,$upload_thumb_X,$upload_thumb_Y,$upload_X,$upload_Y);
//////////////////////////////////////// - SAVE THUMBNAIL////////////////////////////////////////
$upload_thumb_filename = implode('.',$upload_filename_explode);
$upload_thumb_filename = $upload_thumb_filename.'.thumb.png';
$upload_thumb_dest = 'flags/'.$upload_folder.'/'.$upload_thumb_filename;
imagepng($img_thumb,$upload_thumb_dest);
//////////////////////////////////////// - ADD THUMBNAIL TO DATABASE////////////////////////////////////////
mysql_query('INSERT INTO `'.$db_pref.'flags` (`NatID`,`File_name`,`Type`,`Area`,`Description`,`Length_X`,`Length_Y`) VALUES
(\''.$_POST['NatID'].'\',\''.$upload_thumb_dest.'\',\'Thumbnail\',\''.$_POST['Area'].'\',\''.$_POST['Description'].'\',\''.$upload_thumb_Y.'\',\''.$upload_thumb_X.'\')');
$upload_thumb_ID = mysql_fetch_array(mysql_query('SELECT LAST_INSERT_ID()'));
$upload_thumb_ID = $upload_thumb_ID[0];
//////////////////////////////////////// - RESET NATION'S MAIN FLAG AND THUMBNAIL IN DATA TABLE////////////////////////////////////////
if($_POST['Type']=="Main") {
mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_main` = \''.$upload_ID.'\', `Flag_thumb` = \''.$upload_thumb_ID.'\' WHERE `NatID` = \''.$_POST['NatID'].'\'');
}
mysql_query('UPDATE `'.$db_pref.'flags` SET `ThumbID` = \''.$upload_thumb_ID.'\' WHERE `ID` = \''.$upload_ID.'\'');
//////////////////////////////////////// - IMAGEDESTROY THE THUMBNAIL }////////////////////////////////////////
imagedestroy($img_thumb);
////////////////////////////////////////IMAGEDESTROY THE FLAG////////////////////////////////////////
imagedestroy($img);

////////////////////////////////////////ADD RSS NOTIFICATION////////////////////////////////////////
function_rssadd("NewFlag",$db_pref,$_POST['NatID'],"http://mnforumlist.com/flags.php?ID=".$_POST['NatID'],' It is a '.$_POST['Type'].' flag for the area "'.$_POST['Area'].'" and it is described as "'.$_POST['Description'].'".');

echo(function_lang('FLAGUP_SUCCESS',$conf_lang,$db_pref,array($_POST['NatID'])));

/*
 - Check flag is safe
 - Find file format
 - Open as $img
 - Calculate new name as .png
 - Sae as .png
 - Add to database
 - If main {
 - - Make thumbnail
 - - Save thumbnail
 - - add thumbnail to database
 - - Reset nation's main flag and thumbnail in data table
 - - imagedestroy the thumbnai; }
 - imagedestroy flag

*/

include('footer.php');
?>
