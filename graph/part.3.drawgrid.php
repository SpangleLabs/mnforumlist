<?

//Vertical lines
$var['Data_num'] = count($data_labs);
$var['Vline_width'] = $var['Graph_width']/($var['Data_num']+1);
for($a=0;$a<$var['Data_num'];$a++) {
$temp['Vdist'] = ($var['Vline_width']*($a+1))+$conf_padd+$conf_axis_dist;
imageline($img,$temp['Vdist'],$conf_padd,$temp['Vdist'],$var['Graph_height']+$conf_padd+$conf_axis_indent,$confc_grid);
}

//Horizontal lines
$var['Hline_height'] = $var['Graph_height']/($conf_grid_lines+1);
for($a=0;$a<$conf_grid_lines;$a++) {
$temp['Hdist'] = $conf_height-(($var['Hline_height']*($a+1))+$conf_padd+$conf_axis_dist);
imageline($img,$conf_padd+$conf_axis_dist-$conf_axis_indent,$temp['Hdist'],$var['Graph_width']+$conf_padd+$conf_axis_dist,$temp['Hdist'],$confc_grid);
}




?>