<?
include('header.php');
include('connect.php');

//////////////////////////////////////////////////INPUT CHECKING AND BASIC DATA REQUESTS//////////////////////////////////////////////////

//Check ID has been set.
if(!isset($_GET['ID'])) {
echo(function_lang('NO_NATID',$conf_lang,$db_pref));
include('footer.php');
die();
}

//Check ID is valid, and get nation data from database
$raw_data = mysql_query('SELECT `Name`, `Full_Name`, `Status`, `Language`, `Flag_main` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$_GET['ID'].'\'');
$num_data = mysql_num_rows($raw_data);
if($num_data!=1) {
echo('Invalid nation selected.');
include('footer.php');
die();
} else {
$dat_data = mysql_fetch_array($raw_data);
}
unset($raw_data,$num_data);

//////////////////////////////////////////////////FIND FLAG AND OUTPUT IT//////////////////////////////////////////////////

//Check for a flag and draw it.

if($dat_data['Flag_main']!='0') {
$raw_flag = mysql_query('SELECT `File_name`,`Length_X`,`Length_Y` FROM `'.$db_pref.'flags` WHERE `ID` = \''.$dat_data['Flag_main'].'\'');
$dat_flag = mysql_fetch_array($raw_flag);
$flag_X = 300;
$flag_Y = $dat_flag['Length_Y']/$dat_flag['Length_X']*$flag_X;
$flag = '<a class="image" href="flags.php?ID='.$_GET['ID'].'"><img class="Flag" src="'.$dat_flag['File_name'].'" alt="Main Flag" height="'.$flag_Y.'" width="'.$flag_X.'" /></a>';
} else {
$flag = function_lang('FLAG_UPLOAD',$conf_lang,$db_pref,array($_GET['ID']));
$raw_flags = mysql_query('SELECT `ID` FROM `'.$db_pref.'flags` WHERE `NatID` = \''.$_GET['ID'].'\'');
$num_flags = mysql_num_rows($raw_flags);
if($num_flags!=0) {
$flag .= function_lang('FLAG_SECONDARY',$conf_lang,$db_pref);
}}
unset($folder_num,$raw_flags,$num_flags);

//////////////////////////////////////////////////FIND PRONOUNCIATION GUIDES AND OUTPUT THEM//////////////////////////////////////////////////

$raw_pronounce['S'] = mysql_query('SELECT `IPA`,`Sound_file` FROM `'.$db_pref.'pronounce` WHERE `NatID` = \''.$_GET['ID'].'\' AND `Name` = \'S\'');
$num_pronounce['S'] = mysql_num_rows($raw_pronounce['S']);
if($num_pronounce['S']==1) {
$dat_pronounce['S'] = mysql_fetch_array($raw_pronounce['S']);
$pronounce['S'] = ' ('.function_lang('PRONOUNCED',$conf_lang,$db_pref).' ';
if($dat_pronounce['S']['IPA']!="-") {
$pronounce['S'] .= $dat_pronounce['S']['IPA'];
}
if($dat_pronounce['S']['Sound_file']!="-") {
$pronounce['S'] .= function_play($dat_pronounce['S']['Sound_file']);
}
$pronounce['S'] .= ' <a href="help.IPA.php">?</a>)';
}

$raw_pronounce['L'] = mysql_query('SELECT `IPA`,`Sound_file` FROM `'.$db_pref.'pronounce` WHERE `NatID` = \''.$_GET['ID'].'\' AND `Name` = \'L\'');
$num_pronounce['L'] = mysql_num_rows($raw_pronounce['L']);
if($num_pronounce['L']==1) {
$dat_pronounce['L'] = mysql_fetch_array($raw_pronounce['L']);
$pronounce['L'] = ' ('.function_lang('PRONOUNCED',$conf_lang,$db_pref).' ';
if($dat_pronounce['S']['IPA']!="-") {
$pronounce['L'] .= $dat_pronounce['L']['IPA'];
}
if($dat_pronounce['L']['Sound_file']!="-") {
$pronounce['L'] .= function_play($dat_pronounce['L']['Sound_file']);
}
$pronounce['L'] .= ' <a href="help.IPA.php">?</a>)';
}
unset($raw_pronounce,$num_pronounce,$dat_pronounce);

