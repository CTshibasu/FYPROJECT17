<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// include file: 
	// debugging PHP script 
	include 'setsRelate.php';
	include 'recRelate.php';
	include '../../tuneSet.php';

	$phparr = json_decode(setTuneRelate(1209), true);
	// get the settings array for the info
	$settings = $phparr["settings"];

	// debugging result for PHP array

	// possible use of this particular piece is to create a settings array where
	// you create a div with panel settings and accordions with the info for the settings info
	// echo singleSetting("https://thesession.org/tunes/1209#setting1209");

	// now to test for the set of individuals to dump on setOfTunes.php page
	// don't forget the include
	$phparr = json_decode(setTuneInfo(109954, 10192), true);

	// the only dataset from the scrape that matters
	// var_dump($phparr["settings"]);

	// hold the genres
	$list = array();

	// run through the settings array and call the type of the tunes by their tune_id
	for($index = 0; $index < count($phparr["settings"]); $index++){
		// get the tune_id of the tune
		$tid = $phparr["settings"][$index]["id"];

		// now, put the tune_id into the tune_info function
		$tinfo = json_decode(setTuneRelate($tid), true);
		$list[] = $tinfo["type"];

	}

	// var dump the list array
	// var_dump($list);
	$resSet = json_decode(tuneRelate(1209), 1);
	// var_dump($resSet);

	// extracting the member_id and the set_id
	$mem = $resSet["sets"][0]["id"];
	$sid = $resSet["sets"][0]["member"]["id"];

	// check if these variables exists for getting the set of a user
	var_dump($mem);
	var_dump($sid);

	// take them in a form format, get or post them and input them into the 
	// getSetInfo function, returns the information of the mem and the set id
	// algorithm IMPLEMENTED

	// now having to get a count of the values present in the array
	// array_count_values will be a method
	// in the set they can use the genre and how many of them are assoc. to it
	// further implementation of the algorithm will give the list of what genres are consisted in a set, later tune book
	// and implemented in data charts for javascript...

	// var_dump(json_decode(setTuneRelate(4101), true));
	// $res = json_decode(setTuneRelate(4101), true);

	// get the type
	// var_dump($res["type"]);

	// ...
	// get the types of tunes for the web page

?>
