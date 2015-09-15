<?

for($a=1;$a<$var['Data_ranges'];$a++) {
if($data_simple==0) {
$temp['Dot'] = $data_dott[$a];
} else {
$temp['Dot'] = $data_defaultdot;
}
imageline($img,$var['Data_X'][($a-1)],$var['Data_Y'][($a-1)],$var['Data_X'][$a],$var['Data_Y'][$a],$datac_dcol[$a]);
}


?>