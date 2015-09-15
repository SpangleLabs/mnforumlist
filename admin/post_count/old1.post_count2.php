<pre>

<?
include('../../connect.php');
print_r($_POST);

$forum_data = mysql_query("SELECT * FROM ".$db_pre."forums ORDER BY ID");
$num_forums = mysql_num_rows($forum_data);


$nations = mysql_num_rows(mysql_query("SELECT * FROM ".$db_pre."data"));

for($h=1;$h<=$nations;$h++) {
$array[$h] = 0;
$array2[$h] = "dead";
$array3[$h] = "";
}


for($i=1;$i<=$num_forums;$i++) {
$fora_data = mysql_fetch_array($forum_data);

if($_POST['Post_count_'.$i]=="---") {
$array3[$fora_data[NatID]] = "nocount";
}

if(isset($_POST['Post_count_'.$i])) {
$array[$fora_data[NatID]] += $_POST['Post_count_'.$i];
}

if($fora_data[Forum_status]=="In use") {
$array2[$fora_data[NatID]] = "live";
} else {
$post_count = str_replace(' posts','',$fora_data[Forum_status]);
$array[$fora_data[NatID]] += $post_count;
}}

print_r($array);
print_r($array2);
print_r($array3);



$last_month = mktime(0,0,0,(date(m)-1),1,(date(Y)));
$blast_month = mktime(0,0,0,(date(m)-2),1,(date(Y)));
echo('last month:'.date(d,$last_month).'/'.date(m,$last_month).'/'.date(Y,$last_month).'<br />
before last month:'.date(d,$blast_month).'/'.date(m,$blast_month).'/'.date(Y,$blast_month).'
<br /><br />');

$addlogs = count($array);
for($j=1;$j<=$addlogs;$j++) {
if($array2[$j]=="live") {
echo("living, ");
if($array3[$j]!="nocount") {
echo("breathing, ");


//add rows to the activity logs table
$totallogs = mysql_num_rows(mysql_query("SELECT * FROM ".$db_pre."activity"));
$varyear = date(Y,$last_month);
$varmonth = date(m,$last_month);
mysql_query("INSERT INTO ".$db_pre."activity (NatID,Year,Month,Post_count)
VALUES ('$j','$varyear','$varmonth','$array[$j]')");


$old_log = mysql_query("SELECT * FROM ".$db_pre."activity WHERE Year = ".date(Y,$blast_month)." AND Month = ".date(m,$blast_month)." AND NatID = ".$j."");
$old_logs = mysql_num_rows($old_log);
$old_log_data = mysql_fetch_array($old_log);
echo("(".$old_logs.")");

$data_logs = mysql_num_rows(mysql_query("SELECT Logs FROM ".$db_pre."data WHERE NatID = '$j'"))+1;
mysql_query("UPDATE ".$db_pre."data SET Logs = '$data_logs'
WHERE NatID = '".$j."'");

if($old_logs=="1") {
//old logs exist, set PPD.
echo("Alive!<br />");

$PPD = (($array[$j]-$old_log_data[Post_count])/date(t,$last_month));

mysql_query("UPDATE ".$db_pre."data SET PPD = '".$PPD."'
WHERE NatID = '".$j."'");


} else {
//there are no old logs, set PPD as blank.
echo("but dead.<br />");
mysql_query("UPDATE ".$db_pre."data SET PPD = '-123456.789'
WHERE NatID = '".$j."'");
}} else {
//no post count, set PPD as blank.
echo("No breath.<br />");
mysql_query("UPDATE ".$db_pre."data SET PPD = '-123456.789'
WHERE NatID = '".$j."'");
}} else {
//nation is dead, set PPD as blank.
echo("Dead.<br />");
mysql_query("UPDATE ".$db_pre."data SET PPD = '-123456.789'
WHERE NatID = '".$j."'");
}}









?>

<a href="index.php">click here to go back to the admin panel.</a>