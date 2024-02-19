<?php
$Type = $_POST['type'];
$Capacity = $_POST['capacity'];
$Version = $_POST['version'];
$Model = $_POST['Model'];
$MobNo = $_POST['MobNo'];
//$Segment = $_POST['Segment'];
// $Type = $_GET['type'];
// $Capacity = $_GET['capacity'];
// $Version = $_GET['version'];
// $Model = $_GET['Model'];
// $MobNo = $_GET['MobNo'];
// $Segment = $_GET['Segment'];
$EE_Data = array("");



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ee_monitoring";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_errordd);
}


$sql = "SELECT `odu_ee` AS `ODU_EE_CHK_SUM` FROM `dev_last_sts` WHERE `mob_no`='".$MobNo."';";
//echo $sql;
$result  =$conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data = ($row['ODU_EE_CHK_SUM']);
  }
} else {
  print_r("0X0000");
}
$conn->close();
print_r ($data);
?>


