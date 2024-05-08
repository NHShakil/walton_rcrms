<?php
// DATA Formate For ALL available Data



// DATA Formate For NO available Data



// PRAM Packet Explanation
// Device ID   		= $pram[0]
// Mobile No   		= $pram[1]
// Signal Level 	= $pram[2]

// Seial Data Structure
// Packet No One   	= $pram[3]
// Packet No Two   	= $pram[4]
// Compressor Pack	= $pram[5]

// EE DATA
// IDU EE Data   	= $pram[6]
// ODU EE Data   	= $pram[7]

// EE Port Status
// EE Port Found  	= $pram[8]

$rcvData = $_GET['data'];
$pram = explode("-", $rcvData);
// DB Setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ee_monitoring";
$DBMatchtID = "";

$pram[3]=(isset($pram[3]) === true && empty($pram[3]) === true) ? "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0" : $pram[3];

$pram[4]=(isset($pram[4]) === true && empty($pram[4]) === true) ? "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0" : $pram[4];

$pram[5]=(isset($pram[5]) === true && empty($pram[5]) === true) ? "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0" : $pram[5];

$pram[6]=(isset($pram[6]) === true && empty($pram[6]) === true) ? "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0" : $pram[6];

$pram[7]=(isset($pram[7]) === true && empty($pram[7]) === true) ? "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0" : $pram[7];
//echo "<pre>";print_r($pram);echo "</pre>";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Creat LOG
$sql = "INSERT INTO `log` (`id`, `mob_no`, `data`, `created`, `modified`) VALUES (NULL, ".$pram[1].", '".$rcvData."', current_timestamp(), current_timestamp());";
$conn->query($sql);
// Check Availiability
$sql = "SELECT * FROM `dev_last_sts` WHERE `dev_id`='".$pram[0]."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// IF FOUND
	while($row = $result->fetch_assoc()) {
		$DBMatchtID =  $row["id"];
	}
		// UPDATE Device Last status Table
		//$sql = "UPDATE `dev_last_sts` SET `mob_no`='".$pram[1]."',`signal_Lvl`='".$pram[2]."',`serial_pac_one`='".$pram[3]."',`serial_pac_two`='".$pram[4]."',`serial_pac_three`='".$pram[5]."',`idu_ee`='".$pram[6]."',`modified`=current_timestamp() WHERE `id`='".$DBMatchtID."'; ";

	$sql = "UPDATE `dev_last_sts` SET `mob_no`='".$pram[1]."',`signal_Lvl`='".$pram[2]."',`serial_pac_one`='".$pram[3]."',`serial_pac_two`='".$pram[4]."',`serial_pac_three`='".$pram[5]."',`idu_ee`='".$pram[6]."',`odu_ee`='".$pram[7]."',`ee_port_sts`='".$pram[8]."',`modified`=current_timestamp() WHERE `id`='".$DBMatchtID."';";

	$conn->query($sql);
		// UPDATE Device Last status Table
	$sql = "UPDATE `live_device` SET `mob_no`='".$pram[1]."',`status`='1',`modified`=current_timestamp() WHERE `device_Id` = '".$pram[0]."';";
	$conn->query($sql);


} else {
		// IF NOT FOUND
		// Creat New Row in Device Last status Table
	$sql = "INSERT INTO `dev_last_sts` (`id`, `dev_id`, `mob_no`, `signal_Lvl`, `serial_pac_one`, `serial_pac_two`,`serial_pac_three`, `idu_ee`, `odu_ee`,`ee_port_sts`, `created`, `modified`) VALUES (NULL, '".$pram[0]."','".$pram[1]."','".$pram[2]."','".$pram[3]."','".$pram[4]."','".$pram[5]."','".$pram[6]."','".$pram[7]."','".$pram[8]."', current_timestamp(), current_timestamp());";
	$conn->query($sql);
		// Creat New Row in Live status Table of device
	$sql = "INSERT INTO `live_device` (`id`, `device_Id`, `mob_no`, `status`, `created`, `modified`) VALUES (NULL, ".$pram[0].", ".$pram[1].", '1', current_timestamp(), current_timestamp());";
	$conn->query($sql);

}

$sql = "SELECT * FROM `live_device` WHERE `mob_no`='".$pram[1]."';";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$opCMD =  $row["cmd"].",";
	}
}
		//echo $opCMD."-------";
$EE_Data = "";
//$opCMD = 0;
		// Server Connectivity only. Nocommand for Device
if($opCMD == 0){
	$EE_Data .= "SRV,0,";
}
		// Serail Communication Only
else if($opCMD == 1){
	$EE_Data .= "SRL,1,";
}
		// Write IDU CheckSUM
else if($opCMD == 2){
	$EE_Data = "WIC,2,";
	$sql = "SELECT * FROM `live_updating_table` WHERE `mobNo`='".$pram[1]."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$EE_Data .=  $row["data"];
		}
	}
	$conn->close();
	//echo $EE_Data;
}
		// Write ODU CheckSUM
else if($opCMD == 3){
	$EE_Data = "WOC,3,";
	$sql = "SELECT * FROM `live_updating_table` WHERE `mobNo`='".$pram[1]."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$EE_Data .=  $row["data"];
		}
	}
	$conn->close();
}


		// Read IDU CheckSUm
else if($opCMD == 4){
	$EE_Data .= "RIC,4,";
}
		// Read ODU CheckSUm
else if($opCMD == 5){
	$EE_Data .= "ROC,5,";
}	
else{
	$EE_Data .= "SRV,0,";
}

print_r($EE_Data);
?>