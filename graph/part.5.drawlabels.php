<?

//Y axis labels
for($a=0;$a<($conf_grid_lines+1);$a++) {
$temp['ystring'] = ($var['Vert_max']/$conf_grid_lines)*$a;
$temp['ylabelx'] = $conf_padd+$conf_axis_dist-$conf_axis_indent-(imagefontwidth($conf_font_size)*strlen($temp['ystring']));
$temp['ylabely'] = ($conf_height-($var['Hline_height']*$a)-$conf_axis_dist-$conf_padd)-(imagefontheight($conf_font_size)/2);
imagestring($img,$conf_font_size,$temp['ylabelx'],$temp['ylabely'],$temp['ystring'],$confc_text);
}

//X axis labels
for($a=0;$a<$var['Data_num'];$a++) {
$temp['xstring'] = $data_labs[$a];
$temp['xlabelx'] = ($var['Vline_width']*($a+1))+$conf_padd+$conf_axis_dist-(imagefontwidth($conf_font_size));
$temp['xlabely'] = $conf_height-$conf_padd-$conf_axis_dist+$conf_axis_indent+(strlen($temp['xstring'])*imagefontwidth($conf_font_size));
imagestringup($img,$conf_font_size,$temp['xlabelx'],$temp['xlabely'],$temp['xstring'],$confc_text);
}



?>