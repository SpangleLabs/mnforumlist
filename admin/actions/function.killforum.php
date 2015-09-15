<?

function function_action_killforum($forumID,$db_pre) {

$raw_data = mysql_query('SELECT NatID, Forum_status FROM '.$db_pre.'forums WHERE ID = \''.$forumID.'\'');
$dat_data = mysql_fetch_array($raw_data);

if($dat_data['Forum_status']!="In use") {
$output = 'This forum is already dead.';
} else {
$raw_logs = mysql_query('SELECT Post_count FROM '.$db_pre.'activity_forums WHERE ForumID = \''.$forumID.'\' ORDER BY Year DESC, Month DESC');
$num_logs = mysql_num_rows($raw_logs);

$b=0;
for($a=0;$a<$num_logs;$a++) {
$dat_logs = mysql_fetch_array($raw_logs);
if(is_numeric($dat_logs['Post_count'])) {
$post_counts[$b] = $dat_logs['Post_count'];
$b++;
}}

if($b!=0) {
$output = 'The last post count for forum ID '.$forumID.' was '.$post_counts['0'].'. Status is being set to '.$post_counts['0'].' posts.';
mysql_query('UPDATE '.$db_pre.'forums SET Forum_status = \''.$post_counts['0'].' posts\' WHERE ID = \''.$forumID.'\'');

} else {
$output = 'There are no valid post counts for this forum (ID '.$forumID.'), dieing post count has been set to 0.';
mysql_query('UPDATE '.$db_pre.'forums SET Forum_status = \'0 posts\' WHERE ID = \''.$forumID.'\'');
}



}

return $output;
}


?>