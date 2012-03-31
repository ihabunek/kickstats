<?php

// Want all times in GMT
ini_set('date.timezone', 'Etc/GMT+0');

$name = "wasteland-2";
$url = 'http://www.kickstarter.com/projects/inxile/wasteland-2';
$time = time();

echo "\n===============================================\n";
echo "Starting fetcher at: " . date('c', $time) . "\n";
echo "Loading page from $url\n";
$fp = fopen($url, 'r') or die("Unable to open file.");

$page = "";
$data = array();


// Read line by line to avoid loading the whole page
while (true) {
	$buffer = fgets($fp);
	if ($buffer == false) 
		break;
		
	$page .= $buffer;
	
	// Looking for two occurances of: <div class="num">...</div>
	if (preg_match('/<div class="num"/', $buffer)) 
	{
		$data[] = trim($buffer);
		if (count($data) == 2) 
			break;
	}
}

fclose($fp);

// Save the partially downloaded page (may be needed for debug)
$size = round(strlen($page) / 1024);
$filename =  "data/$name-$time";
echo "Saving page data ($size KB) to $filename\n";
file_put_contents($filename, $page);

// Check for errors
if (count($data) != 2) 
{
	die("Wrong data count.");
}

// First div is backers, second is pledged amount
$backers = strip_tags($data[0]);
$backers = strtr($backers, array(',' => ''));
$pledged = strip_tags($data[1]);
$pledged = strtr($pledged, array(',' => '', '$' => ''));

// JSONify the data
$microtime = $time * 1000;
$data = "[$microtime, $backers, $pledged],\n";

// Save processed data
echo "Saving data to $name.dat\n";
file_put_contents("$name.dat", $data, FILE_APPEND);

?>