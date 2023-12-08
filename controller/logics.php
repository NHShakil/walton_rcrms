<?php 

function FaultByteChecker($DataVal,$Color)
{	
	$Fault_reason = array(
		"Selection model",
		"Ta sensor",
		"Tc sensor",
		"Td sensor",
		"ODU Communication Fault",
		"ODU Fan",
		"Compressor Drive",
		"IPM"
	);

	$Bits =array_reverse(str_split(sprintf('%08b',  $DataVal),1));
	$result = array("");
	foreach ($Bits as $key => $value) {
		if($value == 1){
			array_push($result,$Fault_reason[$key],$Color[1]);
			break;
		}
	}	
	//echo "<pre>";print_r($result);echo "</pre>";
	return $result;
}

function ProtectionByteChecker($DataVal,$Color)
{	
	$Protection_reason = array(
		"Tr",
		"Tc",
		"Te",
		"Ta",
		"AC current ",
		"AC voltage ",
		"Compressor drive ",
		"Td"
	);

	$Bits =array_reverse(str_split(sprintf('%08b',  $DataVal),1));
	$result = array("");
	foreach ($Bits as $key => $value) {
		if($value == 1){
			array_push($result,$Protection_reason[$key],$Color[1]);
			break;
		}
	}	
	//echo "<pre>";print_r($result);echo "</pre>";
	return $result;
}

function LimitByteChecker($DataVal,$Color)
{	
	$Limit_reason = array(
		"Phase current",
		"Tipm",
		"Tc",
		"Te",
		"Ta",
		"Voltage",
		"Over current",
		"Td"
	);

	$Bits =array_reverse(str_split(sprintf('%08b',  $DataVal),1));
	$result = array("");
	foreach ($Bits as $key => $value) {
		if($value == 1){
			array_push($result,$Limit_reason[$key],$Color[1]);
			break;
		}
	}	
	//echo "<pre>";print_r($result);echo "</pre>";
	return $result;
}


function DownFreqByteChecker($DataVal,$Color)
{	
	$DownFreq_reason = array(
		"Tc",
		"Te",
		"Td",
		"Input AC Current",
		"Phase Current",
		"Tipm",
	);

	$Bits =array_reverse(str_split(sprintf('%08b',  $DataVal),1));
	$result = array("");
	foreach ($Bits as $key => $value) {
		if($value == 1){
			array_push($result,$DownFreq_reason[$key],$Color[1]);
			break;
		}
	}	
	//echo "<pre>";print_r($result);echo "</pre>";
	return $result;
}

function ERRCodeDetection($DataVal)
{
	switch ($DataVal) {
		case 1:
		return "Acceleration overcurrent";
		break;

		case 2:
		return "Deceleration overcurrent";
		break;

		case 3:
		return "Constant speed overcurrent";
		break;

		case 4:
		return "Acceleration overvoltage";
		break;

		case 5:
		return "Deceleration overvoltage";
		break;

		case 6:
		return "Constant speed overvoltage";
		break;

		case 7:
		return "Bus undervoltage";
		break;

		case 8:
		return "Out of step fault";
		break;

		case 9:
		return "Motor phase failure";
		break;

		case 10:
		return "IGBT module protection";
		break;

		case 16:
		return "Motor reverse connection fault";
		break;

		case 19:
		return "Abnormal current detection circuit";
		break;

		case 129:
		return "Compressor out of step";
		break;

		case 130:
		return "VDC overvoltage";
		break;

		case 131:
		return "VDC undervoltage";
		break;

		case 132:
		return "Compressor overcurrent";
		break;

		case 133:
		return "Sampling circuit error";
		break;

		case 134:
		return "Driver pin error";
		break;

		case 135:
		return "Non existing FAN";
		break;

		case 136:
		return "FAN IPM error";
		break;

		case 137:
		return "Compressor wire/lock";
		break;

		case 138:
		return "pfc sensor error";
		break;

		case 139:
		return "PFC_DC overvoltage";
		break;

		case 140:
		return "PFC_DC undervoltage";
		break;

		case 141:
		return "PFC_VIN overvoltage";
		break;

		case 142:
		return "PFC_VIN undervoltage";
		break;

		case 143:
		return "PFC over-current";
		break;

		case 144:
		return "invalid zero cross period";
		break;
		
		default:
		return "NO ERROR FOUND";
		break;
	}
}

function modeDetection($DataVal)
{	
	$ratedModeSlec = array(
		"-------",
		"minimum", 
		"middle", 
		"rated", 
		"maximum", 
		"low-temperature heating",
		"forced cooling",
		"XXXXXXX",
	);

	if($DataVal<7){
		return $ratedModeSlec[$DataVal];
	}
	else{
		return $ratedModeSlec[7];
	}	
}


function IduFaultDetection($DataVal)
{	
	$IduFault_Reason = array("IDU Fan failure","Te failure","Tr failure","Fluoride free protection","WiFi failure","Abnormal zero crossing detection of IDU Fan","IDU EE failure");

	$Bits =array_reverse(str_split(sprintf('%08b',  $DataVal),1));
	//echo "<pre>";print_r($Bits);echo "</pre>";
	$result = array("");
	foreach ($Bits as $key => $value) {
		if($value == 1){
			array_push($result,$IduFault_Reason[$key]);
			break;
		}
	}	
	//echo "<pre>";print_r($result);echo "</pre>";
	return $result;
}

function ODUTypeChecker($DataVal)
{	
	$ODU_MCU_Type = array("TI_F2802x" ,"TI_F2803x","TI_F28002x","RX23T5");
	$Bits = array_reverse(str_split(sprintf('%08b',  $DataVal),1));	

	if($Bits[4] == 1){
		return $ODU_MCU_Type[0];
		break;
	}
	if($Bits[5] == 1){
		return $ODU_MCU_Type[1];
		break;
	}
	if($Bits[6] == 1){
		return $ODU_MCU_Type[2];
		break;
	}
	if($Bits[7] == 1){
		return $ODU_MCU_Type[3];
		break;
	}
	//echo "<pre>";print_r($Bits);echo "</pre>";
	//return $result;
}


//187,2,1,71,13,13,0,0,2,93,123,140,74,92,137,116,98,0,176,6,182,93,3,50,1,153,85,16,0,1,0,110,0,116,23,9,11,232,
?>


