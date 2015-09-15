<h1>Welcome to the Forumlist rating panel</h1>

<a href="add_rating.php">Click here</a> to add a new national rating.<br /><br />

<?
include('../connect.php');
$raw_requests = mysql_query('SELECT `ID` FROM `'.$db_pre.'rating_request` WHERE `Fixed` = \'N\'');
$num_requests = mysql_num_rows($raw_requests);

echo('There are <b>'.$num_requests.'</b> requests for new ratings.<br />
<a href="view_requests.php">Click here</a> to view them.');




?>