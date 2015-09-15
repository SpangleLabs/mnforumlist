<?
include('../connect.php');

$raw_nation = mysql_query('SELECT `Name` FROM `'.$db_pre.'data` WHERE `NatID` = \''.$_GET['ID'].'\'');
$dat_nation = mysql_fetch_array($raw_nation);

echo('You have chosen to add a new rating to <a href="../nation.php?ID='.$_GET['ID'].'" target="_blank">'.$dat_nation['Name'].'</a>.<br />');

$raw_ratings = mysql_query('SELECT `ID`, `Date` FROM `'.$db_pre.'ratings` WHERE `NatID` = \''.$_GET['ID'].'\' ORDER BY `Date` DESC');
$num_ratings = mysql_num_rows($raw_ratings);
$dat_ratings = mysql_fetch_array($raw_ratings);

echo('This nation has '.$num_ratings.' recorded ratings. It was last rated on '.date('d/m/Y',$dat_ratings['Date']).'.<br /><br />One decimal place only please. all ratings should be between 0 and 1.<br />');

$raw_last_rating = mysql_query('SELECT `Activity`, `History-Language-Sport`, `Economics-Military`, `Geography-Culture`, `Imagination-Realism` FROM `'.$db_pre.'ratings` WHERE `NatID` = \''.$_GET['ID'].'\' ORDER BY `Date` DESC');
$dat_last_rating = mysql_fetch_array($raw_last_rating);


echo('<form action="add_rating3.php" method="post">
<input type="hidden" name="NatID" value="'.$_GET['ID'].'" />
<table border="1">
<tr>
<td>Category</td>
<td>Last rating</td>
<td>New rating</td>
</tr>
<tr>
<td>Activity</td>
<td>'.$dat_last_rating['Activity'].'</td>
<td><input type="text" name="Activity" value="'.$dat_last_rating['Activity'].'" /></td>
</tr>
<tr>
<td>History/Language/Sport</td>
<td>'.$dat_last_rating['History-Language-Sport'].'</td>
<td><input type="text" name="History-Language-Sport" value="'.$dat_last_rating['History-Language-Sport'].'" /></td>
</tr>
<tr>
<td>Economics/Military</td>
<td>'.$dat_last_rating['Economics-Military'].'</td>
<td><input type="text" name="Economics-Military" value="'.$dat_last_rating['Economics-Military'].'" /></td>
</tr>
<tr>
<td>Geography/Culture</td>
<td>'.$dat_last_rating['Geography-Culture'].'</td>
<td><input type="text" name="Geography-Culture" value="'.$dat_last_rating['Geography-Culture'].'" /></td>
</tr>
<tr>
<td>Imagination/Realism</td>
<td>'.$dat_last_rating['Imagination-Realism'].'</td>
<td><input type="text" name="Imagination-Realism" value="'.$dat_last_rating['Imagination-Realism'].'" /></td>
</tr>


</table>
<input type="submit" value="Add a new rating" />
</form>');



?>