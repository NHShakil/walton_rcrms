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

<!-- POST
http://192.168.118.138/adm/repo1/mod/tms/index.php?

1

task_status=1&task_title=test1&task_details=%3Cp%3Etest+2%3C%2Fp%3E%0D%0A&assign_date=2023-09-19+05%3A23%3A00+&dead_line_date=2023-09-30+17%3A23%3A00+&total_days=11+Days+12+Hours+0+Minutes&tpoint=0&tpoint2=0&emp_id=46416&supervisor=46416&supervisor_mobile=01608984877&assign_employee=46416&task_category=44&product_id=1&task_mode=0&tweight=100&priority=STANDARD&any_note=&others_notify_contact=&others_contact_person=&onbehalf=&task_type=1&reason=&btn_insert=Create



http://192.168.118.138/adm/repo1/mod/tms/index.php?task_status=1&task_title=1&task_details=%3Cp%3E1%3C%2Fp%3E%0D%0A&assign_date=2023-09-20+05%3A28%3A00+&dead_line_date=2023-09-22+17%3A28%3A00+&total_days=2+Days+12+Hours+0+Minutes&tpoint=0&tpoint2=0&emp_id=46416&supervisor=46416&supervisor_mobile=01608984877&assign_employee=46416&task_category=44&product_id=1&task_mode=0&tweight=100&priority=STANDARD&any_note=&others_notify_contact=&others_contact_person=&onbehalf=&task_type=1&reason=&btn_insert=Create
 -->