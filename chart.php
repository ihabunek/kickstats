<?php

// Config
$base = dirname(__FILE__);
$config = parse_ini_file("$base/kickstats.ini", true) 
	or die ("Canot parse config.");
	
if (!isset($_REQUEST['project']))
	die("No project defined.");
	
$id = $_REQUEST['project'];

if (!isset($config[$id]))
	die("No config for project '$id'");

$name = $config[$id]['name'];
$url = $config[$id]['url'];

// Load chart data
$filename = "data/$id.dat";

if (!file_exists("$base/$filename"))
	die ("No data for project [$id]. Wait a little.");

$json = file_get_contents("$base/$filename") 
	or die ("Cannot load data from [$filename].");
$json = "[$json]";

?>
<html>
<head>
	<title>Kickstarter pledges for <?php echo $name ?></title>
	<style type="text/css">
		.content { width: 1000px; margin: auto; }
		p { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; margin: 0 0 10px 0; }
		#container { margin-bottom: 40px; }
	</style>
	<script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="lib/highstock/highstock.js"></script>
	<script type="text/javascript">
		var chart;
		var data = <?php echo $json; ?>;
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
				global: {
					useUTC: false
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
	<div class="content">
		<p><a href=".">&lt; Back to project list</a></p>
		<div id="container" style="height: 500px; width: 900px"></div>
		
		<p>Pledge statistics for kickstarter project <a target="_blank" href="<?php echo $url; ?>"><?php echo $name; ?></a>.</p>
		<p>Data updated hourly. All times are GMT.</p>
		<p>Get the data <a href="<?php echo "$filename"; ?>">here</a></p>
	</div>
</body>
</html>
