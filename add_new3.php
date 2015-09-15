<?include('header.php');?>
<h1>The System is adding your nation to the list.</h1>
<br />

<?
include('connect.php');

if(!isset($_POST['Name']) || !isset($_POST['Status'])) {
echo('Required data has not been entered.');
include('footer.php');
die();
}

//email admin
function_email("New Nation",$_POST,0,0);

//convert non latin characters
$_POST['Name'] = function_nonlatinconv('orig','html',$_POST['Name']);
$_POST['Full_name'] = function_nonlatinconv('orig','html',$_POST['Full_name']);

include('admin/actions/function.addnation.php');

function_action_addnation($_POST,$db_pre);
echo('<meta http-equiv="refresh" content="2;url=index.php">');

echo('<br />'.function_lang('ADDFORM_ADDED',$conf_lang,$db_pref));

include('footer.php');
?>