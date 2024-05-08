<?php

$Type = $_POST['type'];
$Capacity = $_POST['capacity'];
$Version = $_POST['version'];
$Model = $_POST['Model'];
$MobNo = $_POST['MobNo'];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ee_monitoring";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `live_device` SET `cmd`='3' WHERE `mob_no`='".$MobNo."';";

$conn->query($sql);
$conn->close();



?>