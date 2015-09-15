<?

$img = imagecreate($conf_width,$conf_height);

$confc_back = imagecolorallocate($img,$confca_back[0],$confca_back[1],$confca_back[2]);
$confc_axis = imagecolorallocate($img,$confca_axis[0],$confca_axis[1],$confca_axis[2]);
$confc_grid = imagecolorallocate($img,$confca_grid[0],$confca_grid[1],$confca_grid[2]);
$confc_text = imagecolorallocate($img,$confca_text[0],$confca_text[1],$confca_text[2]);
$confc_kbox = imagecolorallocate($img,$confca_kbox[0],$confca_kbox[1],$confca_kbox[2]);

$var['Data_ranges'] = count($data_data);
for($a=0;$a<$var['Data_ranges'];$a++) {
$datac_lcol[$a] = imagecolorallocate($img,$data_lcol[$a][0],$data_lcol[$a][1],$data_lcol[$a][2]);
$datac_dcol[$a] = imagecolorallocate($img,$data_dcol[$a][0],$data_dcol[$a][1],$data_dcol[$a][2]);
}

imagefill($img,0,0,$confc_back);


?>
