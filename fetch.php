<?php

$base = dirname(__FILE__);
$time = time();

// Want all times in GMT
ini_set('date.timezone', 'Etc/GMT+0');

echo "\n=====================================================\n";
echo "Starting fetcher script at: " . date('c', $time) . "\n";

if (!is_dir("$base/data")) 
{
	echo "Creating data directory\n";
	mkdir("$base/data") or die("Cannot create data directory.\n");
}

// Process config
$config = parse_ini_file("$base/kickstats.ini", true) 
	or die("Cannot load config.\n");

foreach($config as $id => $item)
{
	// Check required config options
	if(!isset($item['name'])) die("Missing 'name' option for group '$id'.");
	if(!isset($item['url'])) die("Missing 'url' option for group '$id'.");

	extract($item); // Creates $name, $url

	// Load data from kickstarter url
	list($backers, $pledged) = fetchKickData($url);
	
	// JSONify the data
	$microtime = $time * 1000;
	$line = "[$microtime, $backers, $pledged],\n";

	// Save processed data
	echo "Saving data to data/$id.dat\n";
	file_put_contents("$base/data/$id.dat", $line, FILE_APPEND);
}

// Fetches pledges and backers from a kickstarter page
function fetchKickData($url)
{
	echo "Loading data from $url\n";
	$fp = fopen($url, 'r') or die("Unable to open file.");
	
	$data = array();

	// Read line by line to avoid loading the whole page
	while (true) {
		$buffer = fgets($fp);
		if ($buffer == false) 
			break;
			
		// Looking for two occurances of: <div class="num">...</div>
		if (preg_match('/<div class="num"/', $buffer)) 
		{
			$data[] = trim($buffer);
			if (count($data) == 2) 
				break;
		}
	}

	fclose($fp);
	
	// Check for errors
	if (count($data) != 2) 
		die("Wrong data count.\n");

	// First div is backers, second is pledged amount
	$backers = strip_tags($data[0]);
	$backers = strtr($backers, array(',' => ''));
	$pledged = strip_tags($data[1]);
	$pledged = strtr($pledged, array(',' => '', '$' => ''));
	
	echo "Found $backers backers, pledged \$$pledged\n";
	
	return array($backers, $pledged);
}

?>
