<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// data scrape the settings of a tune in order to extend related data 
	// get the tune settings, out of the set of the tunes, get the first id
	// $id = 1209;

	// the function
	function setTuneRelate($id){

		// url
		$url = "https://thesession.org/tunes/".$id."?format=json";

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

			// print a break...
			// get as string...
			// $res = json_decode($response, true);
			// var_dump($res['settings']);

			// now that I know that the $res variable holds an array that was decoded from JSON, now a loop would be helpful to get...
			// specific parameters...will attempt
		} 	
	}

	// not successful
	// var_dump(setTuneRelate($id));

	function relateRec($id){

		// url
		$url = "https://thesession.org/tunes/".$id."/recordings?format=json";

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

			// print a break...
			// get as string...
			// $res = json_decode($response, true);
			// var_dump($res['settings']);

			// now that I know that the $res variable holds an array that was decoded from JSON, now a loop would be helpful to get...
			// specific parameters...will attempt
		} 
	}

	// var_dump(relateRec($id));

	function singleSetting($url){

		$urlNew = $url."?format=json";

		// put in the  curl function
		$ch = curl_init($urlNew);

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

			// print a break...
			// get as string...
			// $res = json_decode($response, true);
			// var_dump($res['settings']);

			// now that I know that the $res variable holds an array that was decoded from JSON, now a loop would be helpful to get...
			// specific parameters...will attempt
		} 
	}




	