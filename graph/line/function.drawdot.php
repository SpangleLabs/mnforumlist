<?

function function_imagedrawdot($img,$x,$y,$dot,$colour) {

if($dot=="Square") {
imagefilledrectangle($img,($x-2),($y-2),($x+2),($y+2),$colour);
} elseif($dot=="Circle") {
imagefilledrectangle($img,($x-1),($y-2),($x+1),($y+2),$colour);
imagefilledrectangle($img,($x-2),($y-1),($x+2),($y+1),$colour);
} elseif($dot=="Diamond") {
imagefilledrectangle($img,($x-1),($y-1),($x+1),($y+1),$colour);
imageline($img,$x,($y-2),$x,($y+2),$colour);
imageline($img,($x-2),$y,($x+2),$y,$colour);
} elseif($dot=="Dot") {
imagesetpixel($img,$x,$y,$colour);
} elseif($dot=="Cross") {
imageline($img,($x-2),($y-2),($x+2),($y+2),$colour);
imageline($img,($x-2),($y+2),($x+2),($y-2),$colour);
} elseif($dot=="Plus") {
imageline($img,$x,($y-2),$x,($y+2),$colour);
imageline($img,($x-2),$y,($x+2),$y,$colour);
} elseif($dot=="Capital") {
imagefilledrectangle($img,($x-1),($y-1),($x+1),($y+1),$colour);
imageline($img,($x-4),$y,($x+4),$y,$colour);
imageline($img,$x,($y-4),$x,($y+4),$colour);
imageline($img,($x-3),($y-3),($x+3),($y+3),$colour);
imageline($img,($x-3),($y+3),($x+3),($y-3),$colour);
imageline($img,($x-2),($y-4),($x+2),($y-4),$colour);
imageline($img,($x-2),($y+4),($x+2),($y+4),$colour);
imageline($img,($x-4),($y-2),($x-4),($y+2),$colour);
imageline($img,($x+4),($y-2),($x+4),($y+2),$colour);
}





return 1;
}

?>