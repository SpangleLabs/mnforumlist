<?


echo('Please don&#39;t try and browse this folder yet, it&#39;s very basic, probably won&#39; ever work...');
$file = fopen("access.txt","a");
fwrite($file,date("H:i:s d/m/Y",(mktime()+7*3600))."\n".$_SERVER['REMOTE_ADDR']."\n\n");
fclose($file);


?>