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
	include 'setsRelate.php';

	$res = json_decode(getTuneInfo($tune_id), 1);
	$title = "Tune: ".$res["name"];
	include 'inc_header.php';

	// to get the settings information on the selected tune 
	$settings = $res["settings"];

	// var_dump test
	// var_dump($res);
?>

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title>Chart.js demo</title>
			<!-- <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script> -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
			<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
			<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
		ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>
			<script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script> 
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

		        #containers{
	        	  margin: 20px;
				  width: 400px;
				  height: 8px;
		        }
			</style>
		</head>
		<body>
			<!--  -->
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<!-- PAGE HEADER FOR THE TITLE -->
		                <h1 class="page-header">
		                	<?=$title.' | <a value="'.$res["type"].'" href="searchres.php?querySearch='.$res["type"].'">'.strtoupper($res["type"]).'</a>'?>
	                	</h1>
		                <!-- <div >H</div> -->
		            </div>

					<!-- <div class="well" style="display:inline-block; width:1600px; height:600px;">
		                <h2 class="" style="margin-top: -5px">Settings for <?=" ".$res["name"]?></h2>
						<div id="faq" role="tablist" aria-multiselectable="true" style="margin-top:10px;">
							<?php 
								// going to be the beginning of a loop
								for($idx = 0; $idx < count($res["settings"]); $idx++){
							?>
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="Setting_<?=$idx?>">
									<h5 class="panel-title">
									<a data-toggle="collapse" data-parent="#faq" href="#answer_<?=$idx?>" aria-expanded="false" aria-controls="answer_<?=$idx?>">
									Setting<?=($idx+1)?>
									</a>
									</h5>
								</div>
								<div id="answer_<?=$idx?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Setting_<?=$idx?>">
									<div class="panel-body">
									<?php
										echo "<strong>Key:</strong><a> ".$res["settings"][$idx]["key"]."</a>";
										echo "<br><strong>ABC Notation:</strong> ".$res["settings"][$idx]["abc"];
									?>
									</div>
								</div>
							</div>
							<?php
								// going to be the end of a loop
								}
							?>
						</div>
					</div> -->
	                
		            <!-- may include some extra bits but not required at the moment -->
		            <div class="well" style="display:inline-block; width:1600px;height:500px;">
					    <div class="container">
					    	<span style="display:inline-block;margin:0;margin-left: -395px;margin-top:-520px;">
					    		<h3>Aliases for <?=$res["name"]?></h3>
					    	</span>
					    	<!-- contain the info on the tune -->
					    	<!-- <button type="button" id="fact" style="margin-left: 20px;width:50px" class="btn btn-info" data-toggle="popover" data-placement="right" title="What is This?" data-content="Below holds the aliases for the <?=$res["name"]?>">?</button> -->

					    	<!-- <a tabindex="0" class="btn btn-lg btn-primary" role="button" data-html="true" data-toggle="popover" data-trigger="focus" title="<b>Example popover</b> - title" data-content="<div><b>Example popover</b> - content</div>">?</a> -->

					    	<div class="w popper" width="650px" height="400px" style="margin-left: -190px;margin-top:-10px;">
								<!-- create the canvas element, will have the chart -->
								<div id="myChart" style="margin-top: 45px; width:450px; height:400px; display: inline-block;"></div>
							</div>
							<!-- <div id="charter" style="margin-top:11px;width:450px;height:400px"></div> -->
							<!-- <div class="" width="650px" height="300px" style="margin-left:500px;">
								<div class="Progress" style="margin-top: 20px;">
								    <span class="Progress-label">Tunebooks: <strong><?=$res["tunebooks"]?></strong></span>
								    <progress max="1000" value="<?=$res["tunebooks"]?>" class="Progress-main">
								        <div class="Progress-bar" role="presentation">
								            <span class="Progress-value" style="width: 80%;"> </span>
								        </div>
								    </progress>
								</div>
							</div>
							<div class="Progress" style="margin-top: 20px;">
							    <span class="Progress-label" style="margin-left: 100px;">Recordings: <strong><?=$res["recordings"]?></strong></span>
							    <progress max="1000" value="<?=$res["recordings"]?>" class="Progress-main">
							        <div class="Progress-bar" role="presentation">
							            <span class="Progress-value" style="width: 80%;"> </span>
							        </div>
							    </progress>
							</div>
							<div class="Progress" style="margin-top: 20px;">
							    <span class="Progress-label" style="margin-left: 100px;">Sets: <strong><?=$res["recordings"]?></strong></span>
							    <progress max="1000" value="<?=$res["recordings"]?>" class="Progress-main">
							        <div class="Progress-bar" role="presentation">
							            <span class="Progress-value" style="width: 80%;"> </span>
							        </div>
							    </progress>
							</div> -->
							
							</div>
							<?php
								// now extract the json using the tuneRelate function
								$resSet = json_decode(tuneRelate($tune_id), 1);
								$setInfo = $resSet["sets"];
							?>
							<!-- tunes set section -->
							<div class="container" style="display:inline-block; margin-left: 850px;margin-top:-800px;width:600px;height:400px;">
								<span style="display:block;margin:0;margin-left: -295px;margin-top:-20px;">
									<h3 style="<?php if(count($setInfo) == 0) echo "display:none;"?>;">Tunes sets with <?=$res["name"]."..."?></h3>
								</span>
								<!-- extract the data -->
								<!-- <div class="container" style="margin-top: -10px;"> -->
								 <?php

									// for loop going through the sets
									for($pos = 0; $pos < 3; $pos++){
										if(!isset($setInfo[$pos]["id"])){
											// do nothing...
										} else {
								?>
									<h3 class="display-3" style="margin-left: -290px;">
										<a value="<?=$setInfo[$pos]["id"]?>" href="#">
							    			<?php
							    				echo ($pos+1).". ".$setInfo[$pos]["name"];
							    			?>
							    		</a>
									</h3>
									<!-- hidden form to send to other page -->
									<form class="" style="display: none;">
										
									</form>
								<?php
										// create a hidden form that has the tune and member IDs
										// above this...
										}
									}
								?>
								<!-- direct the user to full list of available sets for the tune, page needs to be created for it -->
								<!-- check for the number of set info, if 0, set displays to none -->
								<a value="" href="#" style="<?php if(count($setInfo) == 0) echo "display:none;" ?>">
			    					<h5 class="display-3" style="margin-top:25px;">See More...</h5>
		    					</a>
							</div>
						</div>
						<!-- for the related sets for the tune -->
						
						</div>

						<div class="col-lg-12">
							<!-- PAGE HEADER FOR THE TITLE -->
			                <h1 class="page-header"><?="Related tunes for ".$res["name"]?></h1>
		            	</div>	
						<?php
							// put the related recording tunes to the 
							$recRelate = json_decode(relateRec($tune_id), 1);
							$recwith = $recRelate["recorded_with"];

							// for loop traversing the 
							for($idx = 0; $idx < count($recwith)/6; $idx++){
						?>
						<!-- the div -->
						<div class="well" style="display:inline-block; width:520px;height:200px">
							<!-- <?=count($recwith)?> -->
							<!-- for the name of the tune -->
							<h3 class="display-3">
				    			<!-- <a value="<?=$recwith[$idx]["id"]?>" href="tuneSpec.php?id=<?=$recwith[$idx]["id"]?>"> -->
			    				<?php echo ($idx+1).". ".$recwith[$idx]["name"];?>
				    			<!-- </a> -->
							</h3> 

							<p class="lead">
						    	<!-- want to be able to create a form with the link -->
						    	<!-- click the type of tune -->
					    		<!-- hidden form with the value in it -->
					    		<?php
					    			// going to have to get the individual information
					    			$tinfo = json_decode(getTuneInfo($tune_id), 1);
					    		?>

					    		<form class="searchForm_" data-genre_id="<?=$idx?>" style="" method="GET" action="searchRes.php">
					    			<input type="hidden" id="q_<?=$idx?>" name="querySearch" value="<?=$tinfo["type"]?>">
					    			Type:  <input type="submit" value="<?=$tinfo["type"]?>" />
					    		</form>
					    	</p>

					    	<!-- button -->
					    	<button class="btn btn-info" style="margin-top: 14px;margin-left:390px;">Add Tune</button>
					    	<!-- link for more information -->
							<a value="<?=$recwith[$idx]["id"]?>" href="tuneSpec.php?id=<?=$recwith[$idx]["id"]?>">
			    				<h5 class="display-3" style="margin-top:-10px;">See More...</h5>
			    			</a>
						</div>
						<?php
							}
						?>
						</div>
						 <!-- <div id="containers" style="margin-left:550px; margin-top: -300px">FOUND IN:</div> -->
						<!-- make a hidden input with text to call in the aliases and also the type -->
						<textarea style="display:none" id="getAliases">
						<?php
							// now for adding onto the string and info of colonel Fraser
							$strInput="";
							foreach($res["aliases"] as $key => $value){
								// append the aliases onto. the string
								$strInput .= $value." ";
							}
							echo $strInput;
						?>
						</textarea>
					</div> <!-- /.end of well -->
				</div>
			</div>

