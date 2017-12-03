<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// now to import the variable
	$qsearch = $_GET['querySearch'];

	$title = "Search: ".$qsearch;

	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_header.php';
	include '/Applications/MAMP/htdocs/SessionCURL/test_session.php';

	// $qsearch = "";

	// problem that input may not be sent off with the ajax
	// :UPDate - it's been fixed
	// now for the change in the page
	// instead of having the ajax respond back to the index.php
	// bring the result of json right in the page
	// important thing to note it is that the returning statement...
	// will have JSON

	// var_dump($qsearch);

	// now call on the search function 
	// var_dump(get_search("tunes", $qsearch));

	
	// print $qsearch;
	// wanting to click onto the member who uploaded it and check their tunebooks
	// relating information
?>

		<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<!-- PAGE HEADER FOR THE TITLE -->
		                <h1 class="page-header">Search for <?='"'.$qsearch.'"'?></h1>
		            </div>
		            <!-- may include some extra bits but not required at the moment -->
				</div>
				<!-- <div class="col-md-12 col-sm-5 col-xs-12 form-group pull-right top_search"> -->
				<!-- now for a dropdown with different setup -->
				<form id="select_genre" data-parsley-validate class="form-inline form-label-left" method = "get" action = "searchRes.php">
					<div class="form-group">
					<!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" style="margin-top:7px;" for="type">Type:</label> -->
						<select>
							<option>tunes</option>
							<option>jigs</option>
							<option>reels</option>
							<option>slip jigs</option>
							<option>hornpipes</option>
							<option>polkas</option>
							<option>slides</option>
							<option>waltzes</option>
							<option>barndances</option>
							<option>strathspeys</option>
							<option>three-twos</option>
							<option>marzukas</option>
						</select>
						<select>
							<option>all keys</option>
							<option>Amajor</option>
							<option>Aminor</option>
							<option>Adorian</option>
							<option>Amixolydian</option>
							<option>Bminor</option>
							<option>Cmajor</option>
							<option>Dmajor</option>
							<option>Dminor</option>
							<option>Eminor</option>
							<option>Fmajor</option>
							<option>Gmajor</option>
							<option>Dmixolydian</option>
							<option>Bmixolydian</option>
							<option>Edorian</option>
							<option>Gminor</option>
							<option>Gdorian</option>
							<option>Ddorian</option>
							<option>Cdorian</option>
							<option>Fdorian</option>
							<option>Gmixolydian</option>
							<option>Emajor</option>
							<option>Bdorian</option>
							<option>Emixolydian</option>
						</select>

						<!-- the form group -->
						<div class="form-group" style="margin-left: 9px;">
						    <label for="keyword">keyword</label>
						    <input type="terms" class="form-control" id="keyword" name="querySearch" placeholder="search...">
						</div>
						<button type="submit" class="btn btn-default">Search</button>
					</div>
					<!-- </div> -->
				<!-- </div> -->
				</form>
				<br>

		<?php

			// add the function call here
			$res = get_search("tunes", $qsearch);

			// convert it to PHP
			$query = json_decode($res, 1);
			// var_dump($query);

			// now loop but go through half atm, which will be 25, later on pagination
			// will have to be a well needed feature in all of this
			for($i = 0; $i < count($query["tunes"])/2; $i++){

		?>

		<!-- <div class="row"> -->
			<!-- may import the php into the section of the row -->

			<!-- preferably, loop the page on calls from the function, and repeat the modals -->
			
			<div class="well" style="display:inline-block; width:730px;">
			  <div class="container">
			    <h3 class="display-3">
			    	<!-- <?php echo ($i+1).". ".$query["tunes"][$i]["name"];?> -->
			    	<a value="<?=$query["tunes"][$i]["id"]?>" href="tuneSpec.php?id=<?=$query["tunes"][$i]["id"]?>">
			    		<?php echo ($i+1).". ".$query["tunes"][$i]["name"];?>
			    	</a>
		    	</h3>
			    <p class="lead">
			    	<!-- want to be able to create a form with the link -->
			    	<!-- click the type of tune -->

		    		<!-- hidden form with the value in it -->
		    		<form class="searchForm_" data-genre_id="<?=$i?>" style="" method="GET" action="#">
		    			<input type="hidden" id="q_<?=$i?>" name="querySearch" value="<?=$query["tunes"][$i]["type"]?>">
		    			Type:  <input type="submit" value="<?=$query["tunes"][$i]["type"]?>" />
		    		</form>
		    		
		    	</p>
			    <p class="lead">
			    	<div>
			    		Date: <?=$query["tunes"][$i]["date"]?>
			    	</div>
		    	</p>
		    	<!-- info on who uploaded it -->
		    	<p class="lead">
		    		<div>
		    			<!-- create a form in here with the member name being a button -->
		    			<!-- on submit holds the value of the id and sends it off to index.php -->
		    			<form class="memberForm_" data-member_id="<?=$i?>" method="GET" action="index.php">
		    				<input type="hidden" id="member_<?=$i?>" name="memberID" value="<?=$query["tunes"][$i]["member"]["id"]?>"> 
		    				<input type="hidden" id="name_<?=$i?>" name="memberName" value="<?=$query["tunes"][$i]["member"]["name"]?>">
		    				Uploaded by: <input type="submit" value="<?=$query["tunes"][$i]["member"]["name"]?>" />
		    			</form>
		    		</div>
		    	</p>
			  </div>
			</div>
			
		<!-- </div> -->
		<?php

			// end of loop
			}
		?>

		<?php
			include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_footer.php';	
		?>

	<script type="text/javascript">

		// submit form for the genres
		$('.searchForm_').submit(function(e){
			e.preventDefault();

		// call on the submit function for the

		// alert('clicked');
		var g = $(this).data("genre_id");
		// alert(g);

		// now get the query string that you want to submit
		var query = $("#q_"+g).val();


		var $form = $(this),
		           formURL = $form.attr( "action" );
		           GETData = $form.serializeArray();
		
		           var result = $.ajax({
		               data: GETData,
		               type: 'GET',
		               url : formURL,
		               global: false,
		               async:false,
		           success:function(data, textStatus, jqXHR)
		           {
		               // if(data == '1') {
		               //   $form.hide();
		               // }else{
		               //   alert("ERROR: "+data);
		               //   return false;
		               // }

		               alert('success');
		               window.location.href = "searchRes.php?querySearch="+query;
		
		           },
		           error: function(jqXHR, textStatus, errorThrown)
		           {
		               alert("There was an error submitting your details");//if fails    
		           }
		           }).responseText;
		});

		// now having to create a tunebook for the 
		$('.memberForm_').submit(function(e){

			// e preventDefault
			e.preventDefault();

			var m = $(this).data("member_id");
			// alert(m);

			// now to get the id and
			var member_query = $("#member_"+m).val();
			var member_name = $("#name_"+m).val();

			var $form = $( this ),
			           formURL = $form.attr( "action" );
			           GETData = $form.serializeArray();
			
			           var result = $.ajax({
			               data: GETData,
			               type: 'GET',
			               url : formURL,
			               global: false,
			               async:false,
			           success:function(data, textStatus, jqXHR)
			           {
			               // if(data == '1') {
			               //   $form.hide();
			               // }else{
			               //   alert("ERROR: "+data);
			               //   return false;
			               // }

			               alert('success!');
			               window.location.href = "index.php?memberID="+member_query+"&memberName="+member_name;
			
			           },
			           error: function(jqXHR, textStatus, errorThrown)
			           {
			               alert("There was an error submitting your details");//if fails    
			           }
			           }).responseText;
		});
	</script>
</html>


	