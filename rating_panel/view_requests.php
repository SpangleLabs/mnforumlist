<?
include('../connect.php');

$raw_requests = mysql_query('SELECT `ID`, `NatID`, `Reason`, `Date` FROM `'.$db_pre.'rating_request` WHERE `Fixed` = \'N\'');
$num_requests = mysql_num_rows($raw_requests);
echo('There are '.$num_requests.' requests for new ratings, Click the name to add a new rating.
<table border="1">
<tr>
<td>Nation</td>
<td>Reason</td>
<td>Date submitted</td>
<td>Delete rating</td>
</tr>');

for($a=0;$a<$num_requests;$a++) {
$dat_requests = mysql_fetch_array($raw_requests);

$raw_nation = mysql_query('SELECT `Name` FROM `'.$db_pre.'data` WHERE `NatID` = \''.$dat_requests['NatID'].'\'');
$dat_nation = mysql_fetch_array($raw_nation);

echo('<tr>
<td><a href="add_rating2.php?ID='.$dat_requests['NatID'].'">'.$dat_nation['Name'].'</a></td>
<td>'.str_replace("\n",'<br />',$dat_requests['Reason']).'</td>
<td>'.date('d/m/Y',$dat_requests['Date']).'</td>
<td><a href="delete_rating.php?ID='.$dat_requests['ID'].'">Click here</a></td>
</tr>');

}
echo('</table>');



?>