<?php
function MajorAlarmDetection($DataVal,$Color)
{	
	
	$MajorAlrmTyp = array($Color[0]);
	if ($DataVal > 0) {
		$MajorAlrmTyp[0] = $Color[1];
		$Bits =array_reverse(str_split(sprintf('%08b',  $DataVal),1));
		foreach ($Bits as $key => $value) {
			//echo "<pre>";print_r($key);print_r($value);echo "</pre>";
			switch ($key) {
				// KEY 0,1,2,3,4,5,6,7
				case 0:
				//1st Bit = 1
				if ($Bits[$key] == 1) {
					//array_push($MajorAlrmTyp,"");
				}				
				break;

				case 1:
				//2nd Bit = 2
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Ta Fault");
				}
				break;

				case 2:
				//3rd Bit=4
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Tc Fault");
				}
				break;

				case 3:
				//4th Bit = 8
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Td Fault");
				}
				break;

				case 4:
				//5th Bit = 16
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Communication Fault");
				}
				break;

				case 5:
				//6th Bit = 32
				if ($Bits[$key] == 1) {
					//array_push($MajorAlrmTyp,"");
				}
				break;

				case 6:
				//5th Bit = 64
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Compressor Fault");
				}
				break;

				case 7:
				//6th Bit = 128
				if ($Bits[$key] == 1) {
					//array_push($MajorAlrmTyp,"");
				}
				break;

				default:
				break;
			}
		}
	}
	return $MajorAlrmTyp;
}


function Protection($DataVal,$Color)
{	
	$MajorAlrmTyp = array($Color[0]);
	if ($DataVal > 0) {
		$MajorAlrmTyp[0] = $Color[1];
		$Bits =array_reverse(str_split(sprintf('%08b',  $DataVal),1));
		foreach ($Bits as $key => $value) {
			//echo "<pre>";print_r($key);print_r($value);echo "</pre>";
			switch ($key) {
				// KEY 0,1,2,3,4,5,6,7
				case 0:
				//1st Bit = 1
				if ($Bits[$key] == 1) {
					//array_push($MajorAlrmTyp,"");
				}				
				break;

				case 1:
				//2nd Bit = 2
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Tc Protect");
				}
				break;

				case 2:
				//3rd Bit=4
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Te Protect");
				}
				break;

				case 3:
				//4th Bit = 8
				if ($Bits[$key] == 1) {
					//array_push($MajorAlrmTyp,"");
				}
				break;

				case 4:
				//5th Bit = 16
				if ($Bits[$key] == 1) {
					//array_push($MajorAlrmTyp,"");
				}
				break;

				case 5:
				//6th Bit = 32
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"AC Volt Protect");
				}
				break;

				case 6:
				//5th Bit = 64
				if ($Bits[$key] == 1) {
					//array_push($MajorAlrmTyp,"");
				}
				break;

				case 7:
				//6th Bit = 128
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Td Protect");
				}
				break;

				default:
				break;
			}
		}
	}
	return $MajorAlrmTyp;
}


function Limit_Freq($DataVal,$Color)
{	
	$MajorAlrmTyp = array($Color[0]);
	if ($DataVal > 0) {
		$MajorAlrmTyp[0] = $Color[1];
		$Bits =array_reverse(str_split(sprintf('%08b',  $DataVal),1));
		foreach ($Bits as $key => $value) {
			//echo "<pre>";print_r($key);print_r($value);echo "</pre>";
			switch ($key) {
				// KEY 0,1,2,3,4,5,6,7
				case 0:
				//1st Bit = 1
				if ($Bits[$key] == 1) {
					//array_push($MajorAlrmTyp,"");
				}				
				break;

				case 1:
				//2nd Bit = 2
				if ($Bits[$key] == 1) {
					//array_push($MajorAlrmTyp,"");
				}
				break;

				case 2:
				//3rd Bit=4
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Tc Limit");
				}
				break;

				case 3:
				//4th Bit = 8
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Te Limit");
				}
				break;

				case 4:
				//5th Bit = 16
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Ta Limit");
				}
				break;

				case 5:
				//6th Bit = 32
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"AC Volt Limit");
				}
				break;

				case 6:
				//5th Bit = 64
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"AC Current Limit");
				}
				break;

				case 7:
				//6th Bit = 128
				if ($Bits[$key] == 1) {
					array_push($MajorAlrmTyp,"Td Limit");
				}
				break;

				default:
				break;
			}
		}
	}
	return $MajorAlrmTyp;
}

?>





<?php 






?>



