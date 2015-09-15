<?
include('header.php');
include('config.php');

$raw_IDs = explode('-',$_GET['ID']);
$num_IDs = count($raw_IDs);
$wherelist = '';
$wheredata = '';
$wherenot = '';
for($a=0;$a<$num_IDs;$a++) {
if(!is_numeric($raw_IDs[$a])) {
echo('Invalid category.');
include('footer.php');
die();
} else {
if($a!=0) {
$wherelist .= ' OR ';
$wheredata .= ' OR ';
$wherenot .= ' AND ';
}
$wherelist .= 'tagged.Tag_ID = \''.$raw_IDs[$a].'\'';
$wheredata .= '`ID` = \''.$raw_IDs[$a].'\'';
$wherenot .= '`ID` != \''.$raw_IDs[$a].'\'';
}}


$sql_category = 'SELECT `ID`,`Name`,`Description` FROM `'.$db_pref.'tags_data` WHERE '.$wheredata;
$raw_category = mysql_query($sql_category);
$num_category = mysql_num_rows($raw_category);
if($num_category==0) {
echo(function_lang('CATEGORY_INVALID',$conf_lang,$db_pref));
include('footer.php');
die();
}

if($num_category==1) {
echo('<h1>'.function_lang('CATEGORY_SELECTED',$conf_lang,$db_pref,array($num_category)).'</h1><div id="info">');
} else {
echo('<h1>'.function_lang('CATEGORIES_SELECTED',$conf_lang,$db_pref,array($num_category)).'</h1><div id="info">');
}

