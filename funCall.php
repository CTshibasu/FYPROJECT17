<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// call the test_session file
	// include '/Applications/MAMP/htdocs/SessionCURL/test_session.php';

	// now call the variable from the form
	$label = html_entity_decode($_POST['label']);

	// call the functinon get_search
	// echo get_search("tunes", $label);

	function get_search($word, $searchTerm, $pageItem = 50, $pageNo = 1){
		// do nothing...

		// have the link of the search as a variable with the query at the end of it
		$url = "https://thesession.org/".$word."/search?q=".$searchTerm."&format=json&perpage=".$pageItem."&page=".$pageNo;

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
				$res = $response;

				// return JSON object;
				return $res;
		} 

	}

	// echo '<pre>'.get_search("tunes", "Jig").'</pre>';
	// echo '------------------------------------------<br>';
	$a = get_search("tunes", $label);
	$arr = json_decode($a, 1);
	// $tunes = ($arr['tunes']);
	// echo $arr['pages'];

	$numPages = $arr['pages'];
	$itemLimit = 50;

	$str = '[';
	// now create a loop
	for($i = 1; $i <= $numPages; $i++){
		if($i != 1){
			$str .= ",";
		}
		$str.= get_search("tunes", $label, $itemLimit, $i);
	}
	$str.="]";

	echo $str;