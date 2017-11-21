<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	include 'recRelate.php';
	include '../../tuneSet.php';

	// this program will get a substring for the abc notation and return
	// a list of tunes, the thing is the first tune will always be a precedent to
	// searching for the best matches

	// firstly, I will program the function to enter in the tune id of a tune,
	// return it's abc, save as a string
	// enter a tune id 

	// tune id - tune name: Colonel Fraser
	$tid = 1209;

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

	// function that finds the occurrences of characters in a given string
	// classical needle in the haystack scenario
	function strposX($haystack, $needle, $number) {
	    // decode utf8 because of this behaviour: https://bugs.php.net/bug.php?id=37391
	    preg_match_all("/$needle/", utf8_decode($haystack), $matches, PREG_OFFSET_CAPTURE);
	    return $matches[0][$number-1][1];
	}

	// echo ;

	// now to specify that the function is to return the first abc of the setting
	// $array = json_decode(retABC($tid), 1); 

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

	// returns the full abc of a song
	// echo retABC($tid);

	// now find a relation of the 
	// echo recRelate($tid);

	// in order to get the abc of the tunes, you call the retABC function on all the 
	// $alpha = json_decode(recRelate($tid), 1);

	// now to loop through the abc of the object
	// $rec_with = $alpha["recorded_with"];

	// var_dump($rec_with[0]["id"]);

	// for($i = 0; $i < count($rec_with); $i++){

	// 	// use the index to get the ids, then the abcs
	// 	$id = $rec_with[$i]["id"];

	// 	// now use this id to call on the function
	// 	$abcstr = retABC($id);

	// 	echo "<pre>The abc for tune ID of: ".$id." is ".$abcstr."</pre><br>";
	// }

	// now the precedent for this particular program is to get a tune, that is part of a set and 
	// with that set compare the other tunes in the set and maybe possibly other tunes in the other sets
	// test this out on the tune - Colonel Fraser's, where the id is 1209
	// use the function now - ...
	// var_dump(tuneRelate(1209));

	// now it has, the information for the 3 sets!, now you have to go over the
	// first is to loop through sets, with the id of the sets given in each, for example 10355
	// now with 10355, and the member_id, go to the set info part and get the abc of the tunes

	// look within the loop and compare the strings
	// problem is that information can be lost to exactly which tune that the abc belongs to
	// so make an array with tune ids and also the abcs
	// then push into an array, empty the one with the custom keys etc.

	// array that has the abcs of other tunes of other sets related to the selected tune
	$abcINFO = array();

	// so call the function to get sets for the tune
	$a = json_decode(tuneRelate($tid), 1);

	// now check for the array, $a
	// var_dump($a);

	// now make a loop that runs through the sets array
	for($i=0; $i < count($a["sets"]); $i++){
		// now use the member_id and the tune_id to get the setINFO
		$set_id = $a["sets"][$i]["id"];

		// and the member_id
		$member_id = $a["sets"][$i]["member"]["id"];

		// now call the setInfo function, returns the JSON
		$setArr = json_decode(getSet($member_id, $set_id), 1);

		// now from there, look at the contents of the array
		// now loop through the returned array
		for($j = 0; $j < count($setArr["settings"]); $j++){

			// this will go through each individual tune(s)
			if($setArr["settings"][$j]["id"] == $tid){
				// do nothing... 
			} else {
				// create an array with the tune_id and the abc
				// with the key and value struct of an array

				$arrtemp = array(
					"id" => $setArr["settings"][$j]["id"],
					"abc" => $setArr["settings"][$j]["abc"]
				);

				// now push the array into the array, abcINFO
				$abcINFO[] = $arrtemp;
				// unset($arrtemp);
			}

		}

	}

	// var_dump array structure
	// var_dump($abcINFO); // successful

	// now for the next step, try split the abc
	echo strposX($abcINFO[0]["abc"], '2', 1);

	// compare this needle and haystack of each passing char for the first bar, for example
	// if a [...]

