<pre><?
include('../../connect.php');
include('function.revivenation.php');

for($a=0;$a<$_POST['Forums'];$a++) {
$forums[$a] = $_POST['Forum'.$a];
}

echo(function_action_revivenation($_POST['NatID'],$forums,$db_pre));

echo('<meta http-equiv="refresh" content="2;url=index.php">');

?></pre>