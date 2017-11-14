<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	$title = "Jason's Tunebook";
	$member_id = 109869;

	// now to use the include files for the header and the
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_header.php';
	include '/Applications/MAMP/htdocs/SessionCURL/Tunebook.php'

	// this page is going to be dumping the data from the page that will work on the
	// function calls, first of all
	// the default of the member is going to be Jason Fry with a member id of 109869
	// one interesting thing about the tunebooks is the sorting feature with 3: name, type and date added

	// here are the steps to adding the tunebook sections
	// call the tunebook
	// save the json
	// dump json in dashboard page
	// format it in modules to make it more comprehensive

?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<!-- PAGE HEADER FOR THE TITLE -->
                <h1 class="page-header">Jason's Tunebook</h1>
            </div>
            <!-- may include some extra bits but not required at the moment -->
		</div>

		<?php
			// now call the function
			$a = getTunebook($member_id);

			// create a for loop to access the tunes
			for($i = 0; $i < count($a["tunes"]); $i++){

				// in here we access every tune and make it into every module
				// $a[""]
		?>
		<!-- add another div row -->
		<div class="row">
			<!-- may import the php into the section of the row -->

			<!-- preferably, loop the page on calls from the function, and repeat the modals -->
			
			<div class="jumbotron">
			  <div class="container">
			    <h3 class="display-3"><?php echo ($i+1).". ".$a["tunes"][$i]["name"];?></h3>
			    <!-- <hr class="my-4" visible="true"> -->
			    <p class="lead">Type: <?php echo $a["tunes"][$i]["type"];?></p>
			    <p class="lead">Date: <?=$a["tunes"][$i]["date"]?></p>
			    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
			  </div>
			</div>

			<!-- <div class="jumbotron">
			  <h1 class="display-3">Hello, world!</h1>
			  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
			  <hr class="my-4">
			  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
			  <p class="lead">
			    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
			  </p>
			</div> -->
			
		</div>
		<?php
				// end of loop
				}
			?>
	</div>
	
	<!-- include footer.php -->
	<?php
		include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_footer.php';	
	?>

	<script type="text/javascript">
			// $('#myModal').modal({
			//     backdrop: 'static',
			//     keyboard: false
			// })
	</script>