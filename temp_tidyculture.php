<pre>
<?

$max = 416;
for($a=1;$a<=$max;$a++) {

$dir = './flags/'.str_pad($a,4,'0',STR_PAD_LEFT).'/';
if(is_dir($dir)) {
$raw_files = scandir($dir);
$num_files = count($raw_files);
print_r($raw_files);
if($num_files==2) {
rmdir($dir);
}
}
}

?>