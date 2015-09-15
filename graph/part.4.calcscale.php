<?

//Find the highest point
$var['Data_ranges'] = count($data_data);
$var['Highest_point'] = 0;
for($a=0;$a<$var['Data_ranges'];$a++) {
if(max($data_data[$a])>$var['Highest_point']) {
$var['Highest_point'] = max($data_data[$a]);
}}

for($a=1;$a<11;$a++) {
if($var['Highest_point']<=$a.str_repeat('0',strlen(floor($var['Highest_point']))-1)) {
$var['Vert_max'] = $a.str_repeat('0',strlen(floor($var['Highest_point']))-1);
$a=20;
}
}
if(isset($_GET['Vert_max'])) { $var['Vert_max'] = $_GET['Vert_max']; }


//Find the X and Y coordinates for each data point.
for($a=0;$a<$var['Data_ranges'];$a++) {
$temp['Data_points'] = count($data_data[$a]);
for($b=0;$b<$temp['Data_points'];$b++) {
$var['Data_X'][$a][$b] = (($b+1)*$var['Vline_width'])+$conf_axis_dist+$conf_padd;
$var['Data_Y'][$a][$b] = ($conf_height-($data_data[$a][$b]/$var['Vert_max'])*($var['Graph_height']-$var['Hline_height']))-$conf_padd-$conf_axis_dist;
}}


?>