<?php
	include '/Applications/MAMP/htdocs/SessionCURL/adminUser/pages/inc_footer.php';	
?>
		</body>
	</html>
	<script type="text/javascript">
			var text = $('#getAliases').text();
			var myConfig = {
			  type: 'wordcloud',
			  options: {
			    text: text,
			    minLength: 4,
			    colorType: 'palette',
    			palette: ['#2196F3','#3F51B5','#42A5F5','#5C6BC0','#64B5F6','#7986CB','#90CAF9','#9FA8DA','#BBDEFB','#C5CAE9'],
				  style: {
				      fontFamily: 'Crete Round',
				      
				      hoverState: {
				        backgroundColor: '#BBDEFB',
				        borderRadius: 2,
				        fontColor: 'white'
				      },
				      tooltip: {
				        text: '%text: %hits',
				        visible: true,
				        
				        alpha: 0.9,
				        backgroundColor: '#1976D2',
				        borderRadius: 2,
				        borderColor: 'none',
				        fontColor: 'white',
				        fontFamily: 'Georgia',
				        textAlpha: 1
				      }
			      }
				}
			};
			
			// rendering configurations for it
			zingchart.render({ 
				id: 'myChart', 
				data: myConfig, 
				height: 400, 
				width: '100%' 
			});

			var myConfig = {
				backgroundColor:'#FBFCFE',
				 	type: "ring",
				 	title: {
				 	  text: "Monthly Page Views",
				 	  fontFamily: 'Lato',
				 	  fontSize: 14,
				 	  // border: "1px solid black",
				 	  padding: "15",
				 	  fontColor : "#1E5D9E",
				 	},
				 	subtitle: {
				 	  text: "06/10/16 - 07/11/16",
				 	  fontFamily: 'Lato',
				 	  fontSize: 12,
				 	  fontColor: "#777",
				 	  padding: "5"
				 	},
				 	plot: {
				 	  slice:'50%',
				 	  borderWidth:0,
				 	  backgroundColor:'#FBFCFE',
				 	  animation:{
				 	    effect:2,
				 	    sequence:3
				 	  },
				 	  valueBox: [
				 	    {
				 	      type: 'all',
				 	      text: '%t',
				 	      placement: 'out'
				 	    }, 
				 	    {
				 	      type: 'all',
				 	      text: '%npv%',
				 	      placement: 'in'
				 	    }
				 	  ]
				 	},
				  tooltip:{
				 	    fontSize:16,
				 	    anchor:'c',
				 	    x:'50%',
				 	    y:'50%',
				 	    sticky:true,
				 	    backgroundColor:'none',
				 	    borderWidth:0,
				 	    thousandsSeparator:',',
				 	    text:'<span style="color:%color">Page Url: %t</span><br><span style="color:%color">Pageviews: %v</span>',
				      mediaRules:[
				        {
				            maxWidth:500,
				       	    y:'54%',
				        }
				      ]
				  },
				 	plotarea: {
				 	  backgroundColor: 'transparent',
				 	  borderWidth: 0,
				 	  borderRadius: "0 0 0 10",
				 	  margin: "70 0 10 0"
				 	},
				 	legend : {
				    toggleAction:'remove',
				    backgroundColor:'#FBFCFE',
				    borderWidth:0,
				    adjustLayout:true,
				    align:'center',
				    verticalAlign:'bottom',
				    marker: {
				        type:'circle',
				        cursor:'pointer',
				        borderWidth:0,
				        size:5
				    },
				    item: {
				        fontColor: "#777",
				        cursor:'pointer',
				        offsetX:-6,
				        fontSize:12
				    },
				    mediaRules:[
				        {
				            maxWidth:500,
				            visible:false
				        }
				    ]
				 	},
				 	scaleR:{
				 	  refAngle:270
				 	},
					series : [
						{
						  text: "Docs",
							values : [106541],
							lineColor: "#00BAF2",
							backgroundColor: "#00BAF2",
							lineWidth: 1,
							marker: {
							  backgroundColor: '#00BAF2'
							}
						},
						{
						  text: "Gallery",
							values : [56711],
							lineColor: "#E80C60",
							backgroundColor: "#E80C60",
							lineWidth: 1,
							marker: {
							  backgroundColor: '#E80C60'
							}
						},
						{
						  text: "Index",
							values : [43781],
							lineColor: "#9B26AF",
							backgroundColor: "#9B26AF",
							lineWidth: 1,
							marker: {
							  backgroundColor: '#9B26AF'
							}
						}
					]
				};
				 
				zingchart.render({ 
					id : 'charter', 
				  data: {
				    gui:{
				      contextMenu:{
				        button:{
				          visible: true,
				          lineColor: "#2D66A4",
				          backgroundColor: "#2D66A4"
				        },
				        gear: {
				          alpha: 1,
				          backgroundColor: "#2D66A4"
				        },
				        position: "right",
				        backgroundColor:"#306EAA", /*sets background for entire contextMenu*/
				        docked: true, 
				        item:{
				          backgroundColor:"#306EAA",
				          borderColor:"#306EAA",
				          borderWidth: 0,
				          fontFamily: "Lato",
				          color:"#fff"
				        }
				      
				      },
				    },
				    graphset: [myConfig]
				  },
					height: '499', 
					width: '99%' 
				});

				// click button event
				$('.btn').on('click', function(e){
					e.preventDefault();

					alert('click!');
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