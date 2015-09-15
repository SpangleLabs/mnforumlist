<?

for($a=0;$a<$var['Data_ranges'];$a++) {
$temp['Data_points'] = count($data_data[$a]);
for($b=0;$b<$temp['Data_points'];$b++) {
function_imagedrawdot($img,$var['Data_X'][$a][$b],$var['Data_Y'][$a][$b],$data_dots[$a],$datac_dcol[$a]);


}}


?>