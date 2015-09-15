<?
include('../../connect.php');

$date = gmdate('Y-m-d');
if(!is_dir('../../saved_forums')) { mkdir('../../saved_forums'); }
if(!is_dir('../../saved_forums/nations')) { mkdir('../../saved_forums/nations'); }
if(!is_dir('../../saved_forums/nations/'.$date)) { mkdir('../../saved_forums/nations/'.$date); }

$raw_natforums = mysql_query("SELECT ID, NatID, Forum, Type FROM ".$db_pre."forums WHERE Forum_status = 'In use' ORDER BY ID");
$num_natforums = mysql_num_rows($raw_natforums);

for($a=0;$a<$num_natforums;$a++) {
$dat_natforums = mysql_fetch_array($raw_natforums);
$dir_num = str_pad($dat_natforums['ID'],4,'0',STR_PAD_LEFT);
//if(!is_dir('../../saved_forums/nations/'.$date.'/'.$dir_num)) { mkdir('../../saved_forums/nations/'.$date.'/'.$dir_num); }

$board_code = file_get_contents($dat_natforums['Forum']);
file_put_contents('../../saved_forums/nations/'.$date.'/'.$dir_num.'.html',$board_code);
echo('Saved national forum number '.$dat_natforums['ID'].'. (type: '.$dat_natforums['Type'].' | url: '.$dat_natforums['Forum'].' ) <br />'."\n");
}

exec('tar -czf ../../saved_forums/nations/'.$date.'.tar.gz ../../saved_forums/nations/'.$date.'/');
exec('rm -r ../../saved_forums/nations/'.$date.'/');

?>