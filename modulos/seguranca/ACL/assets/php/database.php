<?php
//session_start();
ob_start();
//include('modulos/../config/banco.php');

$hasDB = false;
$server = HOST;
$user = USER;
$pass = PASSWD;
$db = DB;
$link = mysql_connect($server,$user,$pass);
if (!is_resource($link)) {
    $hasDB = false;
    die("Could not connect to the MySQL server at localhost.");
} else {
    $hasDB = true;
    mysql_select_db($db);
}
