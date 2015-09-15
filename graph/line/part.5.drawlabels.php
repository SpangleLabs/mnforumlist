<?

//Y axis labels
for($a=0;$a<($conf_grid_lines+1);$a++) {
$temp['ystring'] = ($var['Vert_Ymax']/$conf_grid_lines)*$a;
$temp['ylabelx'] = $conf_padd+$conf_axis_dist-$conf_axis_indent-(imagefontwidth($conf_font_size)*strlen($temp['ystring']));
$temp['ylabely'] = ($conf_height-($var['Hline_height']*$a)-$conf_axis_dist-$conf_padd)-(imagefontheight($conf_font_size)/2);
imagestring($img,$conf_font_size,$temp['ylabelx'],$temp['ylabely'],$temp['ystring'],$confc_text);
}

//X axis labels
for($a=0;$a<($conf_grid_lines+1);$a++) {
$temp['xstring'] = ($var['Hor_Xmax']/$conf_grid_lines)*$a;
$temp['xstring'] = gmdate('d\/m\/y',($_GET['Startdate']+($temp['xstring']*86400)));
$temp['xstringlength'] = strlen($temp['xstring'])*imagefontwidth($conf_font_size);
$temp['xlabelx'] = $conf_padd+$conf_axis_dist+($a*$var['Vline_width']);
//$temp['xlabelx'] = (($a+1)*($var['Bar_width']+$conf_bar_gap))+$conf_axis_dist+$conf_padd-($var['Bar_width']/2)-($temp['xstringlength']/2);
$temp['xlabely'] = $conf_height-$conf_padd-$conf_axis_dist+$conf_axis_indent+$temp['xstringlength'];
imagestringup($img,$conf_font_size,$temp['xlabelx'],$temp['xlabely'],$temp['xstring'],$confc_text);
}



?>