<?
if(!isset($_GET['T'])) { header('Content-type: image/png'); }
include('config.php');
include('data.php');

include('function.drawdot.php');

include('part.1.makeimg.php');
include('part.2.drawaxis.php');
include('part.3.drawgrid.php');
include('part.4.calcscale.php');
include('part.5.drawlabels.php');
include('part.6.drawlines.php');
include('part.7.drawdots.php');
include('part.8.drawkey.php');

//Then drawaxis, drawgrid, findpoints(and scale), draw_labels, draw_lines, draw_dots, draw_key

if(isset($_GET['T'])) {
echo('<pre>');
print_r($var);
print_r($temp);
echo('</pre>');
}


if(!isset($_GET['T'])) { imagepng($img); }
imagedestroy($img);
?>