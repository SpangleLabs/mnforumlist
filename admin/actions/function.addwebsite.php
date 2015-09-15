<?

function function_action_addwebsite($natID,$URL,$Status,$Type,$Language,$db_pre) {


mysql_query('INSERT INTO `'.$db_pre.'websites` (`NatID`,`Address`,`Status`,`Type`,`Language`) VALUES (\''.$natID.'\',\''.$URL.'\',\''.$Status.'\',\''.$Type.'\',\''.$Language.'\')');

$output = 'Website has been added to nation id '.$natID.'.';


return $output;
}

?>