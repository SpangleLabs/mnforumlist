<?
include('header.php');

if(isset($_POST['NatID'])) {
$NatID = $_POST['NatID'];
} else {
echo(function_lang('NO_NATID',$conf_lang,$db_pref));
include('footer.php');
die();
}
if(isset($_POST['Type'])) {
$Type = $_POST['Type'];
} else {
echo(function_lang('REQUESTMOD_NODATA',$conf_lang,$db_pref));
include('footer.php');
die();
}
if(isset($_POST['Desc'])) {
$Desc = $_POST['Desc'];
$Desc = function_spamstop($Desc);
$Desc = str_replace("\n",'<br />',$Desc);
} else {
echo(function_lang('REQUESTMOD_NODESC',$conf_lang,$db_pref));
include('footer.php');
die();
}
$Name = $_POST['Name'];
$Timestamp = gmmktime();
$IP = $_SERVER['REMOTE_ADDR'];



  require_once('recaptchalib.php');
  $privatekey = "6Ldj_7sSAAAAAKiK3_8R6qxpdFjT-An0Hjbw2mt1";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    echo ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
include('footer.php');
die();
  } else {
    // Your code here to handle a successful verification
mysql_query('INSERT INTO `'.$db_pref.'modifications` (`NatID`,`Type`,`Timestamp`,`Name`,`IP`,`Suggestion`)
VALUES (\''.$NatID.'\',\''.$Type.'\',\''.$Timestamp.'\',\''.$Name.'\',\''.$IP.'\',\''.$Desc.'\')');

$raw_name = mysql_query('SELECT `Name` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$NatID.'\'');
$dat_name = mysql_fetch_array($raw_name);

function_email("Modification requested",$dat_name['Name'],$Type,$Desc);

echo(function_lang('REQUESTMOD_REQUESTED',$conf_lang,$db_pref,array($NatID)));


  }

include('footer.php');
?>