for($a=0;$a<$num_category;$a++) {
$dat_category = mysql_fetch_array($raw_category);
$temp_array = $raw_IDs;
unset($temp_array[array_search($dat_category['ID'],$temp_array)]);
$new_IDs = implode('-',array_values($temp_array));
echo('<h2>'.$dat_category['Name'].'</h2>
<b>'.function_lang('CATEGORY_DESCRIBED_AS',$conf_lang,$db_pref).'</b>:<br />
'.$dat_category['Description'].'<br />');
if($num_category!=1) {
echo('<a href="page_category.php?ID='.$new_IDs.'">'.function_lang('CATEGORY_REMOVE',$conf_lang,$db_pref).'</a><br /><br />
');
}
}


if($num_category==1) {
echo('<h2>'.function_lang('CATEGORY_NATIONS',$conf_lang,$db_pref).'</h2>');
} else {
echo('<h2>'.function_lang('CATEGORIES_NATIONS',$conf_lang,$db_pref).'</h2>');
}
echo('<table border="1">
<tr>
<td class="top"><a href="page_category.php?ID='.$_GET['ID'].'&amp;Sort=NatID">'.function_lang('COL_ID',$conf_lang,$db_pref).'</a></td>
<td class="top" colspan="2"><a href="page_category.php?ID='.$_GET['ID'].'&amp;Sort=Name">'.function_lang('COL_NAME',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="page_category.php?ID='.$_GET['ID'].'&amp;Sort=Status">'.function_lang('COL_STATUS',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="page_category.php?ID='.$_GET['ID'].'&amp;Sort=FAOF">'.function_lang('COL_FAOF',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="page_category.php?ID='.$_GET['ID'].'&amp;Sort=Forums">'.function_lang('COL_FORUMS',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="page_category.php?ID='.$_GET['ID'].'&amp;Sort=Culture_items">'.function_lang('COL_CULTURAL_ITEMS',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="page_category.php?ID='.$_GET['ID'].'&amp;Sort=Logs">'.function_lang('COL_ACTIVITY',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="page_category.php?ID='.$_GET['ID'].'&amp;Sort=PPD">'.function_lang('COL_PPD',$conf_lang,$db_pref).'</a></td>
</tr>');

if($_GET['Sort']=='NatID') {
$sqladd_sort = 'ORDER BY NatID ASC ';
} elseif($_GET['Sort']=='Status') {
$sqladd_sort = 'ORDER BY Status ASC ';
} elseif($_GET['Sort']=='Forums') {
$sqladd_sort = 'ORDER BY num_forums DESC ';
} elseif($_GET['Sort']=='Culture_items') {
$sqladd_sort = 'ORDER BY num_culture DESC ';
} elseif($_GET['Sort']=='Logs') {
$sqladd_sort = 'ORDER BY num_logs DESC ';
} elseif($_GET['Sort']=='PPD') {
$sqladd_sort = 'ORDER BY PPD DESC ';
} else {
$sqladd_sort = 'ORDER BY Name ASC ';
}

$sql_currentnations = 'SELECT
data.NatID as NatID, 
data.Name as Name, 
data.Status as Status, 
data.FAOF as FAOF, 
flags.File_name as Flag_file, 
pronounce.Sound_file as Sound_file, 
COUNT(DISTINCT forums.ID) as num_forums, 
COUNT(DISTINCT culture.ID) as num_culture, 
COUNT(DISTINCT logs.ID) as num_logs, 
((actnew.Post_count-actold.Post_count)/(actnew.Date-actold.Date)) as PPD, 
(actnew.Post_count-actold.Post_count) as Post_change, 
actold.Date as Date_old, 
actnew.Date as Date_new, 
data.Act_IDOld as Actold_ID
 FROM `'.$db_pref.'tags_tagged` tagged
LEFT JOIN `'.$db_pref.'data` data ON data.NatID = tagged.NatID
LEFT JOIN `'.$db_pref.'forums` forums ON forums.NatID = tagged.NatID 
LEFT JOIN `'.$db_pref.'culture` culture ON culture.NatID = tagged.NatID 
LEFT JOIN `'.$db_pref.'activity` logs ON logs.NatID = tagged.NatID 
LEFT JOIN `'.$db_pref.'flags` flags ON flags.ID = data.Flag_thumb
LEFT JOIN `'.$db_pref.'pronounce` pronounce ON pronounce.NatID = tagged.NatID 
LEFT JOIN `'.$db_pref.'activity` actold ON actold.ID = data.Act_IDOld 
LEFT JOIN `'.$db_pref.'activity` actnew ON actnew.ID = data.Act_IDNew 
 WHERE '.$wherelist.' GROUP BY data.NatID '.$sqladd_sort.';';
$raw_currentnations = mysql_query($sql_currentnations);
$num_currentnations = mysql_num_rows($raw_currentnations);

for($a=0;$a<$num_currentnations;$a++) {
$dat_currentnations = mysql_fetch_array($raw_currentnations);
$col=$dat_currentnations['Status']; //saves a bit of time with table row css

if($dat_currentnations['FAOF']=="0") {
$dat_currentnations['FAOF'] = "";
} else {
$dat_currentnations['FAOF'] = date("d\/m\/Y",$dat_currentnations['FAOF']);
}
if($dat_currentnations['PPD']=='-123456.789') {
$dat_currentnations['PPD'] = 0;
} else {
$dat_currentnations['PPD'] = round($dat_currentnations['PPD'],3);
}

$dat_currentnations['Date_oldread'] = gmdate('d\/m\/Y',(($dat_currentnations['Date_old']*86400)-719528*86400));
$dat_currentnations['Date_newread'] = gmdate('d\/m\/Y',(($dat_currentnations['Date_new']*86400)-719528*86400));
$date_monthago = floor(gmdate('Y')*365.2425)+gmdate('z')+1-31;
if($dat_currentnations['Date_new']>=$date_monthago && $dat_currentnations['Actold_ID']!=0) {
$PPD_text = '<abbr title="'.$dat_currentnations['Post_change'].' posts between '.$dat_currentnations['Date_oldread'].' and '.$dat_currentnations['Date_newread'].'">'.$dat_currentnations['PPD'].'</abbr>';
} else {
$PPD_text = '-';
}

if($dat_currentnations['Flag_file']!='') {
$flag = '<img src="'.$dat_currentnations['Flag_file'].'" alt="{FLAG}" /> ';
}
if($dat_currentnations['Status']=='Alive') {
$dat_currentnations['Status'] = function_lang('ADDFORM_STATUS_ALIVE',$conf_lang,$db_pref);
} else {
$dat_currentnations['Status'] = function_lang('ADDFORM_STATUS_DEAD',$conf_lang,$db_pref);
}
echo('<tr>
<td class="'.$col.'">'.$dat_currentnations['NatID'].'</td>
<td class="'.$col.'">'.$flag.'</td>
<td class="'.$col.'"><a href="nation.php?ID='.$dat_currentnations['NatID'].'">'.$dat_currentnations['Name'].'</a></td>
<td class="'.$col.'">'.$dat_currentnations['Status'].'</td>
<td class="'.$col.'">'.$dat_currentnations['FAOF'].'</td>
<td class="'.$col.'"><a href="nation.php?ID='.$dat_currentnations['NatID'].'#Forums">'.$dat_currentnations['num_forums'].'</a></td>
<td class="'.$col.'"><a href="nation.php?ID='.$dat_currentnations['NatID'].'#Culture">'.$dat_currentnations['num_culture'].'</a></td>
<td class="'.$col.'"><a href="nation.php?ID='.$dat_currentnations['NatID'].'#Activity">'.$dat_currentnations['num_logs'].'</a></td>
<td class="'.$col.'">'.$PPD_text.'</td>');
echo('</tr>

');

unset($flag,$col,$PPD_text);
}


echo('</table>');

echo('<h2>'.function_lang('CATEGORY_ADD',$conf_lang,$db_pref).'</h2>');
$sql_othercategories = 'SELECT `ID`,`Name`,`Description` FROM `'.$db_pref.'tags_data` WHERE '.$wherenot;
$raw_othercategories = mysql_query($sql_othercategories);
$num_othercategories = mysql_num_rows($raw_othercategories);
for($a=0;$a<$num_othercategories;$a++) {
$dat_othercategories = mysql_fetch_array($raw_othercategories);
if($a!=0) {
echo(', ');
}
echo('<abbr title="'.$dat_othercategories['Description'].'"><a href="page_category.php?ID='.$_GET['ID'].'-'.$dat_othercategories['ID'].'">'.$dat_othercategories['Name'].'</a></abbr>');
}


echo('</div>');



include('footer.php');
?>