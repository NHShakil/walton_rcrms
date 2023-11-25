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

// Inactive Device Data Acqusition
$sql = "SELECT * FROM `live_device` WHERE `status`='0';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// IF FOUND
	while($row = $result->fetch_assoc()) {
		// Making JSON Data
		$liveDevData .= $row["mob_no"].",";
	}
}
$liveDevData = rtrim($liveDevData, ",");
$liveDevData .= ";";

// Active Device Data Acqusition
$sql = "SELECT * FROM `live_device` WHERE `status`='1';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// IF FOUND
	while($row = $result->fetch_assoc()) {
		// Making JSON Data
		$liveDevData .= $row["mob_no"].",";
	}
}
$conn->close();
$liveDevData = rtrim($liveDevData, ",");
// Return Data
print_r ($liveDevData);
?>