<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// $member_id = 110046;

	// now for the task to find and scrape the sets of tunes
	function tuneSet($member_id, $pageNo = 1, $pageItem = 50){
		
		$url = "https://thesession.org/members/".$member_id."/sets?format=json&page=".$pageNo."&perpage=".$pageItem;

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
			// $res = json_decode(html_entity_decode($response), true);

			// return JSON object;
			return $response;
		}
	}

	// echo '<pre>'.tuneSet($member_id).'</pre>';
	$arr = tuneSet($member_id);

	// convert the tune_id
	$arr_php = json_decode($arr, 1);
	// echo "<br>----------------------------------<br>";
	// var_dump($arr_php);

	$tune_id = $arr_php["sets"][0]["id"];

	// now to get the function that looks at the tune id of the first tune in
	// the tune set
	function setTuneInfo($member_id, $tune_id){
		$url = "https://thesession.org/members/".$member_id."/sets/".$tune_id."?format=json";

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
			// $res = json_decode(html_entity_decode($response), true);

			// return JSON object;
			return $response;
		}
	}

	// setinfo for tunes
	// echo '<pre>'.setTuneInfo($member_id, $tune_id).'</pre>';

	// SUCCESSFUL!

