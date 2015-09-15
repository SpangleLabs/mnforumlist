<?

//Find the highest point
$var['Highest_Xpoint'] = max($data_valx);
$var['Highest_Ypoint'] = max($data_valy);


for($a=1;$a<11;$a++) {
if($var['Highest_Ypoint']<=$a.str_repeat('0',strlen(floor($var['Highest_Ypoint']))-1)) {
$var['Vert_Ymax'] = $a.str_repeat('0',strlen(floor($var['Highest_Ypoint']))-1);
$a=20;
}}
for($a=1;$a<11;$a++) {
if($var['Highest_Xpoint']<=$a.str_repeat('0',strlen(floor($var['Highest_Xpoint']))-1)) {
$var['Hor_Xmax'] = $a.str_repeat('0',strlen(floor($var['Highest_Xpoint']))-1);
$a=20;
}}



//Find the X and Y coordinates for each data point.
for($a=0;$a<$var['Data_ranges'];$a++) {
$var['Data_X'][$a] = $conf_padd+$conf_axis_dist+$conf_padd+($data_valx[$a]/$var['Hor_Xmax']*($var['Graph_width']-$var['Vline_width']));
$var['Data_Y'][$a] = ($conf_height-($data_valy[$a]/$var['Vert_Ymax'])*($var['Graph_height']-$var['Hline_height']))-$conf_padd-$conf_axis_dist;
}


?>