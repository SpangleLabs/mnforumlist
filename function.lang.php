<?

function function_lang($text,$lang,$db_pref,$inputs=0) {
$sql_lang = 'SELECT `ID`,`Text`,`Used` FROM `'.$db_pref.'lang_text` WHERE `Text_Title` = \''.$text.'\' AND `Language` = \''.$lang.'\' ORDER BY `ID` DESC';
$raw_lang = mysql_query($sql_lang); //FIND THE LUMP OF TEXT THEY ASKED FOR
$num_lang = mysql_num_rows($raw_lang);
if($num_lang>=1) { //WE HAVE AN ENTRY FOR THAT LUMP OF TEXT
$dat_lang = mysql_fetch_array($raw_lang);
$output = $dat_lang['Text'];
$sql_adduse = 'UPDATE `'.$db_pref.'lang_text` SET `Used` = \''.($dat_lang['Used']+1).'\' WHERE `ID` = \''.$dat_lang['ID'].'\'';
$raw_adduse = mysql_query($sql_adduse); //RECORD THAT YOU'VE USED THAT LUMP OF TEXT

if(is_array($inputs)) { //IF THEY HAVE GIVEN INPUTS...
$num_inputs = count($inputs);
for($a=0;$a<$num_inputs;$a++) {
$output = str_replace('{INP'.($a+1).'}',$inputs[$a],$output); //...REPLACE THE INPUT BOXES WITH THE INPUTS THEY GAVE
}}

} else { //WE DON'T HAVE THAT LUMP OF TEXT :/
$output = '{'.$text.'}'; //OUTPUT SOMETHING
$sql_islang = 'SELECT `Name` FROM `'.$db_pref.'langs` WHERE `ID` = \''.$lang.'\'';
$raw_islang = mysql_query($sql_islang);
$num_islang = mysql_num_rows($raw_islang); //CHECK IF IT'S A LANGUAGE
if($num_islang!=0) {
$raw_langs = mysql_query('SELECT `ID` FROM `'.$db_pref.'langs` ORDER BY `ID`');
$num_langs = mysql_num_rows($raw_langs); //FIND ALL THE LANGUAGES INSTALLED
for($a=0;$a<$num_langs;$a++) { //LOOP THROUGH ALL THE LANGUAGES
$dat_langs = mysql_fetch_array($raw_langs);
$raw_notext = mysql_query('SELECT `ID` FROM `'.$db_pref.'lang_text` WHERE `Language` = \''.$dat_langs['ID'].'\' AND `Text_Title` = \''.$text.'\'');
$num_notext = mysql_num_rows($raw_notext); //SEE IF EACH LANGUAGE HAS THAT TEXT LUMP
if($num_notext==0) {
$sql_addtextrequest = 'INSERT INTO `'.$db_pref.'lang_request_text` (`Language`,`Text`,`Date`) VALUES (\''.$dat_langs['ID'].'\',\''.$text.'\',\''.gmmktime().'\')';
$raw_addtextrequest = mysql_query($sql_addtextrequest); //REQUEST THE TEXT BE ADDED FOR EACH LANGUAGE THAT LACKS THE LUMP OF TEXT
} //END NOTEXT CHECK
} //END FOR LOOP GOING THROUGH ALL LANGUAGES
} //END QUESTION OF IF IT'S A LANUAGE
if($text=='BANNER_IMG') { //IF THEY DON'T HAVE A NATIVE BANNER IMAGE, GIVE THEM THE ENGLISH ONE
$output = 'header-english.png';
}
}

return $output;
}

?>