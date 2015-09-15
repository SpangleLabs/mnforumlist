<?
$var_ig_get=1;
include('header.php');
include('connect.php');


/////////////////////////USING GET INFO
if($_GET['Status']=='Both') {
$sqladd_status = 'WHERE data.Deleted = \'0\' ';
} elseif($_GET['Status']=='Dead') {
$sqladd_status = 'WHERE data.Status = \'Dead\' AND data.Deleted = \'0\'';
} else {
$sqladd_status = 'WHERE data.Status = \'Alive\' AND data.Deleted = \'0\'';
}
if($_GET['H']==1) {
$sqladd_status = ' ';
}

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


/////////////////////////MAIN MYSQL
$sql_data = 'SELECT
data.NatID as NatID, 
data.Name as Name, 
data.Status as Status, 
data.FAOF as FAOF, 
data.Deleted as Deleted, 
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
 FROM `'.$db_pref.'data` data 
LEFT JOIN `'.$db_pref.'forums` forums ON forums.NatID = data.NatID 
LEFT JOIN `'.$db_pref.'culture` culture ON culture.NatID = data.NatID 
LEFT JOIN `'.$db_pref.'activity` logs ON logs.NatID = data.NatID 
LEFT JOIN `'.$db_pref.'flags` flags ON flags.ID = data.Flag_thumb
LEFT JOIN `'.$db_pref.'pronounce` pronounce ON pronounce.NatID = data.NatID 
LEFT JOIN `'.$db_pref.'activity` actold ON actold.ID = data.Act_IDOld 
LEFT JOIN `'.$db_pref.'activity` actnew ON actnew.ID = data.Act_IDNew 
 '.$sqladd_status.' GROUP BY data.NatID '.$sqladd_sort.';';
if($_GET['Josh']==1) {
echo($sql_data);
}

$raw_data = mysql_query($sql_data);
$num_data = mysql_num_rows($raw_data);
$raw_total_nations = mysql_query('SELECT `NatID` FROM `'.$db_pre.'data`');
$total_nations = mysql_num_rows($raw_total_nations);


/////////////////////////INTRO TEXT
echo(function_lang('INTRO_TEXT',$conf_lang,$db_pref,array($total_nations,$visits,$unique_visits)).'<br /><br />

'.function_lang('ALIVE_DEAD_BAR',$conf_lang,$db_pref).'
<br />');



/////////////////////////TABLE HEADERS
echo('
<table border="1">
<tr>
<td class="top"><a href="index.php?Sort=NatID">'.function_lang('COL_ID',$conf_lang,$db_pref).'</a></td>
<td class="top" colspan="2"><a href="index.php?Sort=Name">'.function_lang('COL_NAME',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="index.php?Sort=Status">'.function_lang('COL_STATUS',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="index.php?Sort=FAOF">'.function_lang('COL_FAOF',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="index.php?Sort=Forums">'.function_lang('COL_FORUMS',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="index.php?Sort=Culture_items">'.function_lang('COL_CULTURAL_ITEMS',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="index.php?Sort=Logs">'.function_lang('COL_ACTIVITY',$conf_lang,$db_pref).'</a></td>
<td class="top"><a href="index.php?Sort=PPD">'.function_lang('COL_PPD',$conf_lang,$db_pref).'</a></td>');
echo('</tr>');


/////////////////////////START TABLE CONTENTS
for($a=0;$a<$num_data;$a++) {
$dat_data = mysql_fetch_array($raw_data);

$col=$dat_data['Status']; //saves a bit of time with table row css

if($dat_data['FAOF']=="0") {
$dat_data['FAOF'] = "";
} else {
$dat_data['FAOF'] = date("d\/m\/Y",$dat_data['FAOF']);
}
if($dat_data['PPD']=='-123456.789') {
$dat_data['PPD'] = 0;
} else {
$dat_data['PPD'] = round($dat_data['PPD'],3);
}


/////////////////////////CONVERT MY DATESTAMPS INTO HUMAN READABLE ONES
$dat_data['Date_oldread'] = gmdate('d\/m\/Y',(($dat_data['Date_old']*86400)-719528*86400));
$dat_data['Date_newread'] = gmdate('d\/m\/Y',(($dat_data['Date_new']*86400)-719528*86400));
$date_monthago = floor(gmdate('Y')*365.2425)+gmdate('z')+1-31;
if($dat_data['Date_new']>=$date_monthago && $dat_data['Actold_ID']!=0) {
$PPD_text = '<abbr title="'.$dat_data['Post_change'].' posts between '.$dat_data['Date_oldread'].' and '.$dat_data['Date_newread'].'">'.$dat_data['PPD'].'</abbr>';
} else {
$PPD_text = '-';
}

/////////////////////////GET FLAG AND PRONOUNCIATION /////////////// NEEDS TO BE REMOVED!
if($dat_data['Flag_file']!='') {
$flag = '<img src="'.$dat_data['Flag_file'].'" alt="{FLAG}" /> ';
}/*
$raw_pronounce = mysql_query('SELECT `Sound_file` FROM `'.$db_pref.'pronounce` WHERE `NatID` = \''.$dat_data['NatID'].'\' AND `Name` = \'S\'');
$num_pronounce = mysql_num_rows($raw_pronounce);
if($num_pronounce==1) {
$dat_pronounce = mysql_fetch_array($raw_pronounce);
$pronounce = ' (pronounced ';
if($dat_pronounce['S']['Sound_file']!="-") {
$pronounce = function_play($dat_pronounce['Sound_file']);
}}*/
if($dat_data['Status']=='Alive') {
$dat_data['Status'] = function_lang('ADDFORM_STATUS_ALIVE',$conf_lang,$db_pref);
} else {
$dat_data['Status'] = function_lang('ADDFORM_STATUS_DEAD',$conf_lang,$db_pref);
}


/////////////////////////ECHO TABLE ROW INFOMATION
echo('<tr>
<td class="'.$col.'">'.$dat_data['NatID'].'</td>
<td class="'.$col.'">'.$flag.'</td>
<td class="'.$col.'"><a href="nation.php?ID='.$dat_data['NatID'].'">'.$dat_data['Name'].'</a>'.$pronounce.'</td>
<td class="'.$col.'">'.$dat_data['Status'].'</td>
<td class="'.$col.'">'.$dat_data['FAOF'].'</td>
<td class="'.$col.'"><a href="nation.php?ID='.$dat_data['NatID'].'#Forums">'.$dat_data['num_forums'].'</a></td>
<td class="'.$col.'"><a href="nation.php?ID='.$dat_data['NatID'].'#Culture">'.$dat_data['num_culture'].'</a></td>
<td class="'.$col.'"><a href="nation.php?ID='.$dat_data['NatID'].'#Activity">'.$dat_data['num_logs'].'</a></td>
<td class="'.$col.'">'.$PPD_text.'</td>');
echo('</tr>

');
unset($flag,$pronounce,$PPD_text);

}


/////////////////////////ENDING TEXT
echo('</table>
'.function_lang('ALIVE_DEAD_BAR',$conf_lang,$db_pref).'<br /><br />');


include('footer.php');
?>