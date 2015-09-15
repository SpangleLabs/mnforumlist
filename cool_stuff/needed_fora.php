<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Ultimate MN List.</title>
	<meta http-equiv="content-type"
 		content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
<div id="info">
<?
include('connect.php');

$raw_noforum = mysql_query('SELECT NatID, Name FROM '.$db_pre.'data WHERE forums = \'0\' ORDER BY `Name`');
$num_noforum = mysql_num_rows($raw_noforum);

echo('Nations with no uploaded fora (a total of '.$num_noforum.'):<br />');
for($a=0;$a<$num_noforum;$a++) {
$dat_noforum = mysql_fetch_array($raw_noforum);
echo(($a+1).') <b>'.$dat_noforum['Name'].'</b> (ID '.$dat_noforum['NatID'].')<br />');
}

$raw_alivenation = mysql_query('SELECT NatID, Name FROM '.$db_pre.'data WHERE status = \'Alive\' ORDER BY `Name`');
$num_alivenation = mysql_num_rows($raw_alivenation);

$c=1;
echo('<br /><br /><br />Nations with no forums in use:<br />');
for($b=0;$b<$num_alivenation;$b++) {
$dat_alivenation = mysql_fetch_array($raw_alivenation);

$raw_inusefora = mysql_query('SELECT ID FROM '.$db_pre.'forums WHERE Forum_status = \'In use\' AND NatID = \''.$dat_alivenation['NatID'].'\'');
$num_inusefora = mysql_num_rows($raw_inusefora);

if($num_inusefora==0) {
echo($c.') <b>'.$dat_alivenation['Name'].'</b> (ID '.$dat_alivenation['NatID'].')<br />');
$c++;
}


}



?>
</div>
</body>
</html>