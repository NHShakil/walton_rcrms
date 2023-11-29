<?php
$pram = explode(",",$_GET['Data']);

$versionList = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ee_monitoring";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT `version` FROM `ee_program_list` WHERE `type`='".$pram[1]."' AND `capacity`='".$pram[0]."'; ";
//echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		//array_push( $versionList,$row);
		//echo $row['version'];
		$versionList .= $row['version'].",";
	}
} else {
	$versionList .= ("No Version Found,");
}
$conn->close();

$versionList = rtrim($versionList,",");
echo $versionList;
?>