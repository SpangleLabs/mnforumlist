<pre>
<a href="../index.php">Click here</a> to go back to the admin panel</a><br />
<?
include('../../connect.php');
include('function.check_forumnumber.php');
include('function.check_mapnumber.php');
include('function.check_lognumber.php');
include('function.check_culturefolder.php');
include('function.check_culturenumber.php');
include('function.check_PPDrecord.php');
include('function.check_rating.php');
include('function.check_flags.php');
$raw_nations = mysql_query('SELECT NatID FROM '.$db_pre.'data');
$num_nations = mysql_num_rows($raw_nations);

for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);

echo(function_check_forumnumber($dat_nations['NatID'],$db_pre,1));
echo(function_check_mapnumber($dat_nations['NatID'],$db_pre,1));
echo(function_check_lognumber($dat_nations['NatID'],$db_pre,1));
echo(function_check_culturefolder($dat_nations['NatID'],$db_pre,1));
echo(function_check_culturenumber($dat_nations['NatID'],$db_pre,1));
echo(function_check_PPD($dat_nations['NatID'],$db_pre,1));
echo(function_check_rating($dat_nations['NatID'],$db_pre,1));
echo(function_check_flags($dat_nations['NatID'],$db_pre,1));


}

?>


<a href="index_check.php">Click here</a> to check for more problems

</pre>