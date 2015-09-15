<?

//Y axis
$var['Graph_height'] = $conf_height-$conf_padd-$conf_padd-$conf_axis_dist;
imageline($img,$conf_padd+$conf_axis_dist,$conf_padd,$conf_padd+$conf_axis_dist,$var['Graph_height']+$conf_padd+$conf_axis_dist,$confc_axis);

//X axis
$var['Graph_width'] = $conf_width-$conf_padd-$conf_padd-$conf_key_width-$conf_key_gap-$conf_axis_dist;
imageline($img,$conf_padd,$var['Graph_height']+$conf_padd,$var['Graph_width']+$conf_padd+$conf_axis_dist,$var['Graph_height']+$conf_padd,$confc_axis);


?>