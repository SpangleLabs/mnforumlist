<?
include('../connect.php');

mysql_query('UPDATE `'.$db_pref.'data` SET `Name` = \''.$_POST['Name'].'\', `Full_name` = \''.$_POST['Full_name'].'\', `Status` = \''.$_POST['Status'].'\', `Language` = \''.$_POST['Language'].'\' WHERE `NatID` = \''.$_POST['NatID'].'\'');

echo('Basic data fixed.<br />
<a href="view_modifications.php">Click here</a> to go to the modifications page.<br />
<a href="index.php">Click here</a> to go to the main admin panel page.<pre>');

print_r($_POST);

?>