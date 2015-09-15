Which forums should be brought back to life?<br />
<form action="action.revivenation3.php" method="post">
<?
include('../../connect.php');

$raw_fora = mysql_query('SELECT `ID`,`Forum` FROM `'.$db_pre.'forums` WHERE `NatID` = \''.$_POST['NatID'].'\'');
$num_fora = mysql_num_rows($raw_fora);
echo('<input type="hidden" name="NatID" value="'.$_POST['NatID'].'" />
<input type="hidden" name="Forums" value="'.$num_fora.'" />');

for($a=0;$a<$num_fora;$a++) {
$dat_fora = mysql_fetch_array($raw_fora);

echo('<input type="checkbox" name="Forum'.$a.'" value="'.$dat_fora['ID'].'" /> <a href="'.$dat_fora['Forum'].'">'.$dat_fora['Forum'].'</a><br />');

}
echo('<input type="submit" value="Revive the nation">
</form>');


?>