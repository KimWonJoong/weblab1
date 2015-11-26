<?php
$SONGS_FILE = "songs_shuffled.txt"; //or songs.txt
if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request - This service accepts only GET requests.");
}
$top = "";
if (isset($_REQUEST["top"])) {
	$top = preg_replace("/[^0-9]*/", "", $_REQUEST["top"]);
}
if (!file_exists($SONGS_FILE)) {
	header("HTTP/1.1 500 Server Error");
	die("ERROR 500: Server error - Unable to read input file: $SONGS_FILE");
}
header("Content-type: application/json");
print "{\n  \"songs\": [\n";

/* songs.txt
$lines = file($SONGS_FILE);
for ($i = 0; $i < count($lines); $i++) {
	list($title, $artist, $rank, $genre, $time) = explode("|", trim($lines[$i]));
	if ($rank == $top) {
		print "\t{\"rank\":\"$rank\",\"title\":\"$title\",\"artist\":\"$artist\",\"genre\":\"$genre\",\"time\":\"$time\"}\n";
	}
	else if ($rank < $top) {
		print "\t{\"rank\":\"$rank\",\"title\":\"$title\",\"artist\":\"$artist\",\"genre\":\"$genre\",\"time\":\"$time\"},\n";
	}
}
*/

$lines = file($SONGS_FILE);
$ranking = 1;
for ($i = 0; $i < count($lines); $i++) {
	list($title, $artist, $rank, $genre, $time) = explode("|", trim($lines[$i]));
	if ($ranking == $rank) {
		if ($rank < $top) {
			print "{\"rank\": \"$rank\", \"title\": \"$title\", \"artist\": \"$artist\", \"genre\": \"$genre\", \"time\": \"$time\"},\n";
			$i = -1;
			$ranking++;
		}
		else if ($rank == $top) {
			print "{\"rank\": \"$rank\", \"title\": \"$title\", \"artist\": \"$artist\", \"genre\": \"$genre\", \"time\": \"$time\"}\n";
			break;
		}
	}
}
print "  ]\n}\n";
?>