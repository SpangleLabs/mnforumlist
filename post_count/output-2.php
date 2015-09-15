<?
include('function.count.php');
include('../connect.php');

$sql_forum = 'SELECT `Forum_Count`,`Type_Count` FROM `'.$db_pref.'forums` WHERE `ID` = \''.$_GET['FID'].'\'';
$raw_forum = mysql_query($sql_forum);
$dat_forum = mysql_fetch_array($raw_forum);
$_GET['Url'] = $dat_forum['Forum_Count'];
$_GET['Type'] = $dat_forum['Type_Count'];
echo('URL: '.$_GET['Url'].'<br />
Type: '.$_GET['Type'].'<br /><br />');

if(substr($_GET['Url'],0,7)!="http://") {
$_GET['Url'] = "http://".$_GET['Url'];
}



if($_GET['Type']=="Other") {
echo('This system doesn&#39;t support that forumtype yet, but I&#39;ve written the URL to a file and will look at it later to see how I can make it work.');
$file = fopen("other.txt","a");
fwrite($file,date("H:i:s d/m/Y",(mktime()+7*3600))."\n".$_GET['Url']."\n\n");
fclose($file);


} else {

$post_count = function_postcount($_GET['Url'],$_GET['Type']);
echo('Is the post count '.$post_count.'?');

if($post_count!="0" && ($post_count/2)=="0") {
echo('<br /><br />Ah... It appears it didn&#39;t return a number... I&#39;ll write that URL to a file and see what went wrong and try and fix it.');
$file = fopen("error.txt","a");
fwrite($file,date("H:i:s d/m/Y",mktime())."\n".$_GET['Url']."\n".$post_count."\n\n");
fclose($file);

} else {
$file = fopen("success.txt","a");
fwrite($file,date("H:i:s d/m/Y",mktime())."\n".$_GET['Url']."\n".$post_count."\n\n");
fclose($file);

}
}
?>