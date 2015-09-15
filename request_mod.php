<?
include('header.php');
include('connect.php');

if(!isset($_GET['Type'])) {
echo(function_lang('REQUESTMOD_NOSELECT',$conf_lang,$db_pref));
include('footer.php');
die();
}


$raw_name = mysql_query('SELECT `Name` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$_GET['ID'].'\'');
$num_name = mysql_num_rows($raw_name);
if($num_name!=1) {
echo(function_lang('REQUESTMOD_INVALIDNAT',$conf_lang,$db_pref));
include('footer.php');
die();
}
$dat_name = mysql_fetch_array($raw_name);

echo('<h1>'.function_lang('REQUESTMOD_TITLE',$conf_lang,$db_pref,array($dat_name['Name'])).'</h1>

'.function_lang('REQUESTMOD_OLDDATA_TITLE',$conf_lang,$db_pref,array($dat_name['Name'])).'<br />
<table border="1"><tr><td>');

//////////////////////////////////////////////////TITLE DONE, STARTING DISPLAY OF OLD DATA//////////////////////////////////////////////////

if($_GET['Type']=="Basic_data") {
//////////////////////////////////////////////////OLD BASIC DATA DISPLAY//////////////////////////////////////////////////
$raw_data = mysql_query('SELECT `Name`,`Full_name`,`Status`,`Language` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$_GET['ID'].'\'');
$dat_data = mysql_fetch_array($raw_data);
echo('<b>'.function_lang('DATA_SHORTNAME',$conf_lang,$db_pref).':</b> '.$dat_data[Name].'<br />
<b>'.function_lang('DATA_LONGNAME',$conf_lang,$db_pref).':</b> '.$dat_data[Full_Name].'<br />
<b>'.function_lang('DATA_STATUS',$conf_lang,$db_pref).':</b> '.$dat_data[Status].'<br />
<b>'.function_lang('DATA_LANGUAGE',$conf_lang,$db_pref).':</b> '.$dat_data[Language].'');


} elseif($_GET['Type']=="Forums") {
//////////////////////////////////////////////////OLD FORUM DATA DISPLAY//////////////////////////////////////////////////
echo('<h3>'.function_lang('INFO_FORUMS',$conf_lang,$db_pref).':</h3>');
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


} elseif($_GET['Type']=="Websites") {
//////////////////////////////////////////////////OLD WEBSITE DATA DISPLAY//////////////////////////////////////////////////
echo('<h3>'.function_lang('INFO_WEBSITES',$conf_lang,$db_pref).':</h3>');
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

} elseif($_GET['Type']=="Wikis") {
//////////////////////////////////////////////////OLD WIKIS DATA DISPLAY//////////////////////////////////////////////////
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
echo('</table>');
}

unset($raw_wikis,$num_wikis);

} elseif($_GET['Type']=="Culture") {
//////////////////////////////////////////////////OLD CULTURAL ITEM DATA//////////////////////////////////////////////////
echo('<h3>'.function_lang('INFO_CULTURE',$conf_lang,$db_pref).':</h3>');
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

} elseif($_GET['Type']=="Activity") {
//////////////////////////////////////////////////OLD ACTIVITY DATA//////////////////////////////////////////////////
echo('<h2>'.function_lang('INFO_ACTIVITY',$conf_lang,$db_pref).'</h2>');
$raw_activity = mysql_query('SELECT `Year`, `Month`, `Day`, `Post_count` FROM `'.$db_pref.'activity` WHERE `NatID` = \''.$_GET['ID'].'\'');
$num_activity = mysql_num_rows($raw_activity);
if($num_activity==1) {
echo(function_lang('INFO_NUM_ACTIVITY',$conf_lang,$db_pref,array($num_activity)));
} else {
echo(function_lang('INFO_NUM_ACTIVITYS',$conf_lang,$db_pref,array($num_activity)));
}
if($num_activity!=0) {
$graph_URL='graph/line/graph.php?S=1&DecolR=0&DecolG=0&DecolB=255&Dedot=Cross';
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
$new_time = gmmktime(0,0,0,$dat_activity['Month'],$dat_activity['Day'],$dat_activity['Year']);
if(isset($old_count)) { $post_change = $dat_activity['Post_count']-$old_count; }
if(isset($old_time)) { $time_change = ($new_time-$old_time)/3600/24; }
if(isset($post_change) && isset($time_change)) { $PPD = round(($post_change/$time_change),3);
$graph_days += $time_change;
$graph_URL .= '&Valx'.$graph_count.'='.$graph_days.'&Valy'.$graph_count.'='.$PPD; 
$graph_count++; }
$table_code .= '<tr>
<td>'.str_pad($dat_activity['Day'],2,0,STR_PAD_LEFT).'/'.str_pad($dat_activity['Month'],2,0,STR_PAD_LEFT).'/'.str_pad($dat_activity['Year'],4,0,STR_PAD_LEFT).'</td>
<td>'.$dat_activity['Post_count'].'</td>
<td>'.$post_change.'</td>
<td>'.$time_change.'</td>
<td>'.$PPD.'</td>
</tr>';
unset($old_count,$old_time,$post_change,$time_change,$PPD);
$old_count = $dat_activity['Post_count'];
$old_time = $new_time;
}
echo('<img src="'.$graph_URL.'" alt="'.function_lang('INFO_ACT_GRAPH_ALT',$conf_lang,$db_pref,array($dat_data['Name'])).'" />');
echo($table_code.'</table>');
}

} else {
echo(function_lang('REQUESTMOD_NODATA',$conf_lang,$db_pref).'</td></tr></table>');
include('footer.php');
die();
}


echo('</td></tr></table>
'.function_lang('REQUESTMOD_HOWCHANGE',$conf_lang,$db_pref).'
<form action="request_mod2.php" method="post">');
require_once('recaptchalib.php');
$publickey = "6Ldj_7sSAAAAAB3JtyCKphu4Kogn8YeeYWZXINyp"; // you got this from the signup page
echo recaptcha_get_html($publickey);
echo('<input type="hidden" name="NatID" value="'.$_GET['ID'].'" />
<input type="hidden" name="Type" value="'.$_GET['Type'].'" />
<textarea name="Desc" rows="15" cols="70">'.function_lang('REQUESTMOD_DESCRIBEMOD',$conf_lang,$db_pref).'</textarea><br />
'.function_lang('REQUESTMOD_NAME',$conf_lang,$db_pref).': <input type="text" name="Name" />'.function_lang('REQUESTMOD_NAME_NOTE',$conf_lang,$db_pref).'<br />
<input type="submit" value="'.function_lang('REQUESTMOD_SUBMIT',$conf_lang,$db_pref).'" />
</form>
');




include('footer.php');
?>