<?
include('header.php');
include('connect.php');

echo('<div id="info">');

die('Sorry, but due to a security issue, the culture uploader will be disabled for a while.<br />');

$folder_num = str_pad($_POST['NatID'],4,'0',STR_PAD_LEFT);

if(!is_dir('culture/')) { mkdir('culture/'); }
if(!is_dir('culture/'.$folder_num)) { mkdir('culture/'.$folder_num); }


if ($_FILES['file']['error']>0) {
echo(function_lang('UPLOAD_ERROR',$conf_lang,$db_pref,array($_FILES['file']['error'],$_SERVER['HTTP_REFERER'])).'
</div>');
include('footer.php');
die();
}


if(function_whitelist($_FILES['file']['type'])==1) {
//START YES PART

if (file_exists('culture/'.$folder_num.'/'.$_FILES['file']['name'])) {
echo(function_lang('UPLOAD_ALREADYEXISTS',$conf_lang,$db_pref));

$future_file_name = function_newname('culture/'.$folder_num.'/',$_FILES['file']['name']);

} else {
$future_file_name = 'culture/'.$folder_num.'/'.$_FILES['file']['name'];
}

move_uploaded_file($_FILES['file']['tmp_name'],$future_file_name);
echo(function_lang('UPLOAD_FILESTORED',$conf_lang,$db_pref,array($future_file_name)));


mysql_query('INSERT INTO '.$db_pre.'culture (NatID,Date_uploaded,Comment,File_name,File_type,File_size)
VALUES (\''.$folder_num.'\',\''.mktime().'\',\''.$_POST['comments'].'\',\''.$_FILES['file']['name'].'\',
\''.$_FILES['file']['type'].'\',\''.$_FILES['file']['size'].'\')');

$natculture_items = mysql_num_rows(mysql_query('SELECT * FROM '.$db_pre.'culture WHERE NatID = \''.$folder_num.'\''));
mysql_query('UPDATE '.$db_pre.'data SET Culture_items = \''.$natculture_items.'\' WHERE NatID = \''.$folder_num.'\'');

function_email("Culture Uploaded",$_FILES,$nation_name['Name'],$folder_num);
function_rssadd("NewCulture",$db_pref,$_POST['NatID'],'http://mnforumlist.com/nation.php?ID='.$_POST['NatID'].'#Culture',' It is a '.$_FILES['file']['size'].'byte file called '.$_FILES['file']['name'].' the description is: "'.$_POST['comments'].'.');

//END YES PART
} else {

//START NO PART
echo(function_lang('UPLOAD_UNSAFE',$conf_lang,$db_pref,array($future_file_name)));

$nation_name = mysql_fetch_array(mysql_query('SELECT Name FROM '.$db_pre.'data WHERE NatID = \''.$folder_num.'\''));

function_email("Culture Upload Failed",$_FILES,$nation_name['Name'],$folder_num);
//END NO PART

}
echo('<br /><br />'.function_lang('UPLOAD_GOBACK',$conf_lang,$db_pref,array($_SERVER['HTTP_REFERER'])));


echo('</div>');


include('footer.php');
?>