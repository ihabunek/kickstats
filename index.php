<!DOCTYPE html>
<?php

// Config
$name = "Wasteland 2";
$url = "http://www.kickstarter.com/projects/inxile/wasteland-2/";
$filename = "wasteland-2.dat";

// Load data
$data = file_get_contents($filename) 
	or die ("Cannot load data from $filename.");
$data = "[$data]";

?>
<html>
<head>
	<title>Kickstarter pledges for <?php echo $name ?></title>
	<script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="lib/highstock/highstock.js"></script>
	<script type="text/javascript">
		var chart;
		var data = <?php echo $data; ?>;
		var length = data.length;
		
		var pledgesData = [];
		var diffData = [];
		
		$(function() {
			// Prepare the series data
			for (var i = 0; i < length; i++) {
				// Total pledged amount
				pledgesData.push([
					data[i][0],
					data[i][2]
				]);
				
				// Amount pledged in the last hour
				if (i > 0) {
					diffData.push([
						data[i][0], 
						data[i][2] - data[i-1][2]
					]);
				}
			}
			
			chart = new Highcharts.StockChart({
				chart : {
					renderTo : 'container'
				},
				title : {
					text : "Kickstarter pledges for <?php echo $name ?>"
				},
				xAxis: {
					minRange: 24*60*60*1000, // max zoom: 1 day
					range: 3*24*60*60*1000, // default zoom: 3 days
				},
				yAxis: [{
					title: { text: 'Total pledged (US$)' },
					height: 200,
					lineWidth: 2
				}, {
					title: { text: 'Hourly (US$)' },
					top: 300,
					height: 100,
					offset: 0,
					lineWidth: 2,
				}],
				
				series : [{
					name : 'Total',
					data : pledgesData,
				}, {
					name : 'Hourly',
					data : diffData,
					type: 'column',
					yAxis: 1,
				}]
			});
		});
	</script>
</head>
<body>
	<div id="container" style="height: 500px; width: 900px"></div>
	
	<p>Pledge statistics for the <a target="_blank" href="<?php echo $url; ?>"><?php echo $name; ?></a> kickstarter project by Brian Fargo.</p>
	<p>Data since 17.03.2012. Updated hourly. All times are GMT.</p>
	<p>The idea and initial data set was taken from <a target="_blank" href="http://ruinedkingdoms.com/wasteland2">Adam at ruinedkingdoms.com</a></p>
	<p>Read more and grab the source code on <a target="_blank" href="https://github.com/ihabunek/kickstarter-stats">GitHub</a>.</p>
	<p>Get the data: <a href="<?php echo $filename; ?>">here</a></p>
</body>
</html>
