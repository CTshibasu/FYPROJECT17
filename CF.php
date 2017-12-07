<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// include file: 
	// debugging PHP script 
	include 'setsRelate.php';

	$phparr = json_decode(setTuneRelate(1209), true);
	// get the settings array for the info
	$settings = $phparr["settings"];

	// debugging result for PHP array
	var_dump($phparr);

	// possible use of this particular piece is to create a settings array where
	// you create a div with panel settings and accordions with the info for the settings info
	// echo singleSetting("https://thesession.org/tunes/1209#setting1209");
?>
