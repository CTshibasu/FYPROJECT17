<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// create a new page and get the result of a clicked tune to get the other tunes that are related to it by sets
	// firstly, return the tune id of the tune and run the getTuneInfo, alongside that the $abcInfo, with that you can create 
	// a pie chart of some sorts and also an infrastructure of what that particular set consisted of etc.

	// ; // this will hold the id for the tune I query

	$tune_id = $_GET['id'];

	// then run the tuneInfo funciton on the id

	// now run function
	

	// now to use the include files for the header and the...
	include '../../Tunebook.php';
	include '../../tuneSet.php';
	include 'recRelate.php';

	$res = json_decode(getTuneInfo($tune_id), 1);
	$title = "Tune: ".$res["name"];

	include 'inc_header.php';


	// var_dump test
	// var_dump($res);
?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<!-- PAGE HEADER FOR THE TITLE -->
                <h1 class="page-header"><?=$title?></h1>
            </div>
            <!-- may include some extra bits but not required at the moment -->
           <div class="well" style="display:inline-block; width:650px;">
			    <div class="container">
			    	<!-- contain the info on the tune -->
			    	
				</div>
			</div>
		</div>
	</div>

<?php
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_footer.php';	
?>