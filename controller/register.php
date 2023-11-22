<?php


$devCode = strtoupper( substr($_POST['zone'],0,3).substr($_POST['subZone'],0,3).substr($_POST['mobNo'],-4));



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

$sql = "INSERT INTO `device_info` (`dev_id`, `zone`, `sub_zone`, `mobile_no`,`dev_code`, `status`, `created`, `modified`) VALUES (NULL, '".$_POST['zone']."', '".$_POST['subZone']."', '".$_POST['mobNo']."','".$devCode."', '0', current_timestamp(), current_timestamp());";

if ($conn->query($sql) === TRUE) {
  //echo "New record created successfully";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: http://localhost/ac_monitoring/index.php');

exit;


?>