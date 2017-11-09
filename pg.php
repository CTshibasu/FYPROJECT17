<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// function
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

	print setTuneInfo(82016, 10269);