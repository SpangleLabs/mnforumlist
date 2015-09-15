<?

function function_action_addwikiarticle($NatID,$WikiID,$Link,$Type,$Description,$db_pref) {

if($Type=="Main") {
$Description = '-';
}


$sql_addwikiarticle = 'INSERT INTO `'.$db_pref.'wikiarticles` (`NatID`,`WikiID`,`Link`,`Type`,`Description`) VALUES (\''.$NatID.'\',\''.$WikiID.'\',\''.$Link.'\',\''.$Type.'\',\''.$Description.'\')';
$raw_addwikiarticle = mysql_query($sql_addwikiarticle);

if($raw_addwikiarticle==1) {
$output = 'Wiki article has been added.';
} else {
$output = 'Wiki article could not be added';
}

return $output;
}

?>