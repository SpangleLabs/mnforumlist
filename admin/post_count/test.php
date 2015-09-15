<pre><?

include('../../connect.php');

mysql_query('INSERT INTO `MND_Manual_Gender` (`User_ID`,`Gender`) VALUES (\'1\',\'M\');');
$raw_last = mysql_query('SELECT LAST_INSERT_ID();');
$dat_last = mysql_fetch_array($raw_last);

print_r($dat_last);


?></pre>