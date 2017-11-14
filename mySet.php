<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// make a feature that looks at the JSON data
	// for the profile of boscaceoil

	// the two get variables, member_id and the tune_id
	$member_id = 110046;
	$tune_id = 10355;
	$member_name = "My";
	$title = $member_name." Set of Tunes";

	// import on header file for the web page
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_header.php';
	include '/Applications/MAMP/htdocs/SessionCURL/tuneSet.php';

	// now to call the function
?>

	<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<!-- PAGE HEADER FOR THE TITLE -->
	                <h1 class="page-header"><?=$member_name?> Set</h1>
	            </div>
	            <!-- may include some extra bits but not required at the moment -->
			</div>

			<?php

				// call the function for the members
				$a = setTuneInfo($member_id, $tune_id);

				// the name of the combination of the set
				$t = json_decode($a, 1);
				// var_dump($t["name"]); 

				// echo $t["name"];
				for($i = 0; $i < count($t["settings"]); $i++){
			?>

			<!-- now having to put -->
			<div class="jumbotron">
			  <div class="container">
			    <h3 class="display-3"><?php echo ($i+1).". ".$t["settings"][$i]["name"]?></h3>
			    <p class="lead">
			    	<div>
			    		abc: <?="<pre>".$t["settings"][$i]["abc"]."</pre>"?>
			    	</div>
		    	</p>
			    <p class="lead">
			    	<div>
			    		<form class="setInfoForm" data-set_id="<?=$i?>" method="GET" action="searchRes.php">
				    		<!-- pull from. recent activities &  -->
				    		meter: <input type="submit" name="meter" value="<?=$t["settings"][$i]["meter"]?>" />
				    		<br>
				    		<br>
				    		key: <input type="submit" name="key" value="<?=$t["settings"][$i]["key"]?>" />
				    		<br>
				    		<br>
				    		uploaded by: <input type="submit" name="member_name" value="<?=$t["settings"][$i]["member"]["name"]?>" />
				    		<input type="hidden" name="querySearch" value="">
			    		</form>

			    		<!-- these variables, meter and key are for the tune and could be coupled in fo the button -->
			    		<!-- ... -->
			    	</div>
		    	</p>
			  </div>
			</div>
			
			<?php
				}
			?>

	</div>

<?php
	
	// the import for the footer file
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_footer.php';

?>

<script type="text/javascript">
		// null
		var str = "";

		// group of inputs
		$('input').on('click', function(e){

			// find it
			str = $(this).val();
			$('input[name="querySearch"]').val(str);

			str = $(this).val();
		});

		// form submitting 
		$('.setInfoForm').submit(function(e){

			// alert the form and make sure it gets every individual + preventing default
			e.preventDefault();
			alert($(this).data("set_id"));

			$('input[name="querySearch"]').val(str);

			var $form = $( this ),
			           formURL = $form.attr( "action" );
			           getData = $form.serializeArray();
			
			           var result = $.ajax({
			               data: getData,
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
			               window.location.href = "searchRes.php?querySearch="+str;
			           },
			           error: function(jqXHR, textStatus, errorThrown)
			           {
			               alert("There was an error submitting your details");//if fails    
			           }
			           }).responseText;
		});
</script>