<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// include file for the calling of the function
	include 'recRelate.php';
	include '../../Tunebook.php';
	include '../../tuneSet.php';
	include 'setsRelate.php';

	// now to dump the page info: the information on the set onto the page
	// two things that should be returned because of the use of GET would be the member_id and the set_id
	// this will give me the full info 

	// 2 of the variables
	// $member_id = $_GET["member_id"];
	$tune_id = 1209; // make it dynamic
	// $_GET["tune_id"]

	$title = "Set List";
	// using the full setting of the tune sets
	// return the list [...]

	// run the function of getting sets tuneRelate
	$setList = json_decode(tuneRelate($tune_id), true);
	// var_dump($setList);

	// now include the header file
	include 'inc_header.php';
?>

	<!-- body of the page -->
	<!DOCTYPE html>
	<html>
		<head>
			<!-- <title> -->
		</head>
		<body>
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<!-- PAGE HEADER FOR THE TITLE -->
		                <h1 class="page-header">
		                	Sets Colonel Fraser's found in
	                	</h1>
		                <!-- <div></div> -->
		            </div>
		            <?php
		            	// beginning of the loop
		            	for($i=0; $i < count($setList["sets"]); $i++){
		            ?>
		            <!-- have the use of a loop to get the div for the set lists -->
		            <div class="well" style="display:inline-block; width:800px;height:180px;">
		            	<!-- the contents for the links of sets: -->
		            	<!-- list as follows: the name of the sets, who was uploaded by, how long ago it was operated -->
		            	<div class="container">
		            		<!-- the inside of the div -->
		            		<h3 class="display-3">
		            			<!-- in the content put the link in -->
		            			<a value="<?=$setList["sets"][$i]["name"]?>" href="#">
		            				<!-- name of the tune... -->
		            				<?=$setList["sets"][$i]["name"]?>
		            			</a>
							</h3> 


	            			<!-- for the name of who uploaded -->
	            			<!-- have the set id and the member_id to get the sets -->
	            			<p class="lead">
	            				<!-- information of who created the set -->
	            				<!-- Created by: <?=$setList["sets"][$i]["member"]["name"]?> -->

	            				<!-- the form for the page -->
	            				<form class="searchForm_" data-member_id="<?=$i?>" method="GET" action="CF.php">
	            					<!-- the hidden inputs for the tunebook and the set info -->
	            					<input type="hidden" id="mem_id_<?=$i?>" value="<?=$setList["sets"][$i]["member"]["id"]?>">
	            					<input type="hidden" id="set_id_<?=$i?>" value="<?=$setList["sets"][$i]["id"]?>">

	            					Created by: <input type="submit" id="m_name_<?=$i?>" value="<?=$setList["sets"][$i]["member"]["name"]?>" />
	            				</form>
	            			</p>

	            			<!-- how long ago it was put up -->
	            			<p class="lead">
	            				<div>
	            					Date : <?=$setList["sets"][$i]["date"]?>
	            				</div>
	            			</p>
		            	</div>
		            </div>
		            <?php 
		            	// end of the loop
		        		}
		            ?>
		        </div>
		    </div>
		</body>

	</html>

	<!-- get the javascript -->
	

<?php
	// include the footer
	include 'inc_footer.php';

	// EXAMPLE FOR THE DATASET
	// array(4) {
	//   ["format"]=&gt;
	//   string(4) "json"
	//   ["pages"]=&gt;
	//   int(1)
	//   ["page"]=&gt;
	//   int(1)
	//   ["sets"]=&gt;
	//   array(3) {
	//     [0]=&gt;
	//     array(5) {
	//       ["id"]=&gt;
	//       int(10355)
	//       ["name"]=&gt;
	//       string(37) "Colonel Fraser’s, Rakish Paddy."
	//       ["url"]=&gt;
	//       string(47) "https://thesession.org/member/110046/sets/10355"
	//       ["date"]=&gt;
	//       string(19) "2017-11-12 12:48:47"
	//       ["member"]=&gt;
	//       array(3) {
	//         ["id"]=&gt;
	//         int(110046)
	//         ["name"]=&gt;
	//         string(18) "Corneille Tshibasu"
	//         ["url"]=&gt;
	//         string(37) "https://thesession.org/members/110046"
	//       }
	//     }
	//     [1]=&gt;
	//     array(5) {
	//       ["id"]=&gt;
	//       int(8596)
	//       ["name"]=&gt;
	//       string(40) "The Morning Dew, Colonel Fraser’s."
	//       ["url"]=&gt;
	//       string(46) "https://thesession.org/member/100864/sets/8596"
	//       ["date"]=&gt;
	//       string(19) "2017-07-22 01:56:12"
	//       ["member"]=&gt;
	//       array(3) {
	//         ["id"]=&gt;
	//         int(100864)
	//         ["name"]=&gt;
	//         string(13) "Jack Braddick"
	//         ["url"]=&gt;
	//         string(37) "https://thesession.org/members/100864"
	//       }
	//     }
	//     [2]=&gt;
	//     array(5) {
	//       ["id"]=&gt;
	//       int(1154)
	//       ["name"]=&gt;
	//       string(37) "Colonel Fraser’s, The Old Bush."
	//       ["url"]=&gt;
	//       string(44) "https://thesession.org/member/1015/sets/1154"
	//       ["date"]=&gt;
	//       string(19) "2016-03-13 17:09:29"
	//       ["member"]=&gt;
	//       array(3) {
	//         ["id"]=&gt;
	//         int(1015)
	//         ["name"]=&gt;
	//         string(7) "macduff"
	//         ["url"]=&gt;
	//         string(35) "https://thesession.org/members/1015"
	//       }
	//     }
	//   }
	// }



	
?>
<script type="text/javascript">

			// get the ids of the 
			$('.searchForm_').submit(function(e){
				e.preventDefault();
				// submit the content of the form

				// test for the member_id for the form
				var select = $(this).data("member_id");
				var mindex = $("#mem_id_"+select).val();
				var sindex = $("#set_id_"+select).val();
				var m_name = $("#m_name_"+select).val();

				// alert(select);

				var $form = $( this ),
				           formURL = $form.attr( "action" );
				           postData = $form.serializeArray();
				
				           var result = $.ajax({
				               data: postData,
				               type: 'POST',
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
				               // redirect the page: to the setOfTunes.php page
				               window.location.href = "setOfTunes.php?member_id="+mindex+"&set_id="+sindex+"&name="+m_name;
				
				           },
				           error: function(jqXHR, textStatus, errorThrown)
				           {
				               alert("There was an error submitting your details");//if fails    
				           }
				           }).responseText;

			});

			// another section...
		</script>
	