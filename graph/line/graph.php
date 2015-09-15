<?
if(!isset($_GET['T'])) { header('Content-type: image/png'); }
include('config.php');
include('data.php');
include('function.drawdot.php');

//Parts here
include('part.1.makeimg.php');
include('part.2.drawaxis.php');
include('part.3.drawgrid.php');
include('part.4.calcscale.php');
include('part.5.drawlabels.php');
include('part.6.drawlines.php');
include('part.7.drawdots.php');

if(isset($_GET['T'])) {
echo('<pre>');
print_r($var);
print_r($temp);
echo('</pre>');
}


if(!isset($_GET['T'])) { imagepng($img); }
imagedestroy($img);
?>