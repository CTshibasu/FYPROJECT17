<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// import the function page
	include '/Applications/MAMP/htdocs/SessionCURL/test_session.php';
	// include 'prettyprint.php';

	try{
		// file
		$myFile = "data.json";

		// now read the file from function call on the new 
		$jsondata = get_new("tunes");
		$phparr = json_decode($jsondata, 1);

		// item limit
		$itemLimit = 50;

		// keeps the number of pages
		$numPages = $phparr['pages'];

		$str = '[';
		// now create a loop
		for($i = 1; $i <= $numPages; $i++){
			if($i != 1){
				$str .= ",";
			}

			// the string of the
			$str.= get_new("tunes",$itemLimit, $i);
		}
		$str.="]";

		// // now write the file
		if(file_put_contents($myFile, $str)){
			 echo 'Data successfully saved';
		} else{
			echo "error";
		}

	} catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}