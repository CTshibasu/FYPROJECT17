<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// now to redo the parsing of the ...
	// $id = 192;
	// var_dump($_GET['id']);

	// take id from form and now use for the tuneRelate function
	// $id = $_GET['id'];

	function recRelate($id){
		// now assign the url
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
			return $response;
		} 
	}

	// test the parsing...
	// echo recRelate($id);

	// FUNCTION SUCCESSFUL

	// now to create one function that is relation to sets and tunebooks... tunebooks is optional
	function tuneRelate($id){
		// now assign the url
		$url = "https://thesession.org/tunes/".$id."/sets?format=json";

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
			return $response;
		} 

	}

	// var_dump(json_decode(tuneRelate($id), 1));

	// now create a function that gets sets info, see if it will parse, if not, try use the work-around method
	// that was used before ie the DOMdocument class
	function getSet($uid, $set_id){
		// now assign the url
		$url = "https://thesession.org/members/".$uid."/sets/".$set_id."?format=json";

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
			return $response;
		} 
	} 

	// make function that returns the tune info of given tune
	function getTuneInfo($id){
		// now assign the url
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
			return $response;
		}
	}

	// function to get the member information of the user
	function getMember($mid){
		// get the URL 
		$url = "https://thesession.org/members/".$mid."?format=json";

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
			return $response;
		}
	}

	// echo '<pre>'.getSet(110046, 10355).'</pre>';