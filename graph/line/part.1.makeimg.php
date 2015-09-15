<?

$img = imagecreate($conf_width,$conf_height);

$confc_back = imagecolorallocate($img,$confca_back[0],$confca_back[1],$confca_back[2]);
$confc_axis = imagecolorallocate($img,$confca_axis[0],$confca_axis[1],$confca_axis[2]);
$confc_grid = imagecolorallocate($img,$confca_grid[0],$confca_grid[1],$confca_grid[2]);
$confc_text = imagecolorallocate($img,$confca_text[0],$confca_text[1],$confca_text[2]);

$var['Data_ranges'] = count($data_valx);
for($a=0;$a<$var['Data_ranges'];$a++) {
if($data_simple==0) {
$datac_dcol[$a] = imagecolorallocate($img,$data_dcol[$a][0],$data_dcol[$a][1],$data_dcol[$a][2]);
} else {
$datac_dcol[$a] = imagecolorallocate($img,$data_defaultcol[0],$data_defaultcol[1],$data_defaultcol[2]);
}
}

imagefill($img,0,0,$confc_back);


?>