//////////////////////////////////////////////////BASIC INFORMATION, NAME ETC//////////////////////////////////////////////////
if($dat_data['Status']=="Alive") {
$dat_data['Status'] = function_lang('ADDFORM_STATUS_ALIVE',$conf_lang,$db_pref);
} else {
$dat_data['Status'] = function_lang('ADDFORM_STATUS_DEAD',$conf_lang,$db_pref);
}
echo('
<h1><a name="Basic">'.$dat_data[Name].'</a></h1>
'.$flag.'
<div id="info">
<b>'.function_lang('DATA_SHORTNAME',$conf_lang,$db_pref).':</b> '.$dat_data['Name'].$pronounce['S'].'<br />
<b>'.function_lang('DATA_LONGNAME',$conf_lang,$db_pref).':</b> '.$dat_data['Full_Name'].$pronounce['L'].'<br />
<b>'.function_lang('DATA_STATUS',$conf_lang,$db_pref).':</b> '.$dat_data['Status'].'<br />
<b>'.function_lang('DATA_LANGUAGE',$conf_lang,$db_pref).':</b> '.$dat_data['Language'].'<br />
<div class="mod">'.function_lang('CHANGE_BASIC',$conf_lang,$db_pref,array($_GET['ID'])).'</div><hr />');
unset($flag,$pronounce);

//////////////////////////////////////////////////DESCRIPTION//////////////////////////////////////////////////

echo('<h2><a name="Desc">'.function_lang('TITLE_DESC',$conf_lang,$db_pref).':</a></h2>');
$raw_description = mysql_query('SELECT `Desc`,`Name`,`Date` FROM `'.$db_pref.'descriptions` WHERE `NatID` = \''.$_GET['ID'].'\' ORDER BY `Date` DESC');
$num_description = mysql_num_rows($raw_description);
if($num_description!=0) {
$dat_description = mysql_fetch_array($raw_description);
echo('<table border="1"><tr><td>'.$dat_description['Desc'].'</td></tr></table><br /><br />
'.function_lang('LAST_UPDATED',$conf_lang,$db_pref).': '.date("d\/m\/Y",$dat_description['Date']).'<br />
'.function_lang('BY',$conf_lang,$db_pref).': '.$dat_description['Name'].'<br />
'.function_lang('DESC_TOTAL',$conf_lang,$db_pref,array($_GET['ID'],$num_description)).'<br />');
}
echo(function_lang('ADD_DESC',$conf_lang,$db_pref,array($_GET['ID'])).'<br /><hr />');
unset($raw_description,$num_description,$dat_description);

//////////////////////////////////////////////////FORUMS TABLE//////////////////////////////////////////////////


echo('<h2>'.function_lang('INFO_TITLE',$conf_lang,$db_pref).':</h2>
<h3><a name="Forums">'.function_lang('INFO_FORUMS',$conf_lang,$db_pref).':</a></h3>');
$raw_forums = mysql_query('SELECT `ID`, `Forum`, `Forum_status`, `Type` FROM `'.$db_pref.'forums` WHERE `NatID` = \''.$_GET['ID'].'\'');
$num_forums = mysql_num_rows($raw_forums);
if($num_forums==1) {
echo(function_lang('INFO_NUM_FORUM',$conf_lang,$db_pref,array($num_forums)));
} else {
echo(function_lang('INFO_NUM_FORA',$conf_lang,$db_pref,array($num_forums)));
}
if($num_forums!=0) {
echo('<br /><table border="1"><tr>
<td><b>'.function_lang('INFO_COL_URL',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_STATUS',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_TYPE',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_LOGS',$conf_lang,$db_pref).'</b></td>
</tr>');
for($a=0;$a<$num_forums;$a++) {
$dat_forums = mysql_fetch_array($raw_forums);
$raw_forumlogs = mysql_query('SELECT `ID` FROM `'.$db_pref.'activity_forums` WHERE `ForumID` = \''.$dat_forums['ID'].'\'');
$num_forumlogs = mysql_num_rows($raw_forumlogs);
echo('<tr>
<td><a href="'.function_spamstop($dat_forums['Forum']).'">'.function_spamstop($dat_forums['Forum']).'</a></td>
<td>'.$dat_forums['Forum_status'].'</td>
<td>'.$dat_forums['Type'].'</td>
<td><a href="forumlogs.php?ID='.$dat_forums['ID'].'">'.$num_forumlogs.'</a></td>
</tr>');
}
echo('</table>');
}
echo('<div class="mod">'.function_lang('CHANGE_FORUM',$conf_lang,$db_pref,array($_GET['ID'])).'</div>');
unset($raw_forums,$num_forums,$dat_forums,$raw_forumlogs,$num_forumlogs);


//////////////////////////////////////////////////WEBSITES TABLE//////////////////////////////////////////////////


echo('<h3><a name="Websites">'.function_lang('INFO_WEBSITES',$conf_lang,$db_pref).':</a></h3>');
$raw_websites = mysql_query('SELECT `ID`, `Address`, `Status`, `Type` FROM `'.$db_pref.'websites` WHERE `NatID` = \''.$_GET['ID'].'\'');
$num_websites = mysql_num_rows($raw_websites);
if($num_websites==1) {
echo(function_lang('INFO_NUM_WEBSITE',$conf_lang,$db_pref,array($num_websites)));
} else {
echo(function_lang('INFO_NUM_WEBSITES',$conf_lang,$db_pref,array($num_websites)));
}
if($num_websites!=0) {
echo('<table border="1"><tr>
<td><b>'.function_lang('INFO_COL_URL',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_STATUS',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_TYPE',$conf_lang,$db_pref).'</b></td>
</tr>');
for($a=0;$a<$num_websites;$a++) {
$dat_websites = mysql_fetch_array($raw_websites);
echo('<tr>
<td><a href="'.function_spamstop($dat_websites['Address']).'">'.function_spamstop($dat_websites['Address']).'</a></td>
<td>'.$dat_websites['Status'].'</td>
<td>'.$dat_websites['Type'].'</td>
</tr>');
}
echo('</table>');
}
echo('<div class="mod">'.function_lang('CHANGE_WEBSITES',$conf_lang,$db_pref,array($_GET['ID'])).'</div>');
unset($raw_websites,$num_websites,$dat_websites);


/////////////////////////////////////////////////WIKI ARTICLES TABLE//////////////////////////////////////////////////
$raw_wikis = mysql_query('SELECT `WikiID`,`Link`,`Type`,`Description` FROM `'.$db_pref.'wikiarticles` WHERE `NatID` = \''.$_GET['ID'].'\' ORDER BY `Type`,`WikiID`,`Description`');
$num_wikis = mysql_num_rows($raw_wikis);
echo('<h3><a name="Wikiarticles">'.function_lang('INFO_WIKIS',$conf_lang,$db_pref).':</a></h3>');
if($num_wikis==1) {
echo(function_lang('INFO_NUM_WIKIARTICLE',$conf_lang,$db_pref,array($num_wikis)));
} else {
echo(function_lang('INFO_NUM_WIKIARTICLES',$conf_lang,$db_pref,array($num_wikis)));
}
if($num_wikis!=0) {
echo('<table border="1"><tr>
<td><b>'.function_lang('INFO_COL_TYPE',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_WIKI',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_URL',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_DESC',$conf_lang,$db_pref).'</b></td>
</tr>');
for($a=0;$a<$num_wikis;$a++) {
$dat_wikis = mysql_fetch_array($raw_wikis);
$raw_wiki = mysql_query('SELECT `Name`,`Link` FROM `'.$db_pref.'wikis` WHERE `ID` = \''.$dat_wikis['WikiID'].'\'');
$dat_wiki = mysql_fetch_array($raw_wiki);
echo('<tr>
<td>'.$dat_wikis['Type'].'</td>
<td><a href="'.function_spamstop($dat_wiki['Link']).'">'.$dat_wiki['Name'].'</a></td>
<td><a href="'.function_spamstop($dat_wikis['Link']).'">'.function_spamstop($dat_wikis['Link']).'</a></td>
<td>'.$dat_wikis['Description'].'</td>
</tr>');
}
echo('</table><div class="mod">'.function_lang('CHANGE_WIKIS',$conf_lang,$db_pref,array($_GET['ID'])).'</div>');
}
unset($raw_wikis,$num_wikis);


/////////////////////////////////////////////////CULTURAL ITEMS TABLE//////////////////////////////////////////////////


echo('<h3><a name="Culture">'.function_lang('INFO_CULTURE',$conf_lang,$db_pref).':</a></h3>');
$raw_cultural = mysql_query('SELECT `File_name`, `Comment`, `File_size`, `Date_uploaded` FROM `'.$db_pref.'culture` WHERE `NatID` = \''.$_GET['ID'].'\'');
$num_cultural = mysql_num_rows($raw_cultural);
if($num_cultural==1) {
echo(function_lang('INFO_NUM_CULTURE',$conf_lang,$db_pref,array($num_cultural)));
} else {
echo(function_lang('INFO_NUM_CULTURES',$conf_lang,$db_pref,array($num_cultural)));
}
if($num_cultural!=0) {
$folder_num = str_pad($_GET['ID'],4,'0',STR_PAD_LEFT);
echo('<table border="1"><tr>
<td><b>'.function_lang('INFO_COL_NAME',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_DESC',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_SIZE',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_UPLOADED',$conf_lang,$db_pref).'</b></td>
</tr>');
for($a=0;$a<$num_cultural;$a++) {
$dat_cultural = mysql_fetch_array($raw_cultural);
$file_size = $dat_cultural['File_size'];
if($file_size>1048576) {
$file_size = round(($file_size/1048576),2).'MiB';
} elseif($file_size>1024) {
$file_size = round(($file_size/1024),2).'KiB';
} else {
$file_size = $file_size.'B';
}
echo('<tr>
<td><a href="culture/'.$folder_num.'/'.$dat_cultural['File_name'].'">'.$dat_cultural['File_name'].'</a></td>
<td>'.$dat_cultural['Comment'].'</td>
<td>'.$file_size.'</td>
<td>'.date('d/m/Y',$dat_cultural['Date_uploaded']).'</td>
</tr>');
}
echo('</table>');
}
echo('<div class="mod">'.function_lang('CHANGE_CULTURE',$conf_lang,$db_pref,array($_GET['ID'])).'</div>
<h3>'.function_lang('INFO_CULTURE_ADD',$conf_lang,$db_pref).':</h3>
<form action="upload_culture.php" method="post"
enctype="multipart/form-data"><div id="cultureupload">
'.function_lang('INFO_CULTURE_UPLOAD',$conf_lang,$db_pref).':<br />
<input type="file" name="file" id="file" /><br />
<textarea name="comments" rows="3" cols="50">'.function_lang('INFO_COMMENTS_HERE',$conf_lang,$db_pref).'</textarea><br />
<input type="hidden" name="NatID" value="'.$_GET[ID].'" />
<input type="submit" name="submit" value="'.function_lang('INFO_UPLOAD',$conf_lang,$db_pref).'" />
</div></form>
<hr />');

unset($raw_cultural,$num_cultural,$dat_cultural,$file_size);


/////////////////////////////////////////////////ACTIVITY TABLE AND GRAPH//////////////////////////////////////////////////


echo('<h2><a name="Activity">'.function_lang('INFO_ACTIVITY',$conf_lang,$db_pref).'</a></h2>');
$raw_activity = mysql_query('SELECT `Date`, `Post_count` FROM `'.$db_pref.'activity` WHERE `NatID` = \''.$_GET['ID'].'\' ORDER BY `Date` ASC');
$num_activity = mysql_num_rows($raw_activity);
if($num_activity==1) {
echo(function_lang('INFO_NUM_ACTIVITY',$conf_lang,$db_pref,array($num_activity)));
} else {
echo(function_lang('INFO_NUM_ACTIVITYS',$conf_lang,$db_pref,array($num_activity)));
}
if($num_activity!=0) {
$graph_URL='graph/line/graph.php?S=1&amp;DecolR=0&amp;DecolG=0&amp;DecolB=255&amp;Dedot=Cross';
$graph_days = 0;
$graph_count = 0;
$table_code = '<br /><table border="1"><tr>
<td><b>'.function_lang('INFO_COL_DATE',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_TOTPOSTS',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_NEWPOSTS',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_NEWDAYS',$conf_lang,$db_pref).'</b></td>
<td><b>'.function_lang('INFO_COL_NEWPPD',$conf_lang,$db_pref).'</b></td>
</tr>';
for($a=0;$a<$num_activity;$a++) {
$dat_activity = mysql_fetch_array($raw_activity);
$new_time = $dat_activity['Date'];
$date = gmdate('d\/m\/Y',(($dat_activity['Date']*86400)-719528*86400));
if($a==0) { $graph_URL .= '&amp;Startdate='.(($dat_activity['Date']*86400)-719528*86400); }
if(isset($old_count)) { $post_change = $dat_activity['Post_count']-$old_count; }
if(isset($old_time)) { $time_change = ($dat_activity['Date']-$old_time); }
if(isset($post_change) && isset($time_change)) { $PPD = round(($post_change/$time_change),3);
$graph_days += $time_change;
$graph_URL .= '&amp;Valx'.$graph_count.'='.$graph_days.'&amp;Valy'.$graph_count.'='.$PPD; 
$graph_count++; }
$table_code .= '<tr>
<td>'.$date.'</td>
<td>'.$dat_activity['Post_count'].'</td>
<td>'.$post_change.'</td>
<td>'.$time_change.'</td>
<td>'.$PPD.'</td>
</tr>';
unset($old_count,$old_time,$post_change,$time_change,$PPD);
$old_count = $dat_activity['Post_count'];
$old_time = $dat_activity['Date'];
}
echo('<img src="'.$graph_URL.'" alt="'.function_lang('INFO_ACT_GRAPH_ALT',$conf_lang,$db_pref,array($dat_data['Name'])).'" />');
echo($table_code.'</table>');
}
echo('<div class="mod">'.function_lang('CHANGE_ACTIVITY',$conf_lang,$db_pref,array($_GET['ID'])).'</div>');
unset($raw_activity,$num_activity,$dat_activity,$new_time,$old_count,$post_change,$old_time,$time_change,$old_time,$PPD,$graph_days,$graph_URL,$graph_count,$table_code);


/////////////////////////////////////////////////OLD AND BROKEN CODE//////////////////////////////////////////////////


//$forums = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."forums WHERE NatID = '".$_GET['ID']."'"));
//$websites = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."websites WHERE NatID = '".$_GET['ID']."'"));
////$maps = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."maps WHERE NatID = '".$_GET['ID']."'"));
//$logs = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."activity WHERE NatID = '".$_GET['ID']."'"));
//$cultures = mysql_num_rows(mysql_query("SELECT ID FROM ".$db_pre."culture WHERE NatID = '".$_GET['ID']."'"));
//$raw_latesttotal = mysql_query('SELECT `Total` FROM `'.$db_pre.'ratings` WHERE `NatID` = \''.$_GET['ID'].'\' ORDER BY `Date` DESC LIMIT 0,1');
//$dat_latesttotal = mysql_fetch_array($raw_latesttotal);
//$latest_rating = $dat_latesttotal['Total'];

//echo('Forums: <a href="forums.php?ID='.$_GET[ID].'">'.$forums.'</a><br />
//Websites: <a href="websites.php?ID='.$_GET[ID].'">'.$websites.'</a><br />');
//echo('Maps: <a href="maps.php?ID='.$_GET[ID].'">'.$maps.'</a><br />');
//echo('Activity Logs: <a href="activity.php?ID='.$_GET[ID].'">'.$logs.'</a><br />
//Cultural items: <a href="cultures.php?ID='.$_GET[ID].'">'.$cultures.'</a><br />
//OMRC Rating: <a href="rating.php?ID='.$_GET['ID'].'">'.$latest_rating.'</a><br />
//<hr />');

echo('</div><br /><div id="visits">'.function_lang('NUM_VISITS',$conf_lang,$db_pref,array($visits)).'</div>');

include('footer.php');
?>