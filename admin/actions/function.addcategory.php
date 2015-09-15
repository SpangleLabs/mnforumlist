<?

function function_action_addcategory($name,$desc,$db_pref) {


$sql_addcategory = 'INSERT INTO `'.$db_pref.'tags_data` (`Name`,`Description`) VALUES (\''.$name.'\',\''.$desc.'\')';
$raw_addcategory = mysql_query($sql_addcategory);

if($raw_addcategory==1) {
$output = 'Category has been added.';
} else {
$output = 'Category could not be added';
}

return $output;
}

?>