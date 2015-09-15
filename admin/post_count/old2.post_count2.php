<pre>
<?
$conf_forum_logging = 1;
$conf_norma_logging = 1;

include('../../connect.php');


$time = mktime(date(H),date(i),date(s),date(m)-1,date(d),date(Y));
$year = date(Y,$time);
$month = date(m,$time);


$raw_forums = mysql_query('SELECT * FROM '.$db_pre.'forums');
$num_forums = mysql_num_rows($raw_forums);

for($a=1;$a<=$num_forums;$a++) {
$dat_forums = mysql_fetch_array($raw_forums);

if($dat_forums['Forum_status']=="In use") {
$array_posts[$dat_forums['ID']] = $_POST['Post_count_'.$dat_forums['ID']];
} elseif($dat_forums['Forum_status']=="Dead") {
$array_posts[$dat_forums['ID']] = 0;
} else {
$array_posts[$dat_forums['ID']] = str_replace(' posts','',$dat_forums['Forum_status']);
}

if($conf_forum_logging==1) {
if($dat_forums['Forum_status']=="In use") {
echo('INSERT INTO '.$db_pre.'activity_forums (NatID,ForumID,Year,Month,Post_count)
VALUES (\''.$dat_forums['NatID'].'\',\''.$dat_forums['ID'].'\',\''.$year.'\',\''.$month.'\',\''.$_POST['Post_count_'.$dat_forums['ID']].'\')');

mysql_query('INSERT INTO '.$db_pre.'activity_forums (NatID,ForumID,Year,Month,Post_count)
VALUES (\''.$dat_forums['NatID'].'\',\''.$dat_forums['ID'].'\',\''.$year.'\',\''.$month.'\',\''.$_POST['Post_count_'.$dat_forums['ID']].'\')');
$written++;
echo("\n\n");

}

}
}

$out_forums = $num_forums;

unset($raw_forums,$num_forums,$a,$dat_forums);


$raw_nations = mysql_query('SELECT * FROM '.$db_pre.'data');
$num_nations = mysql_num_rows($raw_nations);

for($b=1;$b<=$num_nations;$b++) {
$dat_nations = mysql_fetch_array($raw_nations);
$array_write[$dat_nations['NatID']] = 0;
$array_natposts[$dat_nations['NatID']] = 0;

$raw_nationfora = mysql_query('SELECT * FROM '.$db_pre.'forums WHERE NatID = \''.$dat_nations['NatID'].'\'');
$num_nationfora = mysql_num_rows($raw_nationfora);


for($c=1;$c<=$num_nationfora;$c++) {
$dat_nationfora = mysql_fetch_array($raw_nationfora);
if($dat_nationfora['Forum_status']=="In use") {
if($array_posts[$dat_nationfora['ID']]!="---") {
$array_write[$dat_nations['NatID']] = 1;
}}

$array_natposts[$dat_nations['NatID']] += $array_posts[$dat_nationfora['ID']];
}

if($array_write[$dat_nations['NatID']]==1) {

if($conf_norma_logging==1) {
echo('INSERT INTO '.$db_pre.'activity (NatID,Year,Month,Post_count)
VALUES (\''.$dat_nations['NatID'].'\',\''.$year.'\',\''.$month.'\',\''.$array_natposts[$dat_nations['NatID']].'\')');
//WRITE TO MYSQL DATABASE HERE.
mysql_query('INSERT INTO '.$db_pre.'activity (NatID,Year,Month,Post_count)
VALUES (\''.$dat_nations['NatID'].'\',\''.$year.'\',\''.$month.'\',\''.$array_natposts[$dat_nations['NatID']].'\')');
echo("\n\n");
$out_written++;
}

}

}

$out_nations = $num_nations;
unset($raw_nations,$num_nations,$dat_nations,$b,$raw_nationfora,$num_nationfora,$dat_nationfora,$c);


echo('Sending $_POST.'."\n");
print_r($_POST);
echo("\n\n\n".'Sending $array_posts.'."\n");
print_r($array_posts);
echo("\n\n\n".'Sending $array_natposts.'."\n");
print_r($array_natposts);
echo("\n\n\n".'Sending $array_write.'."\n");
print_r($array_write);


echo('

In total there were <b>'.$out_forums.'</b> forums, <b>'.$out_nations.'</b> nations and <b>'.$out_written.'</b> logs were made.');

?>
</pre>
<a href="index.php">click here to go back to the admin panel.</a>