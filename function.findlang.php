<?

function function_findlang($IP,$db_pref) {

///////////////////////////////////CHECK IF THEY HAVE A DATABASE ENTRY ALREADY///////////////////////////////////
$sql_langIP = 'SELECT `Language` FROM `'.$db_pref.'lang_ip` WHERE `IP` = \''.$IP.'\'';
$raw_langIP = mysql_query($sql_langIP);
$num_langIP = mysql_num_rows($raw_langIP);
if($num_langIP==1) {
$dat_langIP = mysql_fetch_array($raw_langIP);
$language = $dat_langIP['Language'];
$sql_updatevisit = 'UPDATE `'.$db_pref.'lang_ip` SET `Last_Visit` = \''.gmmktime().'\' WHERE `IP` = \''.$IP.'\'';
$raw_updatevisit = mysql_query($sql_updatevisit);
} else {

///////////////////////////////////THEY DON'T HAVE A DATABASE ENTRY ALREADY///////////////////////////////////
$exp_lang = explode(',',str_replace(' ','',strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE'])));
$num_lang = count($exp_lang);

/////////////////////////LOOP THROUGH THE LANGUAGES THEY ACCEPT/////////////////////////
for($a=0;$a<$num_lang;$a++) {
$exp_exp_lang = explode(';',$exp_lang[$a]);
$sql_islang = 'SELECT `ID` FROM `'.$db_pref.'langs` WHERE `Code` = \''.$exp_exp_lang[0].'\'';
$raw_islang = mysql_query($sql_islang);
$num_islang = mysql_num_rows($raw_islang);

///////////////WE HAVE THIS LANGUAGE INSTALLED///////////////
if($num_islang==1) {

$dat_islang = mysql_fetch_array($raw_islang);
$language = $dat_islang['ID'];
$sql_addlangip = 'INSERT INTO `'.$db_pref.'lang_ip` (`IP`,`Language`,`Manual`,`Last_Change`,`Last_Visit`) VALUES (\''.$IP.'\',\''.$language.'\',\'N\',\''.gmmktime().'\',\''.gmmktime().'\')';
$raw_addlangip = mysql_query($sql_addlangip);
/////PUT ALL THEIR OTHER LANGUAGES IN AS REQUESTS/////
for($b=$a;$b<$num_lang;$b++) {
$exp_exp_lang = explode(';',$exp_lang[$a]);
$sql_islang = 'SELECT `ID` FROM `'.$db_pref.'langs` WHERE `Code` = \''.$exp_exp_lang[0].'\'';
$raw_islang = mysql_query($sql_islang);
$num_islang = mysql_num_rows($raw_islang);
if($num_islang==1) {
if($exp_exp_lang[0]!='') {
$raw_addlangrequest = 'INSERT INTO `'.$db_pref.'lang_request` (`Code`,`Date`,`IP`) VALUES (\''.$exp_exp_lang[0].'\',\''.gmmktime().'\',\''.$IP.'\')';
$sql_addlangrequest = mysql_query($raw_addlangrequest);
}}}
/////END PUTTING IN ALL OTHER LANGUAGES AS REQUESTS/////
$a = $num_lang;

///////////////WE DON'T HAVE THIS LANGUAGE INSTALLED///////////////
} else {

/////THE LANGUAGE THEY WANT, IT'S NOT BLANK IS IT?/////
if($exp_exp_lang[0]!='') {
$sql_addlangrequestgot = 'SELECT `ID`,`Num` FROM `'.$db_pref.'lang_request` WHERE `Code` = \''.$exp_exp_lang[0].'\'';
$raw_addlangrequestgot = mysql_query($sql_addlangrequestgot);
$num_addlangrequestgot = mysql_num_rows($raw_addlangrequestgot);
if($num_addlangrequestgot==0) {
$sql_addlangrequest = 'INSERT INTO `'.$db_pref.'lang_request` (`Code`,`Date`,`Num`) VALUES (\''.$exp_exp_lang[0].'\',\''.gmmktime().'\',\'1\')';
$raw_addlangrequest = mysql_query($sql_addlangrequest);
} else {
$dat_addlangrequestgot = mysql_fetch_array($raw_addlangrequestgot);
$sql_addlangrequest = 'UPDATE `'.$db_pref.'lang_reuest` SET `Num` = \''.($dat_addlangrequestgot['Num']+1).'\' WHERE `Code` = \''.$exp_exp_lang[0].'\'';
$raw_addlangrequest = mysql_query($sql_addlangrequest);
$sql_addlangrequest = 'UPDATE `'.$db_pref.'lang_request` SET `Date` = \''.gmmktime().'\'';
$raw_addlangrequest = mysql_query($sql_addlangrequest);
}
/////END BLANK CHECK/////
}

///////////////END LANGUAGE INSTALLED CHECK///////////////
}

/////////////////////////END LOOPING THROUGH ACCEPTABLE LANGUAGES/////////////////////////
}

///////////////////////////////////END IP DATABASE CHECK, THEY DON'T EVEN ACCEPT A LANGUAGE I HAVE INSTALLED///////////////////////////////////
}
if(!isset($language)) {
$language = 1;
}

///////////////////////////////////OUTPUT THE LANGUAGE CHOSEN FOR THEM///////////////////////////////////
return $language;
}


?>