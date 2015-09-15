<?

//Horizontal lines
$var['Hline_height'] = $var['Graph_height']/($conf_grid_lines+1);
for($a=0;$a<$conf_grid_lines;$a++) {
$temp['Hdist'] = $conf_height-(($var['Hline_height']*($a+1))+$conf_padd+$conf_axis_dist);
imageline($img,$conf_padd+$conf_axis_dist-$conf_axis_indent,$temp['Hdist'],$var['Graph_width']+$conf_padd+$conf_axis_dist,$temp['Hdist'],$confc_grid);
}

//Vertical lines
$var['Vline_width'] = $var['Graph_width']/($conf_grid_lines+1);
for($a=0;$a<$conf_grid_lines;$a++) {
$temp['Vdist'] = $conf_padd+$conf_axis_dist+(($a+1)*$var['Vline_width']);
imageline($img,$temp['Vdist'],$conf_padd,$temp['Vdist'],$conf_height-$conf_padd-$conf_axis_dist+$conf_axis_indent,$confc_grid);
}

?>