<?php
$Type = $_POST['type'];
$Capacity = $_POST['capacity'];
$Version = $_POST['version'];
$Model = $_POST['Model'];
$MobNo = $_POST['MobNo'];
$Segment = $_POST['Segment'];
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
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `ee_program_list` WHERE `type`='".$Type."' AND `capacity`='".$Capacity."' AND `version`='".$Version."' AND `model`='".$Model."';";
echo $sql;
$result  = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    array_push( $EE_Data,$row);
  }
} else {
  echo "0 results";
}
// echo "<pre>";
// print_r($EE_Data[1]['segMnt_Two']);
// echo "</pre>";


if($Segment == '1'){
  $ee_seg = $EE_Data[1]['segMnt_Two'];
}
if($Segment == '2'){
  $ee_seg = $EE_Data[1]['segMnt_Three'];
}
if($Segment == '3'){
  $ee_seg = $EE_Data[1]['segMnt_Four'];
}
if($Segment == '4'){
  $ee_seg = "";
}

$sql = "UPDATE `live_updating_table` SET `data`='".$ee_seg."' WHERE `mobNo`='".$MobNo."';";
  $conn->query($sql);
  $conn->close();
//   echo "<pre>";
// print_r($sql);
// echo "</pre>";
?>


