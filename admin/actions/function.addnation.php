<?

function function_action_addnation($data,$db_pref) {
$raw_ID = mysql_query('SELECT `NatID` FROM `'.$db_pref.'data` ORDER BY `NatID` DESC LIMIT 1;');
$dat_ID = mysql_fetch_array($raw_ID);
$ID = $dat_ID['NatID']+1;

$FAOF = gmmktime(1,0,0,$data['FAOF_M'],$data['FAOF_D'],$data['FAOF_Y']);

mysql_query('INSERT INTO `'.$db_pref.'data` (`NatID`,`Name`,`Full_name`,`Status`,`FAOF`,`Language`,`PPD`)
VALUES (\''.$ID.'\',\''.$data['Name'].'\',\''.$data['Full_name'].'\',\''.$data['Status'].'\',\''.$FAOF.'\',\''.$data['Language'].'\',\'-123456.789\');');
$output = "Added the nation.";

for($a=0;$a<$data['Num_fora'];$a++) {

if(isset($data['Forum'.$a.'_address']) && isset($data['Forum'.$a.'_status']) && isset($data['Forum'.$a.'_type'])) {
mysql_query('INSERT INTO `'.$db_pref.'forums` (`NatID`,`Forum`,`Forum_status`,`Type`,`Type_Count`)
VALUES (\''.$ID.'\',\''.$data['Forum'.$a.'_address'].'\',\''.$data['Forum'.$a.'_status'].'\',\''.$data['Forum'.$a.'_type'].'\',\''.$data['Forum'.$a.'_type'].'\')');
$output .= "<br />Added a forum.";
$forums++;
}
}


for($a=0;$a<$data['Num_sites'];$a++) {
if(isset($data['Website'.$a.'_address']) && isset($data['Website'.$a.'_status']) && isset($data['Website'.$a.'_type']) && isset($data['Website'.$a.'_language'])) {
mysql_query('INSERT INTO `'.$db_pref.'websites` (`NatID`,`Address`,`Status`,`Type`,`Language`)
VALUES (\''.$ID.'\',\''.$data['Website'.$a.'_address'].'\',\''.$data['Website'.$a.'_status'].'\',\''.$data['Website'.$a.'_type'].'\',\''.$data['Website'.$a.'_language'].'\')');
$output .= "<br />Added a website.";
$websites++;
}
}

$folder_num = str_pad($ID,4,'0',STR_PAD_LEFT);
mkdir('/home/drspangl/public_html/Forumlist/flags/'.$folder_num);
$output .= "<br />Created the flags folder.";

mkdir('/home/drspangl/public_html/Forumlist/culture/'.$folder_num);
$output .= "<br />Created the cultural items folder.";

function_rssadd("NewNation",$db_pref,$ID,'http://mnforumlist.com/nation.php?ID='.$ID,' Their full name is '.$data['Full_name'].', their main language is '.$data['Language'].' and they have '.$data['Num_fora'].' fora and '.$data['Num_sites'].' websites. Their first web presence was on '.$data['FAOF_D'].'/'.$data['FAOF_M'].'/'.$data['FAOF_Y'].'.');

return $output;
}

?>