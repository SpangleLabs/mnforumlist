<?
header('Content-type: application/rss+xml');
include('connect.php');

echo('<?xml version="1.0"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>ForumList Updates</title>
    <link>http://mnforumlist.com/</link>
    <description>This channel should contain all updates for the forumlist.</description>
    <atom:link href="http://mnforumlist.com/updatesrss.php" rel="self" type="application/rss+xml" />');

$raw_updates = mysql_query('SELECT `ID`,`Date`,`Title`,`Link`,`Description` FROM `'.$db_pref.'updates` ORDER BY `Date` DESC LIMIT 0,30');
$num_updates = mysql_num_rows($raw_updates);

for($a=0;$a<$num_updates;$a++) {
$dat_updates = mysql_fetch_array($raw_updates);

echo('
    <item>
       <title>'.$dat_updates['Title'].'</title>
       <link>'.$dat_updates['Link'].'</link>
       <guid isPermaLink="false">update '.$dat_updates['ID'].' on http://mnforumlist.com</guid>
       <description>'.$dat_updates['Description'].'</description>
       <pubDate>'.gmdate("D, d M Y H:i:s",$dat_updates['Date']).' GMT</pubDate>
    </item>');
}

echo('
  </channel>
</rss>');


?>