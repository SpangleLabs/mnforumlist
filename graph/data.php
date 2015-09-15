<?

//$data_labs = array('Jan08','Feb08','Mar08','Apr08','May08');

$a=0;
while(isset($_GET['Lab'.$a])) {
$data_labs[$a] = $_GET['Lab'.$a];
$a++;
}

$a=0;
while(isset($_GET['Name'.$a])) {
$data_name[$a] = $_GET['Name'.$a];
$data_dots[$a] = $_GET['Dots'.$a];
$data_lcol[$a] = array($_GET['Lcol'.$a.'R'],$_GET['Lcol'.$a.'G'],$_GET['Lcol'.$a.'B']);
$data_dcol[$a] = array($_GET['Dcol'.$a.'R'],$_GET['Dcol'.$a.'G'],$_GET['Dcol'.$a.'B']);

$b=0;
while(isset($_GET['Data'.$a.'-'.$b])) {
$data_data[$a][$b] = $_GET['Data'.$a.'-'.$b];
$b++;
}

$a++;
}

//$data_name[0] = 'Examplestan';
//$data_dots[0] = 'Diamond';
//$data_lcol[0] = array(255,000,000);
//$data_dcol[0] = array(255,000,000);
//$data_data[0] = array('10','13','6','81','74');

//$data_name[1] = 'Bobland';
//$data_dots[1] = 'Capital';
//$data_lcol[1] = array(000,255,000);
//$data_dcol[1] = array(000,000,000);
//$data_data[1] = array('56','12','35','9','0');


?>