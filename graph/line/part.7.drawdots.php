<?

for($a=0;$a<$var['Data_ranges'];$a++) {
if($data_simple==0) {
$temp['Dot'] = $data_dott[$a];
} else {
$temp['Dot'] = $data_defaultdot;
}
function_imagedrawdot($img,$var['Data_X'][$a],$var['Data_Y'][$a],$temp['Dot'],$datac_dcol[$a]);

}


?>