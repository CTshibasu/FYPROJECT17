<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// now to incorporate another viz diagram [...]
	// preferably being able to click the chart to be able to get the name
	// ot the particular section, put into the search word or name of the label and put
	// that particular label into the php function pull data relevant to the label of the chart
	// manipulate the parameter of the function and return JSON to further extract and present in
	// a readable way...

	// first things first get a sample of a chart with and attach labels on them

	// import the function page
	include '/Applications/MAMP/htdocs/SessionCURL/test_session.php';
?>

<!-- start with the  -->
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
			<div class="w" width="400px" height="400px">
				<!-- create the canvas element, will have the chart -->
				<canvas id="myChart" width="290px" height="290px"></canvas>
			</div>
		</body>

		<!-- the javascript code to initialize the doughnut chart -->
		<script type="text/javascript">

			var ctx = document.getElementById("myChart").getContext('2d');
			var data = {
				// These labels appear in the legend and in the tooltips when hovering different arcs
			    labels: [
			        'Red',
			        'Yellow',
			        'Blue'
			    ],
			    datasets: [
				    {
				        data: [10, 20, 30],
				        backgroundColor: [
                                        '#66B266',
                                        '#7F7F7F'
                                    ],
                                    hoverBackgroundColor: [
                                        '#66B266',
                                        '#7F7F7F'
                                    ]
				    }
			    ]
			};

			var myDoughnutChart = new Chart(ctx, {
			    type: 'doughnut',
			    data: data,
			    options: {
                          animation:{
                              animateScale:true
                          }
                  	}
			});
		</script>
	</html>
