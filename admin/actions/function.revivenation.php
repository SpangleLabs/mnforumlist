<?
include('../../connect.php');

function function_action_revivenation($natid,$forums,$db_pre) {

mysql_query('UPDATE `'.$db_pre.'data` SET `Status` = \'Alive\' WHERE `NatID` = \''.$natid.'\'');

$num_forums = count($forums);
for($a=0;$a<$num_forums;$a++) {
mysql_query('UPDATE `'.$db_pre.'forums` SET `Forum_status` = \'In use\' WHERE `ID` = \''.$forums[$a].'\'');

}

$suffix = 'um';
if($num_forums==1) { $suffix = 'a'; }

return('Nation '.$natid.' is now alive, along with it&#039;s '.$num_forums.' for'.$suffix);
}

?>