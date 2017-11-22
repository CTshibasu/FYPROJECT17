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
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title>Chart.js demo</title>
			<script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
			<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
			<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
		ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>  
			<link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet">
			<style>
				.w {
		          position: relative;
		          height: 400px;
		          width: 400px;
		          float:left;
		          display:inline-block;
		          margin-top: 0px;
		        }
			</style>
		</head>
		<body>
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<!-- PAGE HEADER FOR THE TITLE -->
		                <h1 class="page-header"><?=$title?></h1>
		            </div>
		            <!-- may include some extra bits but not required at the moment -->
		           <div class="well" style="display:inline-block; width:650px;height:600px">
					    <div class="container">
					    	<!-- contain the info on the tune -->
					    	<div class="w" width="650px" height="400px">
								<!-- create the canvas element, will have the chart -->
								<div id="myChart" style="margin-top: 100px;" width="400px" height="400px"></div>
							</div>
							
							<div style="width:200px;height:200px;margin-left:450px;">
								Type: <a value="<?=$res["type"]?>" href=""><?=$res["type"]?></a><br>
								Key: <a value="<?=$res["settings"][0]["key"]?>" href=""><?=$res["settings"][0]["key"]?></a>
							</div>
						</div>
					</div>
					    
				</div>
			</div>

<?php
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_footer.php';	
?>
		</body>
	</html>
	<script type="text/javascript">
			var myConfig = {
			  type: 'wordcloud',
			  options: {
			    text: 'We the people of the United States, in order to form a more perfect union, establish justice, insure domestic tranquility, provide for the common defense, promote the general welfare, and secure the blessings of liberty to ourselves and our posterity, do ordain and establish this Constitution for the United States of America.',
			  }
			};
			 
			zingchart.render({ 
				id: 'myChart', 
				data: myConfig, 
				height: 400, 
				width: '100%' 
			});

			// var ctx = document.getElementById("myChart").getContext('2d');
			// var data = {
			// 	// These labels appear in the legend and in the tooltips when hovering different arcs
			//     labels: [
			//         'Red',
			//         'Yellow',
			//         'Blue'
			//     ],
			//     datasets: [
			// 	    {
			// 	        data: [10, 20, 30],
			// 	        backgroundColor: [
   //                                      '#66B266',
   //                                      '#7F7F7F'
   //                                  ],
   //                                  hoverBackgroundColor: [
   //                                      '#66B266',
   //                                      '#7F7F7F'
   //                                  ]
			// 	    }
			//     ]
			// };

			// var myDoughnutChart = new Chart(ctx, {
			//     type: 'doughnut',
			//     data: data,
			//     options: {
   //                        animation:{
   //                            animateScale:true
   //                        }
   //                	}
			// });
	</script>