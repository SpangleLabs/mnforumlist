<?


function function_postcount($url,$type) {
if(substr($url,0,7)!="http://") { $url .= "http://"; }
$type = strtolower($type);

$array_pattern['proboards']    = '/TotalPosts:(.[^<]*)<br\/>LastUpdatedTopic:/';
$array_pattern['phpbb2']       = '/Ourusershavepostedatotalof<b>(.[^<]*)<\/b>articles<br\/>Wehave/';
$array_pattern['phpbb2-french']= '/<p><strong>(.[^<]*)<\/strong>message/';
$array_pattern['phpbb2-dutch'] = '/berichten:<strong>(.[^<]*)<\/strong>/';
$array_pattern['invision']     = '/Ourmembershavemadeatotalof<b>(.[^<]*)<\/b>posts<br\/>Wehave/';
$array_pattern['smf']          = '/<tdnowrap="nowrap">TotalPosts:<\/td><tdalign="right">(.[^<]*)<\/td><\/tr><tr><tdnowrap="nowrap">TotalTopics:<\/td>/';
$array_pattern['phpbb3']       = '/Totalposts<strong>(.[^>]*)<\/strong>/';
$array_pattern['phpbb3-dutch'] = '/<p>Totaalaantalberichten<strong>(.[^>]*)<\/strong>/';
$array_pattern['zetaboards']   = '/<td>TotalForumPosts:<strong>(.[^>]*)<\/strong>/';
$array_pattern['excoboard']    = '/Atotalof<b>(.[^<]*)<\/b>/';
$array_pattern['yuku']         = '/Totalviews<\/li><liclass="odd">(.[^T]*)Totalposts<\/li>/';
$array_pattern['aceboard']     = '/Members<br\/>(.[^p]*)postsontheboard/';
$array_pattern['mybb']         = '/Ourmembershavemadeatotalof(.[^p]*)postsin/';
$array_pattern['mybb-russ']    = file_get_contents('/home/drspangl/public_html/Forumlist/post_count/inc_filter_mybb-russ.txt');
$array_pattern['yahoo group']  = '/<thclass="month">De(c|z)<\/th><\/tr>(.*)<\/table>/';
$array_pattern['google group'] = '/<b>Discussions<\/b><\/a><imgwidth="10"height="1"alt=""src="\/groups\/img\/dot_clear.gif"><spanstyle="color:#333">(.[^o]*)of(.[^m]*)messages<\/span>/';

if($type!="smf") {
if(!isset($array_pattern[$type])) {
$post_count = "Unknown type";
} else {
$board_code = @file_get_contents($url);
}}

///////////////////////////////////////////////////////////////////////
//Error Handling
if($type=="proboards") {
$proboards_code = file_get_contents('http://www.proboards.com');
if($proboards_code==$board_code) {
$post_count = "Board deleted";
}}

if($type=="invision") {
if(substr($board_code,0,33)=='<b>404:</b> Board Does Not Exist.') {
$post_count = "Board deleted";
}}

if($type=="smf") {
if(substr($url,-1)=="/") { $board_code = @file_get_contents($url.'index.php?action=stats'); }
elseif(substr($url,-10)=="/index.php") { $board_code = @file_get_contents($url.'?action=stats'); }
elseif(substr($url,-11)=="/index.php?") { $board_code = @file_get_contents($url.'action=stats'); }
elseif(substr($url,-12)=="action=forum") { $board_code = @file_get_contents(substr($url,0,-12).'action=stats'); }
else { $post_count = 'Link incorrect'; }
}


///////////////////////////////////////////////////////////////////////

if(!isset($post_count)) {
$board_code = str_replace(" ","",$board_code);
$board_code = str_replace("\n","",$board_code);
$board_code = str_replace("\r","",$board_code);
$board_code = str_replace("\t","",$board_code);
if($type=='mybb-russ') { $board_code = urlencode($board_code); }
$test = preg_match($array_pattern[$type],$board_code,$post_found);
//echo($board_code.'ghgh'.$test.'fdfd.');

if($type=='yahoo group') {
$post_found['1'] = $post_found['2'];
$post_found['1'] = preg_replace('/<thclass="year">(\d+)<\/th>/U','',$post_found['1']);
$boardnamelinkexp = explode('/',$url);
$boardnamelink = '\/group\/'.$boardnamelinkexp[4].'\/messages\/';
$post_found['1'] = preg_replace('/<ahref="'.$boardnamelink.'(\d+)">/U','',$post_found['1']);
$array_remove = array('</a>','</tr>','<tr>','</td>');
$post_found['1'] = str_replace($array_remove,'',$post_found['1']);
$post_found['1'] = explode('<td>',$post_found['1']);
$post_count = array_sum($post_found['1']);
} else {

if($type=='google group') {
$post_count = str_replace(array('.',','),array('',''),$post_found['2']);
} else {
$post_count = str_replace(array('.',','),array('',''),$post_found['1']);
}

}

}

if(strlen($post_count)>15) {
$post_count = "Error";
}

if($type=='register') {
$post_count = "Registration required.";
}
return $post_count;
}

?>