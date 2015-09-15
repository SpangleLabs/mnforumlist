<?
include('header.php');
include('connect.php');

if(!isset($_GET[ID])) {
echo('No nation selected.');
include('footer.php');
die();
}

$raw_ratings = mysql_query('SELECT `Activity`, `History-Language-Sport`, `Economics-Military`, `Geography-Culture`, `Imagination-Realism`, `Total`, `Date` FROM `'.$db_pre.'ratings` WHERE `NatID` = \''.$_GET['ID'].'\' ORDER BY `Date` DESC');
$num_ratings = mysql_num_rows($raw_ratings);

if($num_ratings==1) {
$num = "once";
} elseif($num_ratings==2) {
$num = "twice";
} else {
$num = $num_ratings." times";
}

$raw_nation = mysql_query('SELECT `Name` FROM `'.$db_pre.'data` WHERE `NatID` = \''.$_GET['ID'].'\'');
$dat_nation = mysql_fetch_array($raw_nation);
$raw_latesttotal = mysql_query('SELECT `Total` FROM `'.$db_pre.'ratings` WHERE `NatID` = \''.$_GET['ID'].'\' ORDER BY `Date` DESC LIMIT 0,1');
$dat_latesttotal = mysql_fetch_array($raw_latesttotal);

echo('This nation, <a href="nation.php?ID='.$_GET['ID'].'">'.$dat_nation['Name'].'</a>, has been rated '.$num.'.<br />
The most recent rating rates them as being '.$dat_latesttotal['Total'].'/5
<table border="1">
<tr>
<td>Date</td>
<td>Activity</td>
<td>History-Language-Sport</td>
<td>Economics/Military</td>
<td>Geography/Culture</td>
<td>Imagination/Realism</td>
<td>Total</td>
</tr>');

for($a=0;$a<$num_ratings;$a++) {
$dat_ratings = mysql_fetch_array($raw_ratings);
echo('<tr>
<td>'.date("d/m/Y",$dat_ratings['Date']).'</td>
<td>'.$dat_ratings['Activity'].'</td>
<td>'.$dat_ratings['History-Language-Sport'].'</td>
<td>'.$dat_ratings['Economics-Military'].'</td>
<td>'.$dat_ratings['Geography-Culture'].'</td>
<td>'.$dat_ratings['Imagination-Realism'].'</td>
<td><b>'.$dat_ratings['Total'].'</b></td>
</tr>');



}
echo('</table><br /><br />
The rating image for this nation is:<br />
<img src="images/rating/image.php?ID='.$_GET['ID'].'" alt="Rating for nation ID '.$_GET['ID'].'" /><br />
the html code for this is: <br /><input type="text" name="html" value="<img src=&#34;http://mnforumlist.com/images/rating/'.$_GET['ID'].'.png&#34;>" size="60" /><br />
the BBCode (Forum code) for this is: <br /><input type="text" name="html" value="[img]http://mnforumlist.com/images/rating/'.$_GET['ID'].'.png[/img]" size="60" /><br />


<br /><br />
If you do not think this nation was rated fairly, or would like to request a new rating please use this form below:
<form action="rating_request.php" method="post">
<input type="hidden" name="NatID" value="'.$_GET['ID'].'" />
<textarea name="Reason" rows="3" cols="50">Reason for request:
</textarea><br />
<input type="submit" value="Submit" />
</form>');

include('footer.php');
?>