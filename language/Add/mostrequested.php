<pre><?
include('../../connect.php');
include('languagecodes.php');

$sql_langrequests = 'SELECT `Code`,`Num` FROM `'.$db_pref.'lang_request`';
$raw_langrequests = mysql_query($sql_langrequests);
$num_langrequests = mysql_num_rows($raw_langrequests);
$arr_langrequested = array();
$arr_langrequestnum = array();
$arraynum = 0;
for($a=0;$a<$num_langrequests;$a++) {
$dat_langrequests = mysql_fetch_array($raw_langrequests);

$explode_lang = explode('-',$dat_langrequests['Code']);
$search_code = $explode_lang[0];
if(in_array($search_code,$arr_langrequested)) {
$arr_langrequestnum[$search_code] += $dat_langrequests['Num'];
} else {
$arr_langrequested[$arraynum] = $search_code;
$arr_langrequestnum[$search_code] = $dat_langrequests['Num'];
$arraynum++;
}
}


arsort($arr_langrequestnum);
echo('<table border="1">
<tr>
<td>Rank</td>
<td>Code</td>
<td>Requests</td>
</tr>');
for($a=0;$a<$arraynum;$a++) {
$tab_key = key($arr_langrequestnum);
echo('<tr>
<td>'.($a+1).'</td>
<td>'.func_lang_name($tab_key).'</td>
<td>'.$arr_langrequestnum[$tab_key].'</td>
</tr>');
array_shift($arr_langrequestnum);



}
echo('</table>');







?>