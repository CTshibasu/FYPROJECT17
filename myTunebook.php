<?php 
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// 11046
	$member_id = 110046;
	$page = 1;

	// my own tunebook - member_id

	// check if the get data is empty
	if(!empty($_GET)){
		$member_id = $_GET['memberID'];
		$name = $_GET['memberName'];
	}

	// paginate the results of the JSON
	if(!empty($_GET['pageNo'])){
		$page = intval($_GET['pageNo']);
	}

	// title of the webpage
	$title = "My Tunebook";

	// now to use the include files for the header and the
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_header.php';
	include '/Applications/MAMP/htdocs/SessionCURL/Tunebook.php';

?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<!-- PAGE HEADER FOR THE TITLE -->
                <h1 class="page-header"><?=$title?></h1>
            </div>
            <!-- may include some extra bits but not required at the moment -->
		</div>

			<!-- div for on... -->
			<?php
				// now call the function
				$a = getTunebook($member_id, $page);

				// create a for loop to access the tunes
				for($i = 0; $i < count($a["tunes"]); $i++){

					// in here we access every tune and make it into every module
					// $a[""]
			?>
			<!-- add another div row -->

			<!-- <div class="row"> -->
				<!-- may import the php into the section of the row -->

				<!-- preferably, loop the page on calls from the function, and repeat the modals -->
				
				<div class="well" style="display:inline-block; width:720px;">
				  <div class="container">
				    <h3 class="display-3">
				    	<a value="<?=$a["tunes"][$i]["id"]?>" href="tuneSpec.php?id=<?=$a["tunes"][$i]["id"]?>">
				    		<?php echo ($i+1).". ".$a["tunes"][$i]["name"];?>
				    	</a>
				    </h3> 
				    <!-- create a form for the name to connect to the relate page I'll make -->
				    <!-- <form class="relateRedir" data-tune_num="" method="GET" action="recRelate.php">
				    	<input type="hidden" value="<?=$a["tunes"][$i]["id"];?>">
				    	<input type="submit" value="<?=$a["tunes"][$i]["name"];?>"/>
				    </form> -->
				    <p class="lead">
				    	<!-- want to be able to create a form with the link -->
				    	<!-- click the type of tune -->

			    		<!-- hidden form with the value in it -->
			    		<form class="searchForm_" data-genre_id="<?=$i?>" style="" method="GET" action="searchRes.php">
			    			<!-- <input type="hidden" name="holder"> -->
			    			<input type="hidden" id="q_<?=$i?>" name="querySearch" value="<?=$a["tunes"][$i]["type"]?>">
			    			Type:  <input type="submit" value="<?=$a["tunes"][$i]["type"]?>" />
			    		</form>

			    		<!-- 2 inputs for the moving of pagination -->
			    		<input type="hidden" name="member_id" value="<?=$member_id?>">
			    		<input type="hidden" name="member_name" value="<?=$name?>">
			    		
			    	</p>
				    <p class="lead">
				    	<div>
				    		Date: <?=$a["tunes"][$i]["date"]?>
				    	</div>
			    	</p>
				  </div>
				</div>
				
			<!-- </div> -->
			<?php

				// end of loop
				}
			?>
			<nav aria-label="Page navigation" style="margin-left: 568px;">
	          <ul class="pagination pagination-lg">
	            <li>
	              <a href="#" aria-label="Previous">
	                <span aria-hidden="true">&laquo;</span>
	              </a>
	            </li>
	            <li class="bread" value="1"><a href="#">1</a></li>
	            <li class="bread" value="2"><a href="#">2</a></li>
	            <li class="bread" value="3"><a href="#">3</a></li>
	            <li class="bread" value="4"><a href="#">4</a></li>
	            <li class="bread" value="5"><a href="#">5</a></li>
	            <li>
	              <a href="#" aria-label="Next">
	                <span aria-hidden="true">&raquo;</span>
	              </a>
	            </li>
	          </ul>
	        </nav>
		</div>
		
		<!-- include footer.php -->
		<?php
			include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_footer.php';	
		?>

		<script type="text/javascript">

				// submit form
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
				               alert("There was an error submitting your details"); //if fails 
				               alert(errorThrown);   
				           }
				           }).responseText;
				});

				// clicking onto the breadcrumbs
				$('.bread').on('click', function(e){
					e.preventDefault();

				mID = $('input[name="member_id"]').val();
				mName = $('input[name="member_name"]').val();
				page = $(this).val();

				alert($(this).val());

				var $form = $('<form name="pageForm" method="GET" action="index.php"></form>');
				$form.append('<input type="hidden" name="pageNo" value="'+page+'">');

				// now submit the form data with the use of ajax
				var $formAJAX = $form,
				           formURL = $formAJAX.attr( "action" );
				           GETData = $formAJAX.serializeArray();
				
				           var result = $.ajax({
				               data: GETData,
				               type: 'POST',
				               url : formURL,
				               global: false,
				               async:false,
				           success:function(data, textStatus, jqXHR)
				           {
				               // if(data == '1') {
				               //   $formAJAX.hide();
				               // }else{
				               //   alert("ERROR: "+data);
				               //   return false;
				               // }
				               alert('success');
				               window.location.href = "index.php?memberID="+mID+"&memberName="+mName+"&pageNo="+page;
				
				           },
				           error: function(jqXHR, textStatus, errorThrown)
				           {
				               alert("There was an error submitting your details");//if fails    
				           }
				           }).responseText;
				// 	window.location.href = "index.php?memberID="+mID+"&memberName="+mName+"&page="+page;
				});

		</script>
	</html>
	</div>

<?php
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_footer.php';	
?>