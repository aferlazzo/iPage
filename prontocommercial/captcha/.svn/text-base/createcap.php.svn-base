<?php
    require_once('Text/CAPTCHA.php');
/*
//path to store variables (required by JustHost)
*/
	session_save_path("/home/prontoc2/php");  
    session_start();
    $phrase = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : 'Error';
 
    $options = array('font_size' => 24,
                     'font_file' => 'georgia.ttf');
 
    $cap = Text_CAPTCHA::factory('Image');
    $cap->init(120, 60, $phrase, $options);
 
    header('Content-type: image/png');
    echo $cap->getCAPTCHAAsPNG();
?>