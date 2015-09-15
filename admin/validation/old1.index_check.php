<pre>

<?
include('../../connect.php');
$errors = 0;
$nations = mysql_num_rows(mysql_query('SELECT * FROM '.$db_pre.'data'));
$raw_start = mysql_query('SELECT * FROM '.$db_pre.'data');


//Loop begins
for($a=1;$a<=$nations;$a++) {
$start = mysql_fetch_array($raw_start);
$i = $start['NatID'];
$data = mysql_fetch_array(mysql_query("SELECT * FROM ".$db_pre."data WHERE NatID = ".$i.""));


//Step 1 (Check Forum count)
$forums = mysql_num_rows(mysql_query("SELECT * FROM ".$db_pre."forums WHERE NatID = ".$i.""));
if($data[Forums]!=$forums) { $errors++;
echo("Error ".$errors.": Wrong number of forums listed in data table for row ".$i.".\n"); }
unset($forums);


//Step 2 (Check Map count)
$maps = mysql_num_rows(mysql_query("SELECT * FROM ".$db_pre."maps WHERE NatID = ".$i.""));
if($data[Maps]!=$maps) { $errors++;
echo("Error ".$errors.": Wrong number of maps listed in data table for row ".$i.".\n"); }
unset($maps);


//Step 3 (Check Activity log count)
$logs = mysql_num_rows(mysql_query("SELECT * FROM ".$db_pre."activity WHERE NatID = ".$i.""));
if($data[Logs]!=$logs) { $errors++;
echo("Error ".$errors.": Wrong number of activity logs listed in data table for row ".$i.".\n"); }
unset($logs);


//Step 4 (Check Cultural items uploaded)
$folder_num = $i;
if($folder_num<10) { $folder_num = '0'.$folder_num; }
if($folder_num<100) { $folder_num = '0'.$folder_num; }
if($folder_num<1000) { $folder_num = '0'.$folder_num; }

$folder = opendir('../culture/'.$folder_num.'/');
$counter = 0;
while($file = readdir($folder)){
if($file != '.' && $file != '..'){
$counter++;
}}
closedir($folder);
$cultural_items = mysql_num_rows(mysql_query('SELECT * FROM '.$db_pre.'culture WHERE NatID = \''.$i.'\''));
if($counter!=$cultural_items) {$errors++;
echo("Error ".$errors.": Wrong number of cultural items listed in culture table for row ".$i.".\n"); }
unset($folder_num,$folder,$counter,$file,$cultural_items);


//Step 5 (Check cultural items count)
$culture_items = mysql_num_rows(mysql_query("SELECT * FROM ".$db_pre."culture WHERE NatID = ".$i.""));
if($data['Culture_items']!=$culture_items) { $errors++;
echo("Error ".$errors.": Wrong number of cultural items listed in data table for row ".$i.".\n"); }


//Step 6 (Check PPD record)
$last_month = mktime(0,0,0,(date(m)-1),1,date(y));
$blast_month = mktime(0,0,0,(date(m)-2),1,date(y));
$old_log = mysql_query("SELECT * FROM ".$db_pre."activity WHERE NatID = ".$i." AND Year = ".date(Y,$blast_month)." AND Month = ".date(m,$blast_month)."");
$old_logs = mysql_num_rows($old_log);
$new_log = mysql_query("SELECT * FROM ".$db_pre."activity WHERE NatID = ".$i." AND Year = ".date(Y,$last_month)." AND Month = ".date(m,$last_month)."");
$new_logs = mysql_num_rows($new_log);

$listed_PPD = mysql_fetch_array(mysql_query("SELECT PPD FROM ".$db_pre."data WHERE NatID = ".$i.""));

if($old_logs==1 && $new_logs==1) {
$old_log_data = mysql_fetch_array($old_log);
$new_log_data = mysql_fetch_array($new_log);

$PPD = (($new_log_data[Post_count] - $old_log_data[Post_count])/date(t,$last_month));

if(round($PPD,3)!=$listed_PPD[PPD]) {
$errors++;
echo("Error ".$errors.": Wrong PPD listed for row ".$i." in data table.\n");
}} else {
if($listed_PPD[PPD]!=-123456.789) {
$errors++;
echo("Error ".$errors.": PPD listed for row ".$i." in data table when activity logs were not made.\n");
}}
unset($last_month,$blast_month,$old_log,$old_logs,$new_log,$new_logs,$listed_PPD,$old_log_data,$new_log_data,$PPD);






//End loop
}

echo("\n\n\nIn total ".$errors." errors were found in the database.\n
<a href=index_fix.php>Click here to fix these problems</a>");

?>