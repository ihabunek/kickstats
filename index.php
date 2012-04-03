<?php

$base = dirname(__FILE__);
$config = parse_ini_file("$base/kickstats.ini", true) 
	or die ("Canot parse config.");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Kickstarter statistics</title>
</head>
<body>
	<h1>Kickstarter statistics</h1>
	<p>Configured projects:</p>
	<ul>
<?php foreach($config as $id => $project) { ?>
		<li><a href="chart.php?project=<?php echo $id ?>"><?php echo $project['name'] ?></a></li>
<?php } ?>
	</ul>
	
	<p>The idea and initial data set for Wasteland 2 was taken from <a target="_blank" href="http://ruinedkingdoms.com/wasteland2">Adam at ruinedkingdoms.com</a>.</p>
	<p>Read more and grab the source code on <a target="_blank" href="https://github.com/ihabunek/kickstarter-stats">GitHub</a>.</p>
</body>
</html>
