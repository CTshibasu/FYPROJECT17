<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// create a new page and get the result of a clicked tune to get the other tunes that are related to it by sets
	// firstly, return the tune id of the tune and run the getTuneInfo, alongside that the $abcInfo, with that you can create 
	// a pie chart of some sorts and also an infrastructure of what that particular set consisted of etc.

	$_GET['id'];

	// include the header
	// now to use the include files for the header and the
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_header.php';
	include '/Applications/MAMP/htdocs/SessionCURL/Tunebook.php';

?>



<?php
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_footer.php';	
?>