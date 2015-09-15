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

$raw_nations = mysql_query('SELECT * FROM '.$db_pre.'data');
$num_nations = mysql_num_rows($raw_nations);
$b=1;
for($a=1;$a<=$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);
if($dat_nations['Full_name']=="") {
echo($b.') Nation number <b>'.$dat_nations['NatID'].'</b>, '.$dat_nations['Name'].'.<br />');
$b++;
}
}

?>
</div>
</body>
</html>