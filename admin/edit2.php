<pre>
<?
print_r($_POST);

include('../connect.php');

$raw_columns = mysql_query('SELECT * FROM '.$_POST['table'].'');
$num_columns = mysql_num_fields($raw_columns);

for($a=0;$a<$num_columns;$a++) {
$dat_columns = mysql_fetch_field($raw_columns);

if($dat_columns->primary_key==1) {
$column_primary_key = $dat_columns->name;
}
}


$data = mysql_query('SELECT * FROM '.$_POST['table'].' WHERE '.$column_primary_key.' = \''.$_POST['row'].'\'');

$columns = ((mysql_num_fields($data))-1);

for($i=1;$i<=$columns;$i++) {

mysql_query('UPDATE '.$_POST[table].' SET '.(mysql_field_name($data,$i)).' = \''.$_POST[(mysql_field_name($data,$i))].'\'
WHERE '.$column_primary_key.' = \''.$_POST[row].'\'');

}

echo('Completed successfully');

echo('<meta http-equiv="refresh" content="2;url=index.php">');

mysql_close($con);
?>