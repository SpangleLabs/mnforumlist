<?
include('../connect.php');

$sql_table = 'SELECT `ID`,`Type` from `'.$db_pref.'forums` WHERE `Type_Count` = \'\'';
$raw_table = mysql_query($sql_table);
$num_table = mysql_num_rows($raw_table);

for($a=0;$a<$num_table;$a++) {
$dat_table = mysql_fetch_array($raw_table);
mysql_query('UPDATE `'.$db_pref.'forums` SET `Type_Count` = \''.$dat_table['Type'].'\' WHERE `ID` = \''.$dat_table['ID'].'\'');

}

?>