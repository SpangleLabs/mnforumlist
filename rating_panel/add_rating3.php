<?
include('../connect.php');


if($_POST['Activity']>1 || $_POST['Activity']<0) { die('Activity rating too high/low.'); }
if($_POST['History-Language-Sport']>1 || $_POST['History-Language-Sport']<0) { die('History/Language/Sport rating too high/low.'); }
if($_POST['Economics-Military']>1 || $_POST['Economics-Military']<0) { die('Economics/Military rating too high/low.'); }
if($_POST['Geography-Culture']>1 || $_POST['Geography-Culture']<0) { die('Geography/Culture rating too high/low.'); }
if($_POST['Imagination-Realism']>1 || $_POST['Imagination-Realism']<0) { die('Imagination/Realism rating too high/low.'); }

$total = $_POST['Activity']+$_POST['History-Language-Sport']+$_POST['Economics-Military']+$_POST['Geography-Culture']+$_POST['Imagination-Realism'];

mysql_query('INSERT INTO `'.$db_pre.'ratings` (`NatID`,`Activity`, `History-Language-Sport`, `Economics-Military`, `Geography-Culture`, `Imagination-Realism`,`Total`,`Date`) VALUES 
(\''.$_POST['NatID'].'\',\''.$_POST['Activity'].'\',\''.$_POST['History-Language-Sport'].'\',\''.$_POST['Economics-Military'].'\',\''.$_POST['Geography-Culture'].'\',\''.$_POST['Imagination-Realism'].'\',\''.$total.'\',\''.gmmktime().'\')');

$raw_requests = mysql_query('SELECT `ID` FROM `'.$db_pre.'rating_request` WHERE `NatID` = \''.$_POST['NatID'].'\'');
$num_requests = mysql_num_rows($raw_requests);

for($a=0;$a<$num_requests;$a++) {
$dat_requests = mysql_fetch_array($raw_requests);

mysql_query('UPDATE `'.$db_pre.'rating_request` SET `Fixed` = \'Y\' WHERE `ID` = \''.$dat_requests['ID'].'\'');
}



echo('New rating added.
<meta http-equiv="refresh" content="2;url=index.php" />');

?>