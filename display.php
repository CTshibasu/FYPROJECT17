<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	include 'inc_header.php';	
?>

<!-- <div id="canvas"></div> -->
<p class="text-center">
	<span class="bigtext">
		<b>TuneGraph - similar tunes</b>
	</span>
</p>
<div id="tuneGraphCanvas" class="divTuneGraphCanvas">
	<svg width="300px" height="300px"></svg>
</div>
<div id="tuneGraphScore" class="divTuneGraphScore" style="width:300px">
	<svg height="311.875" version="1.1" width="300.00000000000006" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.875px;">
	</svg>
</div>


<script src="TuneGraphViewer.js"></script>
<script src="d3.v3.min.js"></script>
<script src="abcjs_basic_1.10-min.js"></script>
<script>	
(function() {
TuneGraph('http://localhost:8886/SessionCURL/pg.php', 'tuneGraphCanvas', 'tuneGraphScore', 'tuneGraphAbc', false);
}());
</script>
<?php
	include 'inc_footer.php';
?>

