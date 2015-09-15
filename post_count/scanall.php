<?
include('../connect.php');
include('function.count.php');

$raw_fora = mysql_query('SELECT Forum, Type FROM '.$db_pre.'forums WHERE Forum_status = \'In use\'');
$num_fora = mysql_num_rows($raw_fora);

echo('<table border="1"><tr><td>ID</td><td>URL</td><td>Type</td><td>Post count?</td></tr>');
$success=0;

for($a=0;$a<$num_fora;$a++) {
$dat_fora = mysql_fetch_array($raw_fora);
$post_count = function_postcount($dat_fora['Forum'],$dat_fora['Type']);

echo('<tr>
<td>'.$a.'</td>
<td><a href="'.$dat_fora['Forum'].'">'.$dat_fora['Forum'].'</a></td>
<td>'.$dat_fora['Type'].'</td>
<td>');
print_r($post_count);
echo('</td>
</tr>');

if(is_numeric($post_count)) {
$success++;
}
}
echo('</table>');

echo('With '.$num_fora.' different fora in the test, this function managed to identify post counts in '.$success.' of them.. that&#39;s '.(($success/$num_fora)*100).'% of them :)?');


?>