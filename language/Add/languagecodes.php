<?



function func_lang_name($code) {
$codes = explode("\n",str_replace(array('"',' "'),array('',''),file_get_contents('languagecodes.txt')));
$num_codes = count($codes);
$array = array();

for($a=0;$a<$num_codes;$a++) {
$explode = explode(' -',$codes[$a]);
$array[$explode[0]] = $explode[1];
}


$code = str_replace(' ','',$code);

if(isset($array[$code])) {
$name = $array[$code];
} else {
$name = '"'.$code.'"';
}

return $name;
}



?>