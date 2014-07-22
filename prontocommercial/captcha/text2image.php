<?php
	$font_size = '14px'; // The generated size (in pixel) of the font
	$font_color = 'ffffff'; // The generated color of the font (in HEX)
	$font = 'arial.ttf'; // Font file we want to use
	$text = 'prontocommercial@gmail.com'; // Text we want to convert
	// convert the color to hexidecimal
	list($r, $g, $b) = array(
		$font_color[0].$font_color[1],
		$font_color[2].$font_color[3],
		$font_color[4].$font_color[5]
	);
	$r = hexdec($r);
	$g = hexdec($g);
	$b = hexdec($b);
	$color = array( $r, $g, $b );
	// Get the image size
	$size = @imagettfbbox($font_size,0,$font,$text);
	$xsize = abs($size[0]) + abs($size[2]);
	$ysize = abs($size[5]) + abs($size[1]);
	$image = @imagecreatetruecolor($xsize, $ysize);

	// Set the image transparency
	@imagesavealpha($image, true);
	$transparent = @imagecolorallocatealpha($image,0,0,0,127);
	@imagefill($image,0,0,$transparent);

	// Coloring the text
	$font_color	= @imagecolorallocate($image, $color[0], $color[1], $color[2]);
	@imagettftext($image,$font_size,0,0,abs($size[5]),$font_color,$font,$text);

	// Return the image to the browser
	header("Content-Type: image/png");

	@imagepng($image);
	@imagedestroy($image);

	ob_flush();
?>
