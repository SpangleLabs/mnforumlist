<?

function function_check_culturefolder($id,$db_pre,$fix) {

$folder_id = str_pad($id,4,'0',STR_PAD_LEFT);
if(is_dir('../../culture/'.$folder_id.'/')) {

$dat_nation = mysql_fetch_array(mysql_query('SELECT Culture_items FROM '.$db_pre.'data WHERE NatID = \''.$id.'\''));

$folder = opendir('../../culture/'.$folder_id.'/');
$num_culture = 0;
while($file = readdir($folder)){
if($file != '.' && $file != '..'){
$num_culture++;
}}
closedir($folder);

if($num_culture!=$dat_nation['Culture_items']) {
$output = 'Error : Wrong number of cultural items listed in culture table for row '.$id.".\n";

if($fix==1) {
$folder = opendir('../../culture/'.$folder_id.'/');
$num_culture = 0;
while($file = readdir($folder)){
if($file != '.' && $file != '..'){
$in_database = mysql_num_rows(mysql_query('SELECT ID FROM '.$db_pre.'culture WHERE NatID = \''.$id.'\' AND File_name = \''.$file.'\''));
if($in_database==0) {
$file_name = '../../culture/'.$folder_id.'/'.$file;
mysql_query('INSERT INTO '.$db_pre.' (NatID, Date_uploaded, File_name, File_type, File_size) VALUES (\''.$id.'\',\''.filectime($file_name).'\',\''.$file.'\',\''.mime_content_type($file_name).'\',\''.filesize($file_name).'\')');
}}}
closedir($folder);


$output .= 'New files have been added to the database.'."\n";
} else { $output .= "\n"; }

}

} else {
//Folder doesn't exist

$output = 'Error : Cultural folder does not exist.'."\n";

if($fix==1) {
mkdir('../../culture/'.$folder_id.'/');

$folder = opendir('../../culture/'.$folder_id.'/');
$num_culture = 0;
while($file = readdir($folder)){
if($file != '.' && $file != '..'){
$in_database = mysql_num_rows(mysql_query('SELECT ID FROM '.$db_pre.'culture WHERE NatID = \''.$id.'\' AND File_name = \''.$file.'\''));
if($in_database==0) {
$file_name = '../../culture/'.$folder_id.'/'.$file;
mysql_query('INSERT INTO '.$db_pre.' (NatID, Date_uploaded, File_name, File_type, File_size) VALUES (\''.$id.'\',\''.filectime($file_name).'\',\''.$file.'\',\''.mime_content_type($file_name).'\',\''.filesize($file_name).'\')');
}}}
closedir($folder);

$output .= 'Folder has been created and any files have been added to the database.'."\n";


} else {
$output .= "\n";
}

}

return $output;
}






?>