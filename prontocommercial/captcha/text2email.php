<?php
	/*
	*	Sometimes it is required to display email addresses as images to safegaurd against spammers and to protect emails
	*	being captured by screen scraping. So the code below is a function that receives text to be displayed on the image.
	*	The size of image, fonts and colors can be customized. The text is centered horizontally and vertically in the image.
	*	A font file should be placed in the path specified in the code below
	*/
	function createSourceImage($text){
		if(trim($text)!=''){
			$width=420;
			$height=100;
			$img=imagecreatetruecolor($width,$height);
			$fill_color=imagecolorallocate($img,220,230,235);
			$text_color=imagecolorallocate($img,30,64,90);
			$font='arial.ttf';
			imagefilledrectangle($img,0,0,$width,$height,$fill_color);
			imagerectangle($img,1,1,$width-2,$height-2,$text_color);
			$bbox=imagettfbbox(34,0,$font,$text);

			$x = $bbox[0] + (imagesx($img) / 2) - ($bbox[4] / 2);
			$y = $bbox[1] + (imagesy($img) / 2) - ($bbox[5] / 2);

			imagettftext($img,34,0,$x,$y,$text_color,$font,$text);
			return $img;
		}
	}
	header("Content-type:image/jpeg");
	$img=createSourceImage("prontocommercial@gmail.com"); // Text we want to convert
	imagejpeg($img,'',80);
 ?>
