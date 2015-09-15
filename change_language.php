<?
include('header.php');
include('connect.php');

$conf_lang = $_POST['Language'];
$sql_updateman = 'UPDATE `'.$db_pref.'lang_ip` SET `Manual` = \'Y\' WHERE `IP` = \''.$_SERVER['REMOTE_ADDR'].'\'';
$raw_updateman = mysql_query($sql_updateman);
$sql_updatelan = 'UPDATE `'.$db_pref.'lang_ip` SET `Language` = \''.$_POST['Language'].'\' WHERE `IP` = \''.$_SERVER['REMOTE_ADDR'].'\'';
$raw_updatelan = mysql_query($sql_updatelan);
$sql_updatetime = 'UPDATE `'.$db_pref.'lang_ip` SET `Last_Change` = \''.gmmktime().'\' WHERE `IP` = \''.$_SERVER['REMOTE_ADDR'].'\'';
$raw_updatetime = mysql_query($sql_updatetime);

echo(function_lang('LANGUAGE_CHANGED',$conf_lang,$db_pref,array($_POST['Language'])));



include('footer.php');
?>