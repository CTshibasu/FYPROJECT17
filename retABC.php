<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	include 'recRelate.php';

	// this program will get a substring for the abc notation and return
	// a list of tunes, the thing is the first tune will always be a precedent to
	// searching for the best matches

	// firstly, I will program the function to enter in the tune id of a tune,
	// return it's abc, save as a string
	// enter a tune id 

	// tune id - tune name: Colonel Fraser
	$tid = 40;

	// returns the first `abc` OF THE first tune 
	function retABC($tid){

		// get the id for the tunes
		$url = "https://thesession.org/tunes/".$tid."?format=json";

		// put in the  curl function
		$ch = curl_init($url);

		// create an array for the data to be pulled into
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json;', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		// save response to variable
		$response = curl_exec($ch);

		if(empty($response)) {
			$error = curl_error($ch);
	        //$error now contains the error thrown when curl_exec failed to execute
	        echo $error;
		} else {
			//prints out the JSON for the new tunes for the session API
			// return $response;

			// convert the response to PHP
			$array = json_decode($response, 1);

			// now get the abc of it
			return $array["settings"][0]["abc"];
		}
	}

	// echo ;

	// now to specify that the function is to return the first abc of the setting
	$array = json_decode(retABC($tid), 1); 

	// for the rest of the program, first var_dump() the array I converted into a PHP object
	// var_dump($array["settings"][0]["abc"]);

	// echo "----------------------------------------------------BREAK------------------------------------------------------------<br>";

	// now we deal with the rest of the JSON
	// var_dump($array);

	// now we call the recording post tunes function
	// $arr = json_decode(recRelate($tid), 1);

	// I can go through the recorded with, call tune ids on them and get the string to put in the, checking...
	// at first must retain the same information
	// $num = $arr["recorded_with"][0]["id"];

	// var_dump($num);

	// now use this id, for the guns of the magnificient seven
	// $get = json_decode(retABC($num), 1);

	// var_dump($get);
	// var_dump($get["settings"][0]["abc"]);

	echo retABC($tid);