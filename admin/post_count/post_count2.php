<pre>
<?
include('../../connect.php');
$conf_echo_sql = 1; //Echo every sql query?
$conf_logging = 1;  //Actually record sql queries?


$array_nation_posts = array(); //This will have the cumulative postcount of each nation, the number of each array element is the natid
$array_nation_logs = array();  //This will have a list of the nation IDs of all the micronations getting a new activity log.
$num_nation_logs = 0;
$array_nation_logged = array(); //This will have a list of the nations as they are logged
$num_nation_logged = 0;
$array_error_logs = array();   //This will have all the errors, with nation name, natid, forum id, forum link and error.
$num_error_logs = 0;
if($conf_echo_sql==1) {
$array_sql_logs = array();     //This will have all of the sql queries if $conf_echo_sql is set to 1.
$num_sql_logs = 0;
}


////////////////////////////////////////THIS SHALL PROCEED TO GO THROUGH ALL THE FORUM POST COUNTS AND RECORD THEM
////////////////////////////////////////IT WILL ALSO CREATE THE ENTRIES NEEDED FOR NATION RECORDS
$stop = 0;
$a = 0;
while($stop==0) {
//is all the posted data set for this value of $a?
if(isset($_POST['Forum_ID_'.$a]) && isset($_POST['Nation_ID_'.$a]) && isset($_POST['Post_count_'.$a])) {

$sql_insert_activityforums = 'INSERT INTO `'.$db_pref.'activity_forums` (`NatID`,`ForumID`,`Year`,`Month`,`Day`,`Post_count`)
 VALUES (\''.$_POST['Nation_ID_'.$a].'\',\''.$_POST['Forum_ID_'.$a].'\',\''.$_POST['Year'].'\',\''.$_POST['Month'].'\',\''.$_POST['Day'].'\',\''.$_POST['Post_count_'.$a].'\')';
if($conf_echo_sql==1) { //If echo sql queries is on, store it for echoing later.
$array_sql_logs[$num_sql_logs] = $sql_insert_activityforums;
$num_sql_logs++;
}
if($conf_logging==1) { //If logging is on, log it.
$raw_insert_activityforums = mysql_query($sql_insert_activityforums);
}

if(is_numeric($_POST['Post_count_'.$a])) {

//Add this log to the nation's total and record the nation as being logged.
$array_nation_logs[$num_nation_logs] = $_POST['Nation_ID_'.$a];
$array_nation_posts[$_POST['Nation_ID_'.$a]] += $_POST['Post_count_'.$a];
$num_nation_logs++;

} else {
//Post count isn't numeric. Record as an error.
$array_error_logs[$num_error_logs]['Error'] = $_POST['Post_count_'.$a];
$array_error_logs[$num_error_logs]['Nation_ID'] = $_POST['Nation_ID_'.$a];
$array_error_logs[$num_error_logs]['Nation_Name'] = $_POST['Nation_Name_'.$a];
$array_error_logs[$num_error_logs]['Forum_ID'] = $_POST['Forum_ID_'.$a];
$array_error_logs[$num_error_logs]['Forum_Link'] = $_POST['Forum_Link_'.$a];
$num_error_logs++;
}
} else {
//1 or more of the 3 posted pieces of data isn't set. end.
$stop = 1;
}
//add one to the increment.
$a++;
}

////////////////////////////////////////THIS WILL GO THROUGH AND MAKE THE NATION ACTIVITY LOGS
////////////////////////////////////////IT WILL OF COURSE ADD ON DEAD FORUMS POST COUNTS TO THE LOGS
////////////////////////////////////////IT WILL ALSO UPDATE THE MAIN PAGE LISTING TABLE
$var_date = floor($_POST['Year']*365.2425)+gmdate(z,gmmktime(1,0,0,$_POST['Month'],$_POST['Day'],$_POST['Year']))+1;
for($a=0;$a<$num_nation_logs;$a++) { //loop through all the nations that are listed as getting a new log.
if(in_array($array_nation_logs[$a],$array_nation_logged)) {
//We already logged this one.
} else {

$sql_dead_forums = 'SELECT `Forum_status` FROM `'.$db_pref.'forums` WHERE `NatID` = \''.$array_nation_logs[$a].'\' AND `Forum_status` <> \'In use\'';
$raw_dead_forums = mysql_query($sql_dead_forums); //Find all the dead forums
$num_dead_forums = mysql_num_rows($raw_dead_forums); //count them
for($b=0;$b<$num_dead_forums;$b++) { //Loop through the dead forums
$dat_dead_forums = mysql_fetch_array($raw_dead_forums); //Get the info about the dead forum
$var_dead_forum_posts = 0; //set the posts on the forum to zero, in case the last forum's posts are still set.
$var_dead_forum_posts = str_replace(' posts','',$dat_dead_forums['Forum_status']); //set the posts on the forum to whatever it was when it was recorded dead.
if(is_numeric($var_dead_forum_posts)) { //Is the forum posts actually a number?
$array_nation_posts[$array_nation_logs[$a]] += $var_dead_forum_posts;
}}

$sql_insert_activity = 'INSERT INTO `'.$db_pref.'activity` (`NatID`,`Year`,`Month`,`Day`,`Date`,`Post_count`) 
 VALUES (\''.$array_nation_logs[$a].'\',\''.$_POST['Year'].'\',\''.$_POST['Month'].'\',\''.$_POST['Day'].'\',\''.$var_date.'\',\''.$array_nation_posts[$array_nation_logs[$a]].'\')';
if($conf_echo_sql==1) {
$array_sql_logs[$num_sql_logs] = $sql_insert_activity;
$num_sql_logs++;
}
if($conf_logging==1) { //If logging is set to 1, record in activity table
$raw_insert_activity = mysql_query($sql_insert_activity); //recording in activity table
$raw_new_log = mysql_query('SELECT LAST_INSERT_ID()'); //finding the ID number of that last inserted row
$dat_new_log = mysql_fetch_array($raw_new_log);
$var_new_log = $dat_new_log['LAST_INSERT_ID()'];
$raw_old_log = mysql_query('SELECT `Act_IDNew` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$array_nation_logs[$a].'\'');
$dat_old_log = mysql_fetch_array($raw_old_log);
$var_old_log = $dat_old_log['Act_IDNew'];
$sql_update_data_old = 'UPDATE `'.$db_pref.'data` SET `Act_IDOld` = \''.$var_old_log.'\' WHERE `NatID` = \''.$array_nation_logs[$a].'\'';
$raw_update_data_old = mysql_query($sql_update_data_old);
$sql_update_data_new = 'UPDATE `'.$db_pref.'data` SET `Act_IDNew` = \''.$var_new_log.'\' WHERE `NatID` = \''.$array_nation_logs[$a].'\'';
$raw_update_data_new = mysql_query($sql_update_data_new);
if($conf_echo_sql==1) { //If sql echoing is on, record these 2 queries.
$array_sql_logs[$num_sql_logs] = $sql_update_data_old;
$num_sql_logs++;
$array_sql_logs[$num_sql_logs] = $sql_update_data_new;
$num_sql_logs++;
}}

$array_nation_logged[$num_nation_logged] = $array_nation_logs[$a];
$num_nation_logged++;
}}



////////////////////////////////////////NOW START ECHOING SOME SHIT.
if($conf_echo_sql==1) { //first echo the sql logs, if you made them.
echo('<h1>MYSQL Queries</h1><pre>');
for($a=0;$a<$num_sql_logs;$a++) {
echo($array_sql_logs[$a]."\n\n");
}
echo('</pre>');
}
echo('<h1>Error log</h1><pre>'); //now echo the error log.
for($a=0;$a<$num_error_logs;$a++) {
echo('Nation: '.$array_error_logs[$a]['Nation_Name'].' ('.$array_error_logs[$a]['Nation_ID'].')
Forum: '.$array_error_logs[$a]['Forum_Link'].' ('.$array_error_logs[$a]['Forum_ID'].')
Error: '.$array_error_logs[$a]['Error']."\n\n");
}
echo('</pre>');


echo('<br /><br /><br />
<hr /><br />
Thank you very much for doing the post count, I know it takes a lot of work, but I really appreciate it.<br />
Would you like to go back to the <a href="../index.php">admin panel</a> now?');


echo('<pre>');
print_r($_POST);
print_r($array_nation_posts);
print_r($array_nation_logs);
print_r($array_error_logs);
print_r($array_sql_logs);
print_r($array_nation_logged);

?>