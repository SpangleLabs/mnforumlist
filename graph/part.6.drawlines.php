<?

for($a=0;$a<$var['Data_ranges'];$a++) {
$temp['Data_points'] = count($data_data[$a]);
for($b=1;$b<$temp['Data_points'];$b++) {
imageline($img,$var['Data_X'][$a][($b-1)],$var['Data_Y'][$a][($b-1)],$var['Data_X'][$a][$b],$var['Data_Y'][$a][$b],$datac_lcol[$a]);
}}


?>