<?php
ob_start();
$hasDB = false;
$server = DB_SERVER;
$user = USER;
$pass = PASSWD;
$db = DB;
$link = mysqli_connect($server,$user,$pass);
if (!$link) {
	$hasDB = false;
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;

	//die("Could not connect to the MySQL server at localhost.");
} else {
	$hasDB = true;
	mysqli_select_db($link, DB);
}
