<?php

// DB Setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ee_monitoring";
$liveDevData = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Data Acqusition
$sql = "SELECT * FROM `live_device` WHERE `status`='1';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// IF FOUND
	while($row = $result->fetch_assoc()) {
		$liveDevData .=  $row["device_Id"].",".$row["mob_no"].";";
	}
}
$conn->close();
print_r ($liveDevData);
?>