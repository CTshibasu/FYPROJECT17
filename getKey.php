<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// create an array
	// $x = array(3, 4, 1, 2, 0);
	// reset($x);   // optional.
	// arsort($x);
	// $key_of_max = key($x); 

	// echo $key_of_max;

	// array
	$a=array(1, 2, 3, 5, 6);
	$keys = array_keys($a,6);
	echo $keys[0];

	// array_keys will tell what positioned index the element was in
	// now the next thing to look for is where it will tell where an element is
	// probably search 1 array and refer to the other

	// refer to later....
