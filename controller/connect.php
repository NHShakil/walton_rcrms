<?php

//print_r($_GET['data']);
$data = explode(",", $_GET['data']);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ee_monitoring";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO `live_device` (`id`, `device_Id`, `mob_no`, `status`,`created`, `modified`) VALUES (NULL, '".$data[0]."', '".$data[1]."','1', current_timestamp(), current_timestamp());";

//INSERT INTO `live_device` (`id`, `device_Id`, `mob_no`, `status`, `created`, `modified`) VALUES (NULL, '5', NULL, '0', current_timestamp(), current_timestamp());

//INSERT INTO `live_device` (`id`, `device_Id`, `mob_no`, `status`,`created`, `modified`) VALUES (NULL, '".$data[0]."', '01675702741,'1', current_timestamp(), current_timestamp());





echo $sql;
if ($conn->query($sql) === TRUE) {
	//echo "New record created successfully";
} else {
	//echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



?>