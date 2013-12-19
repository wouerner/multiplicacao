<?php
//session_start();
ob_start();
$hasDB = false;
$server = 'mysql08.wouerner.eti.br';
$user = 'wouerner17';
$pass = 'bdmultimga';
$db = 'wouerner17';
$link = mysql_connect($server,$user,$pass);
if (!is_resource($link)) {   
	$hasDB = false;
	die("Could not connect to the MySQL server at localhost.");
} else {   
	$hasDB = true;
	mysql_select_db($db);
}
?>
