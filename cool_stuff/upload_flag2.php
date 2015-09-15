<?
include('header.php');
include('connect.php');

$folder_num = str_pad($_POST['NatID'],4,'0',STR_PAD_LEFT);
if($_POST['Type']=="Main") {
if(is_file('flags/'.$folder_num.'/Main.png')) {
$_FILES['Flag']['name'] = function_newname('flags/'.$folder_num.'/','Main.png');
} else {
$_FILES['Flag']['name'] = 'flags/'.$folder_num.'/Main.png';
}

if(is_file('flags/'.$folder_num.'/Thumbnail.png')) {
$_FILES['Flag']['Thumbname'] = function_newname('flags/'.$folder_num.'/','Thumbnail.png');
} else {
$_FILES['Flag']['Thumbname'] = 'flags/'.$folder_num.'/Thumbnail.png';
}

} else {
if(is_file('flags'.$folder_num.'/'.$_FILES['Flag']['name'])) {
$_FILES['Flag']['name'] = function_newname('flags/'.$folder_num.'/',$_FILES['Flag']['name']);
} else {
$_FILES['Flag']['name'] = 'flags/'.$folder_num.'/'.$_FILES['Flag']['name'];
}

}


if(function_whitelist($_FILES['Flag']['type'])==0) {
$nation_name = mysql_fetch_array(mysql_query('SELECT Name FROM '.$db_pre.'data WHERE NatID = \''.$_POST['NatID'].'\''));
echo('Sorry this file type is not allowed.');
function_email("Flag Upload Failed",$_FILES,$nation_name['Name'],$folder_num);
include('footer.php');
die();
}

move_uploaded_file($_FILES['Flag']['tmp_name'],'flags/.temp/'.mktime().'-'.md5(mktime()).'.png');

if($_FILES['Flag']['type']=="image/png" || $_FILES['Flag']['type']=="image/x-png") {
$img = imagecreatefrompng('flags/.temp/'.mktime().'-'.md5(mktime()).'.png');
} elseif($_FILES['Flag']['type']=="image/gif") {
$img = imagecreatefromgif('flags/.temp/'.mktime().'-'.md5(mktime()).'.png');
} elseif($_FILES['Flag']['type']=="image/jpeg" || $_FILES['Flag']['type']=="image/pjpeg") {
$img = imagecreatefromjpeg('flags/.temp/'.mktime().'-'.md5(mktime()).'.png');
} else {
echo('I&#39;m sorry but this image type is not currently supported, please convert it into a png, gif or jpeg.');
function_email("Flag Upload Failed",$_FILES,$nation_name['Name'],$folder_num);
include('footer.php');
die();
}

if(imagesy($img)>150) {
//image too big, scale down
echo('Image is too big, scaling down.<br />');
$rimg = imagecreatetruecolor((imagesx($img)/(imagesy($img)/150)),150);
imagecopyresized($rimg,$img,0,0,0,0,(imagesx($img)/(imagesy($img)/150)),150,imagesx($img),imagesy($img));
}

if($_POST['Type']=="Main") {
//create thumbnail
echo('Creating thumbnail.<br />');
$timg = imagecreatetruecolor((imagesx($img)/(imagesy($img)/16)),16);
imagecopyresized($timg,$img,0,0,0,0,(imagesx($img)/(imagesy($img)/16)),16,imagesx($img),imagesy($img));
}


if(isset($rimg)) {
imagepng($rimg,$_FILES['Flag']['name']);

mysql_query('INSERT INTO '.$db_pre.'flags (NatID,File_name,Type,Area,Description)
VALUES (\''.$_POST['NatID'].'\',\''.$_FILES['Flag']['name'].'\',\''.$_POST['Type'].'\',\''.$_POST['Area'].'\',\''.$_POST['Description'].'\')');
function_email("Flag Uploaded",$_FILES,$nation_name['Name'],$folder_num);
echo('Flag added!<br />
<a href="nation.php?ID='.$_POST['NatID'].'">Click here</a> to go back to this nation&#39;s page.');

if($_POST['Type']=='Main') {
$raw_flagID = mysql_query('SELECT `ID` FROM `'.$db_pref.'flags` WHERE `Type` = \'Main\' ORDER BY `ID` DESC');
$dat_flagID = mysql_fetch_array($raw_flagID);
mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_main` = \''.$dat_flagID['ID'].'\' WHERE `NatID` = \''.$_POST['NatID'].'\'');
}


} elseif(isset($img)) {
imagepng($img,$_FILES['Flag']['name']);

mysql_query('INSERT INTO '.$db_pre.'flags (NatID,File_name,Type,Area,Description)
VALUES (\''.$_POST['NatID'].'\',\''.$_FILES['Flag']['name'].'\',\''.$_POST['Type'].'\',\''.$_POST['Area'].'\',\''.$_POST['Description'].'\')');
function_email("Flag Uploaded",$_FILES,$nation_name['Name'],$folder_num);

if($_POST['Type']=='Main') {
$raw_flagID = mysql_query('SELECT `ID` FROM `'.$db_pref.'flags` WHERE `Type` = \'Main\' ORDER BY `ID` DESC');
$dat_flagID = mysql_fetch_array($raw_flagID);
mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_main` = \''.$dat_flagID['ID'].'\' WHERE `NatID` = \''.$_POST['NatID'].'\'');
}

echo('Flag added!<br />
<a href="nation.php?ID='.$_POST['NatID'].'">Click here</a> to go back to this nation&#39;s page.');

}


if(isset($timg) && isset($_FILES['Flag']['Thumbname'])) {
imagepng($timg,$_FILES['Flag']['Thumbname']);

mysql_query('INSERT INTO '.$db_pre.'flags (NatID,File_name,Type,Area,Description)
VALUES (\''.$_POST['NatID'].'\',\''.$_FILES['Flag']['Thumbname'].'\',\'Thumbnail\',\''.$_POST['Area'].'\',\''.$_POST['Description'].'\')');
$raw_thumbID = mysql_query('SELECT `ID` FROM `'.$db_pref.'flags` WHERE `Type` = \'Thumbnail\' ORDER BY `ID` DESC');
$dat_thumbID = mysql_fetch_array($raw_thumbID);
mysql_query('UPDATE `'.$db_pref.'data` SET `Flag_thumb` = \''.$dat_thumbID['ID'].'\' WHERE `NatID` = \''.$_POST['NatID'].'\'');

}

imagedestroy($img);
if(isset($rimg)) { imagedestroy($rimg); }
if(isset($timg)) { imagedestroy($timg); }

include('footer.php');
?>