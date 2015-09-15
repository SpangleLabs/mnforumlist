<?
include('../../connect.php');
include('function.editculture.php');

$raw_culture = mysql_query('SELECT `ID` FROM `'.$db_pref.'culture`');
$num_culture = mysql_num_rows($raw_culture);

for($a=0;$a<$num_culture;$a++) {
$dat_culture = mysql_fetch_array($raw_culture);
if(isset($_POST['comments'.$dat_culture['ID']])) {

echo(function_action_editculture($dat_culture['ID'],$_POST['comments'.$dat_culture['ID']],$db_pref));


}
}



echo('<meta http-equiv="refresh" content="2;url=index.php">');

?>