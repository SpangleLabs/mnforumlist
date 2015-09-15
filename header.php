<?
include('connect.php');
include('function.spamstop.php');
include('function.newname.php');
include('function.whitelist.php');
include('function.email.php');
include('function.nonlatin.php');
include('function.rssadd.php');
include('function.play.php');
include('function.findlang.php');
if(!isset($_GET['L'])) {
$conf_lang = function_findlang($_SERVER['REMOTE_ADDR'],$db_pref);
} else {
$conf_lang = $_GET['L'];
}
include('function.lang.php');

$sql_langcode = 'SELECT `Code` FROM `'.$db_pref.'langs` WHERE `ID` = \''.$conf_lang.'\'';
$raw_langcode = mysql_query($sql_langcode);
$dat_langcode = mysql_fetch_array($raw_langcode);



echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'.$dat_langcode['Code'].'" lang="'.$dat_langcode['Code'].'">
<head>
	<title>'.function_lang('MAIN_TITLE',$conf_lang,$db_pref).'</title>
	<meta http-equiv="content-type"
 		content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
        <meta name="keywords" content="mn, mnlist, list, microlist, micro-nation, micronation, mikronation, micronatie, micronations, mikronationen, directory, microdirectory, micronational, flags, forums, websites, danny wallace, lovely, kingdom of lovely, citizens required, how to start your own country, how to start a micronation, talossa, atlantium, sealand, Hutt River Province, Norton, King, Kingdom, Prince, Principality, Republic, Government, The Mouse that Roared, The Mouse Roars Again, simgov, MMORPG" />');



if(substr($_SERVER['PHP_SELF'],-9)=="index.php") {
echo('        <style type="text/css">
        @import url(http://www.google.com/cse/api/branding.css);
        </style>');
}

$address = explode('/',$_SERVER[SCRIPT_NAME]);
$bits = count($address);
if($address[($bits-1)]=="add_new3.php") {
echo('<meta http-equiv="refresh" content="2;url=index.php" />');
}
?>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="faviconF.ico" />
</head>
<body>
<div id="button"><a href="http://dr-spangle.com"><img src="http://dr-spangle.com/images/home.php" alt="Home" /></a></div>

<div id="main">
<?
echo('<a class="image" href="index.php"><img src="images/'.function_lang('BANNER_IMG',$conf_lang,$db_pref).'" alt="'.function_lang('TITLE_ALT',$conf_lang,$db_pref).'" /></a>');

if(1==0) {
echo('<script type="text/javascript"><!--
google_ad_client = "pub-5547405481417256";
/* ForumList */
google_ad_slot = "2848926708";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>');
}
echo('
 <script type="text/javascript">
 var RecaptchaOptions = {
    theme : \'blackglass\',
    lang  : \''.$dat_langcode['Code'].'\'
 };
 </script>');

?>
<br /><br />