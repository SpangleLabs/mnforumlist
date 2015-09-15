<?

function function_explode_first_num($string,$explosive) {

$explode = explode($explosive,$string);
$explode_parts = count($explode);

for($a=0;$a<$explode_parts;$a++) {

if(is_numeric(substr($explode[$a],0,1))) {
$explode_length = strlen($explode[$a]);
$post_count[$a] = substr($explode[$a],0,1);

for($b=1;$b<$explode_length;$b++) {
if(is_numeric(substr($explode[$a],$b,1))) {
$post_count[$a] = $post_count[$a].substr($explode[$a],$b,1);

} //End if statement checking if char is numeric
} //End $b loop
} //End if statement checking first char is numeric
} //End $a loop


return $post_count;
}


function function_unicount($url) {

$board_code = file_get_contents($url);
$board_code = strtolower($board_code);
$board_code = str_replace(',','',$board_code);
$board_code = str_replace(' ','',$board_code);
$board_code = str_replace("\n",'',$board_code);
$board_code = str_replace("\r",'',$board_code);
$board_code = str_replace("\t",'',$board_code);



$explode_post = explode('post',$board_code);
$parts_post = count($explode_post);
for($a=0;$a<$parts_post;$a++) {
$explode_post[$a] = substr($explode_post[$a],0,25);

$post_count[':'][$a] = function_explode_first_num($explode_post[$a],':');
$post_count['b'][$a] = function_explode_first_num($explode_post[$a],'<b>');
$post_count['strong'][$a] = function_explode_first_num($explode_post[$a],'<strong>');




} //ending loop $a


$post_count = array_merge(array_filter($post_count[':']),array_filter($post_count['b']),array_filter($post_count['strong']));


return $post_count['0']['1'];
}

include('../../connect.php');
$raw_fora = mysql_query('SELECT Forum FROM '.$db_pre.'forums WHERE Forum_status = \'In use\'');
$num_fora = mysql_num_rows($raw_fora);

echo('<table border="1"><tr><td>ID</td><td>URL</td><td>Post count?</td></tr>');
$success=0;

for($a=0;$a<$num_fora;$a++) {
$dat_fora = mysql_fetch_array($raw_fora);

echo('<tr><td>'.$a.'</td><td><a href="'.$dat_fora['Forum'].'">'.$dat_fora['Forum'].'</a></td><td>'.function_unicount($dat_fora['Forum']).'</td></tr>');

if(function_unicount($dat_fora['Forum'])!="") {
$success++;
}
}
echo('</table>');

echo('With '.$num_fora.' different fora in the test, this function managed to identify post counts in '.$success.' of them.. that&#39;s '.(($success/$num_fora)*100).'% of them :)?');





?>