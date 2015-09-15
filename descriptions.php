<?
include('header.php');
include('connect.php');

if(!isset($_GET['ID'])) {
echo(function_lang('NO_NATID',$conf_lang,$db_pref));
include('footer.php');
die();
}

$raw_name = mysql_query('SELECT `Name` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$_GET['ID'].'\'');
$dat_name = mysql_fetch_array($raw_name);


$raw_descriptions = mysql_query('SELECT `Desc`,`Name`,`Date` FROM `'.$db_pref.'descriptions` WHERE `NatID` = \''.$_GET['ID'].'\' ORDER BY `Date` DESC');
$num_descriptions = mysql_num_rows($raw_descriptions);

echo('<h1>'.function_lang('DESC_TITLE',$conf_lang,$db_pref,array($_GET['ID'],$dat_name['Name'])).'</h1>
<table border="1">');
for($a=0;$a<$num_descriptions;$a++) {
$dat_descriptions = mysql_fetch_array($raw_descriptions);

echo('<tr>
<td>'.function_lang('INFO_COL_NAME',$conf_lang,$db_pref).': '.$dat_descriptions['Name'].'</td>
<td>'.function_lang('INFO_COL_DATE',$conf_lang,$db_pref).': '.date("d\/m\/Y",$dat_descriptions['Date']).'</td>
</tr><tr>
<td colspan="2">'.$dat_descriptions['Desc'].'</td>
</tr>');

if($a!=($num_descriptions-1)) {
echo('<tr><td colspan="3"><hr /></td></tr>');
}

}
echo('</table>');

include('footer.php');
?>