<?
include('header.php');
include('connect.php');

$NatID = $_POST['NatID'];
$Desc = $_POST['Desc'];
$Name = $_POST['Name'];
$IP = $_SERVER['REMOTE_ADDR'];
$Date = gmmktime();

if(!isset($_POST['Desc']) || $_POST['Desc']=='') {
echo(function_lang('DESC_NONE',$conf_lang,$db_pref));
include('footer.php');
die();
}

$Desc = function_spamstop($Desc);
$Desc = str_replace("\n",'<br />',$Desc);

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
function_email("New Description",$_POST,$IP,0);
mysql_query('INSERT INTO `'.$db_pref.'descriptions` (`NatID`,`Desc`,`Name`,`IP`,`Date`) VALUES
(\''.$NatID.'\',\''.$Desc.'\',\''.$Name.'\',\''.$IP.'\',\''.$Date.'\')');
function_rssadd("NewDescription",$db_pref,$NatID,'http://mnforumlist.com/descriptions.php?ID='.$NatID,' The description was written by '.$Name.' and is as follows:<br /><br />'.$Desc);
echo(function_lang('DESC_ADDED',$conf_lang,$db_pref,array($NatID)));

  }

include('footer.php');
?>