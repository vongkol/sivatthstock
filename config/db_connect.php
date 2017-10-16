<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stocksivattha";
	
// creating the connection
$connect = new mysqli($servername, $username, $password, $dbname);

// checking the connection
if(!$connect->connect_error) {
	// echo "Successfully connected";
}
else {
	die("Connection Failed : " . $connect->connect_error);
}