<?
include('../connect.php');

if(!isset($_GET['ID'])) {
die('No modification ID set.');
}

$raw_natid = mysql_query('SELECT `NatID`,`Suggestion` FROM `'.$db_pref.'modifications` WHERE `ID` = \''.$_GET['ID'].'\'');
$dat_natid = mysql_fetch_array($raw_natid);
$raw_data = mysql_query('SELECT `Name`,`Full_name`,`Status`,`Language` FROM `'.$db_pref.'data` WHERE `NatID` = \''.$dat_natid['NatID'].'\'');
$dat_data = mysql_fetch_array($raw_data);

$sta1 = ''; $sta2 = '';
if($dat_data['Status']=='Alive') { $sta1 = 'checked="checked" '; } else { $sta2 = 'checked="checked" '; }

echo('<h1>Basic data easyfix</h1>
<form action="view_mod_easyfix_basic2.php" method="post">
<input type="hidden" name="NatID" value="'.$dat_natid['NatID'].'" />
Name: <input type="text" name="Name" value="'.$dat_data['Name'].'" /><br />
Full name: <input type="text" name="Full_name" value="'.$dat_data['Full_name'].'" /><br />
Status: <input type="radio" name="Status" value="Alive" '.$sta1.'/>Alive  | <input type="radio" name="Status" value="Dead" '.$sta2.'/> Dead<br />
Language: <input type="text" name="Language" value="'.$dat_data['Language'].'" /><br /><br />

<input type="submit" value="Edit this data" />
<br /><br />
Here is the modification suggestion:<br />
<table border="1">
<tr><td>
'.$dat_natid['Suggestion'].'
</td></tr>
</table>
');

?>