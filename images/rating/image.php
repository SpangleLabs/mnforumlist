<?
if(!isset($_GET['T'])) { header('Content-type: image/png'); }
include('../../connect.php');
$img = imagecreatetruecolor(254,128);
$bkcol = imagecolorallocate($img,255,255,255);
imagefill($img,0,0,$bkcol);
imagecolortransparent($img,$bkcol);

$bk = imagecreatefrompng('images/bk.png');
imagecopy($img,$bk,0,0,0,0,254,128);
$text = imagecreatefrompng('images/text.png');
imagecopy($img,$text,30,32,0,0,93,65);


$raw_rating = mysql_query('SELECT `Rating` FROM `'.$db_pre.'data` WHERE `NatID` = \''.$_GET['ID'].'\'');
$dat_rating = mysql_fetch_array($raw_rating);
$rating = $dat_rating['Rating'];

$centerX = "190";
$centerY = "64";

$digitimg['.'] = imagecreatefrompng('images/..png');
$digitwidth['.'] = imagesx($digitimg['.']);
$digitheight['.'] = imagesy($digitimg['.']);
for($a=0;$a<10;$a++) {
$digitimg[$a] = imagecreatefrompng('images/'.$a.'.png');
$digitwidth[$a] = imagesx($digitimg[$a]);
$digitheight[$a] = imagesy($digitimg[$a]);
}

$total_length = 0;
$stringlength = strlen($rating);
for($a=0;$a<$stringlength;$a++) {
$digit = substr($rating,$a,1);
$total_length += $digitwidth[$digit];
}

$running_length = 0;
for($a=0;$a<$stringlength;$a++) {
$digit = substr($rating,$a,1);
$X = $centerX-($total_length/2)+$running_length;
$Y = $centerY+(max($digitheight)/2)-$digitheight[$digit];
$running_length += $digitwidth[$digit];
imagecopy($img,$digitimg[$digit],$X,$Y,0,0,$digitwidth[$digit],$digitheight[$digit]);
}



//if(!isset($_GET['T'])) { 
imagepng($img); 
//}
imagedestroy($img);
?>