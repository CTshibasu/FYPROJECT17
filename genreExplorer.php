<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// now to use the include files for the header and the...
	include '../../Tunebook.php';
    include '../../test_session.php';
	include '../../tuneSet.php';
	include 'recRelate.php';

	$title = "Genre Explorer";
	include 'inc_header.php';

?>
	<!-- this page is the for the treemap diagram -->
	<!DOCTYPE html>
	<html>
		<head>
			<script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
			<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
			ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>
			<style>
				html, body {
					height:100%;
					width:100%;
					margin:0;
					padding:0;
				}
				#myChart {
					height:600px;
					width:1000px;
					min-height:150px;
				}
				.zc-ref {
				  display:none;
				}
				select {
				  position:absolute;
				  z-index:1000;
				  bottom:5px;
				  left:10px;
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
		            <!-- <div class="well"> -->
			            <div class="wells" style="width:1000px;height:600px">
			            	<div id="myChart">
								<!-- <a class="zc-ref" href="https://www.zingchart.com/">Powered by ZingChart</a>
						        <select id ="treemap-layout">
							        <option selected value="balanced">Balanced</option>
							        <option value="balancedV2">Balanced(v2)</option>
							        <option value="random">Random</option>
							        <option value="horizontal">Horizontal</option>
							        <option value="vertical">Vertical</option>
							        <option value="squarify">Squarify</option>
							        <option value="squarifyV2">Squarify(v2)</option>
						        </select> -->
							</div>
			            </div>
						</div>
					<!-- </div> -->
				</div>
			

		<?php
			include 'inc_footer.php';
		?>
		</body>
	</html>

<!-- <script>
	var myConfig = {
    "graphset":[
        {
            "type":"treemap",
            "plotarea":{
                "margin":"0 0 30 0"
            },
            "tooltip":{
                
            },
            "options":{
                
            },
            "series":[
                {
                    "text":"North America",
                    "children":[
                        {
                            "text":"United States",
                            "children":[
                                {
                                    "text":"Texas",
                                    "value":21
                                },
                                {
                                    "text":"California",
                                    "value":53
                                },
                                {
                                    "text":"Ohio",
                                    "value":12
                                },
                                {
                                    "text":"New York",
                                    "value":46
                                },
                                {
                                    "text":"Michigan",
                                    "value":39
                                },
                                {
                                    "text":"Alabama",
                                    "value":25
                                }
                            ]
                        },
                        {
                            "text":"Canada",
                            "value":113
                        },
                        {
                            "text":"Mexico",
                            "value":78
                        }
                    ]
                },
                {
                    "text":"Europe",
                    "children":[
                        {
                            "text":"France",
                            "value":42
                        },
                        {
                            "text":"Spain",
                            "value":28
                        },
                        {
                            "text":"Switzerland",
                            "value":13
                        },
                        {
                            "text":"Germany",
                            "value":56
                        },
                        {
                            "text":"Cyprus",
                            "value":7
                        }
                    ]
                },
                {
                    "text":"Africa",
                    "children":[
                        {
                            "text":"Egypt",
                            "value":22
                        },
                        {
                            "text":"Congo",
                            "value":38
                        },
                        {
                            "text":"Lesotho",
                            "value":9
                        }
                    ]
                },
                {
                    "text":"Asia",
                    "children":[
                        {
                            "text":"India",
                            "value":92
                        },
                        {
                            "text":"China",
                            "value":68
                        },
                        {
                            "text":"Mongolia",
                            "value":25
                        }
                    ]
                },
                {
                    "text":"South America",
                    "children":[
                        {
                            "text":"Brazil",
                            "value":42
                        },
                        {
                            "text":"Argentina",
                            "value":28
                        },
                        {
                            "text":"Peru",
                            "value":15
                        },
                        {
                            "text":"Uruguay",
                            "value":33
                        }
                    ]
                },
                {
                    "text":"Australia (continent)",
                    "children":[
                        {
                            "text":"Australia (country)",
                            "value":121
                        },
                        {
                            "text":"New Zealand",
                            "value":24
                        }
                    ]
                }
            ]
        }
    ]
};
 
zingchart.render({ 
	id : 'myChart', 
	data : myConfig, 
	height: "100%", 
	width: "100%" 
});
</script> -->

<?php 
    // in order to create the treemap with the genres of my liking, then:
    // create an array and have it go through the elements, being the types
    // loop through it and get the 5 tunes of that get how many sets they may be in.. as 
    // a way to. get the number would be to get the no. of sets it belongs to ? (suggestion)
    // the loop will be nested...

    // create array of genres
    $genres = array("jigs", "reels", "slip+jigs", "hornpipes", "polkas", "slides", "waltzes", "barndances", "strathspeys", "three-twos", "marzukas");

    // after this, call the search function on each index of the array for the value of the array and use the values as input for the function
    // the nested loop will work on 2 levels

    // $idx = 0;
    $str = '<script type="text/javascript">
        var myConfig = {
            "graphset": [
                {
                    "type":"treemap",
                    "plotarea":{
                        "margin": "0 0 30 0"
                    },
                    "tooltip":{
                        
                    },
                    "options":{
                        
                    },

                    // loop will start here
                    "series": [';

    // inbetween these strings will be the two-level loop
    // using the outer loop, we traverse the array
    // use the regular loop infrastructure
    for($idx = 0; $idx < count($genres); $idx++){
        if($idx != 0){
            $str.= ",";
        }

        // foreach($genres as $key => $value){
        // now go through the values and call the search function
        $retresult = json_decode(get_search("tunes", $genres[$idx], 6), 1);
        // var_dump($retresult["tunes"]);

        // NOW for the loop
        $str.= '{
                "text": "'.$retresult["tunes"][0]["type"].'", 
                "children":[';

        // now have 5 tunes to reference from 
        // for loop for the jigs, some duplicate entries are present, so array_unique will work
        $tunes = array_unique($retresult["tunes"], SORT_REGULAR);

        // var_dump($tunes[5]["name"]);

        // now to actually go through the loop to make the children for jigs
        for($i = 0; $i < count($tunes); $i++){
            // now append the segments onto the string
            if($i != 0){
                $str .= ",";
            }

            // this will take the 5 names of the tunes in the array
            $str .= '{
                    "text": "'.$tunes[$i]["name"].'",
                    "value": 1
            }';
        }


    $str.=  ']
        }';

    // end of the loop
    }

    // closing of the myConfig dataset
    $str.=     ']
            }
        ]
    };
    ';

    // rendering the chart on the div
    $str.= 'zingchart.render({ 
            id : "myChart", 
            data : myConfig, 
            height: "100%", 
            width: "100%" 
        });
    </script>';

    echo $str;
?>




