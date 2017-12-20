<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// make a feature that looks at the JSON data
	// for the profile of boscaceoil
	// in need of making this page static -> dynamic

	// for the following, here is what is required:
	// getting information from the member_id + tune_id from the tuneSpec.php
	// will GET (for now) information in form format.

	// populate the member_id and tune_id variables
	// call the setTuneInfo function and then dump data on page in array form
	// populate the page with array data

	// the two get variables, member_id and the tune_id
	// var_dump($_GET);

	// next goal of this link is to bring it back into the tune page with the word cloud and related tunes
	// by recordings

	$member_id = $_GET["member_id"];
	$set_id = $_GET["set_id"];

	// need to make more dynamic by calling the member name of the user
	// by the call of the member
	$member_name = $_GET["name"];
	$title = $member_name."'s Set of Tunes";

	// import on header file for the web page
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_header.php';
	include '/Applications/MAMP/htdocs/SessionCURL/tuneSet.php';

	// now to call the function
?>

	<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<!-- PAGE HEADER FOR THE TITLE -->
	                <h1 class="page-header"><?=$member_name?>'s Set</h1>
	            </div>
	            <!-- may include some extra bits but not required at the moment -->
			</div>

			<?php

				// call the function for the members
				$a = setTuneInfo($member_id, $set_id);

				// the name of the combination of the set
				$t = json_decode($a, 1);
				// var_dump($t["name"]); 

				// echo $t["name"];
				for($i = 0; $i < count($t["settings"]); $i++){
			?>

			<!-- now having to put -->
			<div class="well" style="display:block; width:1280px;">
			  <div class="container">
			    <h3 class="display-3"><?php echo ($i+1).". ".$t["settings"][$i]["name"]?></h3>
			    <p class="lead">
			    	<div>
			    		abc: <?="".$t["settings"][$i]["abc"].""?>
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
			<!-- have another well div that indicates what the set of tunes mostly consists of -->
			<div class="well" style="display:none">
				<!-- have the set array for the tunes -->
				<!-- for the type of tunes for the settings info of the JSON array -->
			</div>
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