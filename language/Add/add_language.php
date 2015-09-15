<?
include('../../connect.php');

echo('<form action="add_language2.php" method="post" accept-charset="UTF-8">
Notes:<br />
1)Leave the things inside &lt;&gt; tags and {} brackets the same, e.g. &lt;a href&gt;, &lt;br /&gt; and {INP1}<br />
2)"ForumList" is the name of the site, so I suppose it would translate like a brand name such as facebook<br />
3)"FOAF" stands for First Appeared On Forum, it&#39;s basically the foundation date by a smaller name, the INTRO_TEXT section has a section that explains what FOAF means<br />
4)"IDno" stands for "Identification number"<br />
5)"PPD" stands for "Posts Per day" the INTRO_TEXT section has a section that explains what PPD means<br />
6)Date format wants to be 2 letter Day, 2 letter Month, then 4 letter Year<br />
7)"by" is used for the description section, an example of it&39;s use is such: "This description was added on 21/05/2010 BY Martin Dettal"<br/>
8)"pronounced" is used for the pronouncation system, it basically has nation name then (PRONOUNCED {pronounciation guide})<br />
9)"Alive" and "Dead" are just expressions meaning active and inactive.<br />
10)"png, gif or jpeg" are image formats, I&#39;m reasonably certain they don&39;t translate<br />
11)"Dr-spangle" is a pseudonym, Dr might translate, but spangle does not.<br />

<br />
Language name: <input type="text" name="Name" /><br />
Password: <input type="password" name="Password" /><br />
<table border="1">
<tr>
<td>Text title</td>
<td width="300">English</td>
<td>Translation</td>
</tr>');

$sql_texts = 'SELECT `Text_Title`,`Text` FROM `'.$db_pref.'lang_text` WHERE `Language` = \'1\' AND `Text_Title` != \'BANNER_IMG\' ORDER BY `Text_Title`';
$raw_texts = mysql_query($sql_texts);
$num_texts = mysql_num_rows($raw_texts);
for($a=0;$a<$num_texts;$a++) {
$dat_texts = mysql_fetch_array($raw_texts);
$english = str_replace(array('&','<','>'),array('&amp;','&lt;','&gt;'),$dat_texts['Text']);
$englishtextbox = str_replace(array('&','<','>'),array('&amp;','&lt;','&gt;'),$dat_texts['Text']);
if($_GET['E']=='1') {
$englishtextbox = '';
}
echo('<input type="hidden" name="Text_Title'.$a.'" value="'.$dat_texts['Text_Title'].'" />');
echo('<tr>
<td>'.$dat_texts['Text_Title'].'</td>
<td>'.$english.'</td>
<td><textarea name="Text'.$a.'" rows="5" cols="50">'.$englishtextbox.'</textarea><br /></td>
</tr>');

}
echo('</table><br />
Translator: <input type="text" name="Translator" /><br />
<input type="submit" name="Sumbit" />');


?>