<?

function function_newname($folder,$file) {

if(is_file($folder.$file)) {

$explode = explode('.',$file);
$parts = count($explode)-1;
$ext = array_pop($explode);

$filename = implode('.',$explode);

$a=1;
while (file_exists($folder.$filename.'.'.$a.'.'.$ext)) { $a++; }

$newfile = $folder.$filename.'.'.$a.'.'.$ext;

} else {
$newfile = $folder.$file;
}


return $newfile;
}


?>