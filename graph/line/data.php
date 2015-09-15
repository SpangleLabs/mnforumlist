<?

$data_simple = $_GET['S'];
$data_defaultcol = array($_GET['DecolR'],$_GET['DecolG'],$_GET['DecolB']);
$data_defaultdot = $_GET['Dedot'];


$a=0;
while(isset($_GET['Valx'.$a])) {
$data_valx[$a] = $_GET['Valx'.$a];
$data_valy[$a] = $_GET['Valy'.$a];
$data_dott[$a] = $_GET['Dott'.$a];
$data_dcol[$a] = array($_GET['Dcol'.$a.'R'],$_GET['Dcol'.$a.'G'],$_GET['Dcol'.$a.'B']);
$a++;
}


//$data_simple = 1;
//$data_defaultcol = array(000,000,000);
//$data_defaultdot = "Cross";

//$data_valx[0] = 50;
//$data_valy[0] = 12;
//$data_dcol[0] = array(255,255,255);
//$data_dott[0] = "Cross";

//$data_valx[1] = 70;
//$data_valy[1] = 30;
//$data_dcol[1] = array(255,255,255);
//$data_dott[1] = "Cross";

//$data_valx[2] = 27;
//$data_valy[2] = 5;
//$data_dcol[2] = array(255,255,255);
//$data_dott[2] = "Cross";

//$data_valx[3] = 47;
//$data_valy[3] = 17;
//$data_dcol[3] = array(255,255,255);
//$data_dott[3] = "Cross";

//$data_valx[4] = 48.5;
//$data_valy[4] = 16;
//$data_dcol[4] = array(255,255,255);
//$data_dott[4] = "Capital";




?>