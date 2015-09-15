<?
include('header.php');
include('connect.php');

if(!isset($_POST['NatID']) || !isset($_POST['Reason'])) {
echo('Make sure that nation id and reason are specified in the form.');
include('footer.php');
die();
}

mysql_query('INSERT INTO `'.$db_pre.'rating_request` (`NatID`,`IP`,`Reason`,`Date`,`Fixed`) VALUES
(\''.$_POST['NatID'].'\',\''.$_SERVER['REMOTE_ADDR'].'\',\''.$_POST['Reason'].'\',\''.gmmktime().'\',\'N\')');


echo('Thank you for requesting this rating be reviewed, it will be reviewed and re-rated as soon as possible.
<meta http-equiv="refresh" content="2;url=rating.php?ID='.$_POST['NatID'].'" />');





include('footer.php');
?>