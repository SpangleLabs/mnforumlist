<?
include('../connect.php');

$raw_wikis = mysql_query('SELECT `ID`,`NatID`,`Link`,`WikiID`,`Type` FROM `'.$db_pref.'wikiarticles` ORDER BY `ID`');
$num_wikis = mysql_num_rows($raw_wikis);

for($a=0;$a<$num_wikis;$a++) {
$dat_wikis = mysql_fetch_array($raw_wikis);
$raw_wikiinfo = mysql_query('SELECT `First_Bit`,`Last_Bit` FROM `'.$db_pref.'wikis` WHERE `ID` = \''.$dat_wikis['WikiID'].'\'');
$dat_wikiinfo = mysql_fetch_array($raw_wikiinfo);
$dat_wikis['Type'] = '';

echo($dat_wikis['Link'].'&action=edit    - -    /saved/'.$dat_wikis['Type'].'/'.str_pad($dat_wikis['NatID'],4,'0',STR_PAD_LEFT).'-'.str_pad($dat_wikis['WikiID'],4,'0',STR_PAD_LEFT).'-'.str_pad($dat_wikis['ID'],4,'0',STR_PAD_LEFT).'.txt<br />');

$editpage = $dat_wikis['Link'].'&action=edit';

if(!is_dir('saved/')) { mkdir('saved/'); }
if(!is_dir('saved/'.$dat_wikis['Type'])) { mkdir('saved/'.$dat_wikis['Type']); }
if(!is_dir('saved/'.$dat_wikis['Type'].'/'.date('Y').'-'.date('m').'-'.date('d').'/')) { mkdir('saved/'.$dat_wikis['Type'].'/'.date('Y').'-'.date('m').'-'.date('d').'/'); }


$savelocation = 'saved/'.$dat_wikis['Type'].'/'.date('Y').'-'.date('m').'-'.date('d').'/'.str_pad($dat_wikis['NatID'],4,'0',STR_PAD_LEFT).'-'.str_pad($dat_wikis['WikiID'],4,'0',STR_PAD_LEFT).'-'.str_pad($dat_wikis['ID'],4,'0',STR_PAD_LEFT).'.txt';
$wiki_article = file_get_contents($editpage);
$wiki_article_bits = explode($dat_wikiinfo['First_Bit'],$wiki_article);
$wiki_article = $wiki_article_bits[1];
$wiki_article_bits = explode($dat_wikiinfo['Last_Bit'],$wiki_article);
$wiki_article = $wiki_article_bits[0];

$file = fopen($savelocation,"w");
echo fwrite($file,$wiki_article);
fclose($file);



}





?>