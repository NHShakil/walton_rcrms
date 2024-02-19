<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="refresh" content="5">
  <title>Air Conditoner (RAC)</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End Plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="./assets/images/favicon.png" />
</head>
<body>
  <?php
  // DATA
  //1;01675702741;22;170,16,1,71,13,13,0,0,2,93,123,140,74,92,137,116,98,0,176,6,182,93,3,50,1,153,85,16,0,1,0,110,0,116,23,9,11,232;170,16,1,71,13,13,0,0,2,93,123,140,74,92,137,116,98,0,176,6,182,93,3,50,1,153,85,16,0,1,0,110,0,116,23,9,11,232;;;;;

  include "./controller/logics.php";
  $mobileNo = $_GET ['mobNo'];
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ee_monitoring";

  $navDevList = array();
  $devList = array();
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM `live_device` WHERE `status`='1';";
  $conectDevList = $conn->query($sql);

  if ($conectDevList->num_rows > 0) {
    while($row = $conectDevList->fetch_assoc()) {
      array_push( $navDevList,$row);
    }
  } else {
    echo "0 results";
  }
  $sql = "UPDATE `live_device` SET `cmd` = '1' WHERE `live_device`.`mob_no`='".$mobileNo."';"; 
  $conn->query($sql);
  

  $sql = "SELECT * FROM `dev_last_sts` WHERE `mob_no`='".$mobileNo."'; ";
  //echo "$sql";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      //print_r($result);
      $Packet_One = $row['serial_pac_one'];
      $Packet_Two = $row['serial_pac_two'];
      $Packet_Three= $row['serial_pac_three'];
      $Log_Time   = $row['modified'];
    }
  } else {
    //echo "No data Found";
//1;01608984560;;170,16,1,0,0,0,0,0,0,110,110,102,53,102,106,124,2,0,0,5,169,0,0,50,9,180,33,0,0,1,1,110,3,116,23,5,11,162,;187,2,0,0,0,1,180,0,0,0,110,102,53,102,107,124,2,0,0,5,170,0,0,50,9,180,33,0,0,1,1,110,3,116,23,5,11,220,;170,20,75,83,78,49,51,51,68,50,49,85,70,90,35,35,35,35,42,42,42,42,42,42,42,42,0,0,0,0,86,250,0,0,0,177,205,221,;0;;
  }
  $conn->close();


  
  if ($Packet_One == NULL) {
    $segmntedPacOne =explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0") ;
  }else{
    $Packet_One = rtrim($Packet_One, ",");
    $segmntedPacOne =  explode(",", $Packet_One) ; 
  }
  
  
  if ($Packet_Two == NULL) {
    $segmntedPacTwo =explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0") ;
  }else{
    $Packet_Two = rtrim($Packet_Two, ",");
    $segmntedPacTwo = explode(",", $Packet_Two);
  }

  echo "<pre>";print_r($segmntedPacTwo);echo "</pre>";

  $Alarm_clr = array(
    "outline-secondary", // Blank
    "danger", //RED
    "success",//Green
    "primary"
  );


  /************ Packet One Data Acqusition *********/

  $ODUType     = ODUTypeChecker($segmntedPacOne[1]);

  // Byte_2 Description
  // Operating Mode generated from 
  $Byte_2     = array("Standby" ,"Cool","Heat","Fan","DRY","","","Test","SelfTest");
  $Mode = $Byte_2[$segmntedPacOne[2]];

  $Real_Freq = $segmntedPacOne[3];
  $Real_Freq_RPM = $segmntedPacOne[3]*60;
  $targ_Freq = $segmntedPacOne[4];
  $Set_Freq = $segmntedPacOne[5];
  


  // Byte_06 Description
  if ($segmntedPacOne[6] == 0) {
    $Fault  = array("");
    array_push($Fault,"OK",$Alarm_clr[2]);
  }else{
    $Fault  = FaultByteChecker($segmntedPacOne[6],$Alarm_clr);
  }


  // Byte_07 Description
  if ($segmntedPacOne[7] == 0) {
    $Protection   = array("");
    array_push($Protection,"OK",$Alarm_clr[2]);
  }else{
    $Protection   = ProtectionByteChecker($segmntedPacOne[7],$Alarm_clr);
  }


  // Byte_08 Description
  if ($segmntedPacOne[8] == 0) {
    $Limit   = array("");
    array_push($Limit,"OK",$Alarm_clr[2]);
  }else{
    $Limit   = LimitByteChecker($segmntedPacOne[8],$Alarm_clr);
  }


  $Ts      = ($segmntedPacOne[9]-60)/2;
  $Tr      = ($segmntedPacOne[10]-60)/2;
  $Ta      = ($segmntedPacOne[11]-60)/2;
  $Td      =  $segmntedPacOne[12]-30;
  $Te      = ($segmntedPacOne[13]-60)/2;
  $Tc      = ($segmntedPacOne[14]-60)/2;
  $AC_VOLT = ($segmntedPacOne[15]*2);
  $AC_CRNT = ($segmntedPacOne[16]/10);
  // Byte_17 Description
  $ERRcode = ERRCodeDetection($segmntedPacOne[17]);
  // Byte_18 Description
  if(($segmntedPacOne[18])==0){
    //print_r("FUCk.....");
    $Compressor = $Alarm_clr[0];
    $RetnOil = $Alarm_clr[0];
    $OutFan = $Alarm_clr[0];
    $FourWay= $Alarm_clr[0];
    $TestMod= $Alarm_clr[0];
    $PreHeat= $Alarm_clr[0];
  }else{
    $FreqAlarms   =  str_split(decbin($segmntedPacOne[18]),1);
    $Compressor = ($FreqAlarms[0] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
    $RetnOil    = ($FreqAlarms[1] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
    $OutFan     = ($FreqAlarms[2] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
    $FourWay    = ($FreqAlarms[4] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
    $DeFrst     = ($FreqAlarms[5] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
    $TestMod    = ($FreqAlarms[6] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
    $PreHeat    = ($FreqAlarms[7] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  }
  // Byte_19 Description
  // Indoor FAN Wind Speed Level
  $Byte_19      = array("Stopped","Faint","Silent","Low","Mid","High","Powerful");
  $IDU_Fan_Speed= $Byte_19[$segmntedPacOne[19]];
  $DC_VOLT      = ($segmntedPacOne[20]*2);
  $DC_CRNT      = ($segmntedPacOne[21]/10);
  $ODU_Fan_Speed= $segmntedPacOne[22]*10;
  $comp_type    = $segmntedPacOne[23];
  $Byte_24      = array("A","B","C","D","E","F","G","H","I","J");
  $Tipm         = $segmntedPacOne[26];

  
  // Byte_27 Description
  $Byte_27    = array("Permanent stop sign","IDU failure","mould proof","ECO mode","PFC open");
  $FreqAlarms2= array_reverse(str_split(sprintf('%08b',  $segmntedPacOne[27]),1));
  $permStpSgn = ($FreqAlarms2[0] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $IDUFail    = ($FreqAlarms2[1] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $MoldPrf    = ($FreqAlarms2[2] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $ECOMode    = ($FreqAlarms2[3] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $PFC        = ($FreqAlarms2[4] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  

  // Byte_28 Description
  if ($segmntedPacOne[28] == 0) {
    $DownFreq   = array("");
    array_push($DownFreq,"OK",$Alarm_clr[2]);
  }else{
    $DownFreq   = DownFreqByteChecker($segmntedPacOne[28],$Alarm_clr);
  }

  // Byte_32 Description
  $RatedModeLowNibble = modeDetection($segmntedPacOne[32]);

  
  // Byte_33 Description
  $IDU_Fan_Speed_RPM = $segmntedPacOne[33]*10;
  

  $version = "20".$segmntedPacOne[34]."-".$segmntedPacOne[35]."-".$segmntedPacOne[36];

  
  /************ Packet Two Data Acqusition *********/
  if ($Packet_Two == NULL) {
    $segmntedPacTwo =explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0") ;
  }else{
    $Packet_Two = rtrim($Packet_Two, ",");
    $segmntedPacOne =  explode(",", $Packet_Two) ; 
  }
  $Time_STS     = On_Off_FLG_Detect ($segmntedPacTwo[4]);
  $Time         = timeConverter($segmntedPacTwo[5],$segmntedPacTwo[6]);
  $FAN_IPM      = $segmntedPacTwo[7];
  
  //BYTE 8+9 
  //IDU Fault Detectation
  if ($segmntedPacTwo[8] == 0) {
    $IDU_FAULT   = "----";
  }else{
    $IDU_FAULT    = IduFaultDetection($segmntedPacTwo[8]);
  }
 

  /************ Packet Three Data Acqusition *********/
  //print_r($Packet_Three);
  if ($Packet_Three == NULL) {
    $Pac_3_Data =explode(",","0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0") ;
  }else{
    $Pac_3_Data = rtrim($Packet_Three, ",");
    $Pac_3_Data = explode(",",$Packet_Three);
  }

  
  $compModelName = "";
  for ($i=2; $i < 18; $i++) { 
    $compModelName .=chr($Pac_3_Data[$i]);
  }
  $ODU_EE_CheckSum  = "0x".strtoupper(dechex($Pac_3_Data[30]).dechex($Pac_3_Data[31]));
  $ODU_MCU_CheckSum = "0x".strtoupper(dechex($Pac_3_Data[28]).dechex($Pac_3_Data[29]));
  $IDU_EE_CheckSum  = "0x".strtoupper(dechex($Pac_3_Data[35]).dechex($Pac_3_Data[36]));
  $IDU_MCU_CheckSum = "0x".strtoupper(dechex($Pac_3_Data[32]).dechex($Pac_3_Data[33]).dechex($Pac_3_Data[34]));
  
  
  ?>

  <div class="container-scroller">
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item profile">
          <div class="profile-desc">
            <div class="profile-pic">
              <div class="count-indicator">
                <img class="img-xs rounded-circle " src="./assets/images/faces/face15.jpg" alt="">
                <span class="count bg-success"></span>
              </div>
              <div class="profile-name">
                <h5 class="mb-0 font-weight-normal">WALTON</h5>
                <span>Residential Air-Conditoner</span>
              </div>
            </div>
            <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
            <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="true" aria-controls="ui-basic">
                <span class="menu-icon">
                  <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-onepassword  text-info"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-calendar-today text-success"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                </div>
              </a>
            </div>
          </div>
        </li>
        <li class="nav-item nav-category">
          <span class="nav-link">Navigation</span>
        </li>


        <?php
        foreach ($navDevList as $key => $value) {
          echo "<li class=\"nav-item menu-items\">
          <a class=\"nav-link\" data-toggle=\"collapse\" href=\"#ui-basic\" aria-expanded=\"false\" aria-controls=\"ui-basic\">
          <span class=\"menu-icon\">
          <i class=\"mdi mdi-laptop\"></i>
          </span>
          <span class=\"menu-title\">".$value['mob_no']."</span>                  
          </a>                
          </li>";
        }
        ?>            
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="./index.html"><img src="./assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>                
          <ul class="navbar-nav navbar-nav-right">

          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-12 grid-margin stretch-card">
            <div class="col-8 card corona-gradient-card">
              <div class="card-body py-0 px-0 px-sm-3">
                <div class="row align-items-center">

                  <div class="col-5 col-sm-7 col-xl-8 p-0">                   
                    <h4 class="mb-1 mb-sm-0">Soft Data: <?php echo ($version); ?></h4>                   
                    <h4 class="mb-1 mb-sm-0">Last Updated Time &nbsp;: <?php echo ($Log_Time) ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card-body">
                <br>
                <div class="row">
                  <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="text-muted font-weight-normal">Target Frequency</h5>
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                              <h3 class="mb-0"><?php echo ("F".$targ_Freq);?></h3>
                              <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                            </div>
                          </div>                          
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="text-muted font-weight-normal">Set Frequency</h5>
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                              <h3 class="mb-0"><?php echo ("F".$Set_Freq);?></h3>
                              <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                            </div>
                          </div>                          
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h6 class="text-muted font-weight-normal">Real Frequency</h6>
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-left align-self-start">
                              <h3 class="mb-0"><?php echo ($Real_Freq);?></h3>
                              <p class="text-danger ml-2 mb-0 font-weight-medium">Hz</p>
                            </div>

                            <div class="d-flex align-items-left align-self-start">
                              <h3 class="mb-0"><?php echo (" ".$Real_Freq_RPM);?></h3>
                              <p class="text-danger ml-2 mb-0 font-weight-medium">rpm</p>
                            </div>
                          </div>                          
                        </div>

                      </div>
                    </div>
                  </div>  

                  <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="text-muted font-weight-normal">ERROR Code</h5>
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                              <h3 class="mb-0"><?php echo $ERRcode;?></h3>
                              <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                            </div>
                          </div>                          
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="text-muted font-weight-normal">Compressor Model</h5>
                        <div class="row">
                          <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                              <h3 class="mb-0"><?php echo ($compModelName);?></h3>
                              <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                            </div>
                          </div>                          
                        </div>

                      </div>
                    </div>
                  </div>

                </div>                
              </div>              
            </div>
            <div class="col-lg-3 grid-margin stretch-card">
              <div class="row">
                <div class="card-body">
                  <h4 class="card-title">Major Fault</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Fault</td>
                          <td><button type="button" class="btn btn-<?php echo $Fault[2];?> btn-rounded btn-icon"></button></td>
                          <td><?php echo $Fault[1];?></td>
                        </tr>
                        <tr>
                          <td>Protection</td>
                          <td><button type="button" class="btn btn-<?php echo $Protection[2];?> btn-rounded btn-icon">
                          </button></td>
                          <td><?php echo $Protection[1];?></td>
                        </tr>
                        <tr>
                          <td>Limit Freq</td>
                          <td><button  class="btn btn-<?php echo $Limit[2];?> btn-rounded btn-icon">
                          </button></td>
                          <td><?php  echo $Limit[1];?></td>
                        </tr>
                        <tr>
                          <td>Down Freq</td>
                          <td><button type="button" class="btn btn-<?php echo $DownFreq[2];?> btn-rounded btn-icon">
                          </button></td>
                          <td><?php  echo $DownFreq[1];?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 grid-margin stretch-card">
              <div class="row">
                <div class="card-body">
                  <h4 class="card-title">Frequency Display</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Comp</td>
                          <td><button type="button" class="btn btn-<?php echo $Compressor;?> btn-rounded btn-icon"></button></td>
                          <td>Defrost</td>
                          <td><button type="button" class="btn btn-<?php echo $DeFrst;?> btn-rounded btn-icon">
                          </button></td>
                        </tr>
                        <tr>
                          <td>4Way</td>
                          <td><button type="button" class="btn btn-<?php echo $FourWay;?> btn-rounded btn-icon">
                          </button></td>
                          <td>Ret Oil</td>
                          <td><button type="button" class="btn btn-<?php echo $RetnOil;?> btn-rounded btn-icon">
                          </button></td>
                        </tr>

                        <tr>
                          <td>Out Fan</td>
                          <td><button type="button" class="btn btn-<?php echo $OutFan;?> btn-rounded btn-icon">
                            <i class="mdi mdi-trending-up text-success"></i>
                          </button></td>
                          <td>Test</td>
                          <td><button type="button" class="btn btn-<?php echo $TestMod;?> btn-rounded btn-icon">
                          </button></td>                          
                        </tr>
                        <tr>
                          <td>Preheater</td>
                          <td><button type="button" class="btn btn-<?php echo $PreHeat;?> btn-rounded btn-icon">
                          </button></td>
                          <td>Turbo</td>
                          <td><button type="button" class="btn btn-<?php //echo $Compressor;?> btn-rounded btn-icon">
                          </button></td>                          
                        </tr>
                        <tr>
                          <td>Proof</td>
                          <td><button type="button" class="btn btn-<?php echo $MoldPrf;?> btn-rounded btn-icon">
                          </button></td>
                          <td>E C O</td>
                          <td><button type="button" class="btn btn-<?php echo $ECOMode;?> btn-rounded btn-icon">
                          </button></td>                          
                        </tr>
                        <tr>
                          <td>PFC</td>
                          <td><button type="button" class="btn btn-<?php echo $PFC;?> btn-rounded btn-icon">
                          </button></td>
                          <td>IDU Fault</td>
                          <td><button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                          </button></td>                       
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card corona-gradient-card">
                <div class="card-body py-0 px-0 px-sm-3">
                  <div class="row align-items-center">
                    <div class="col-5 col-sm-7 col-xl-8 p-0">
                      <h3 class="mb-1 mb-sm-0">Indoor Unit Data</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h1 class="display-5">Mode: <?php echo $Mode;?></h1>
                  <h1 class="display-5">Rated Mode: <?php echo $RatedModeLowNibble;?></h1>
                  <h1 class="display-5">MCU Checksum: <?php echo $IDU_MCU_CheckSum;?></h1>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h1 class="display-5">Tr: <?php echo $Tr."°C";?></h1>
                  <h1 class="display-5">Ts: <?php echo $Ts."°C";?></h1>
                  <h1 class="display-5">EE Checksum: <?php echo $IDU_EE_CheckSum;?></h1>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h1 class="display-5">Te: <?php echo $Te."°C";?></h1>
                  <h1 class="display-5">IDU Fault : <?php echo($IDU_FAULT);?></h1>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h1 class="display-5">Fan Level: <?php echo $IDU_Fan_Speed;?></h1>
                  <h1 class="display-5">Fan rpm: <?php echo $IDU_Fan_Speed_RPM."rpm";?></h1>
                </div>
              </div>
            </div>


          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card corona-gradient-card">
                <div class="card-body py-0 px-0 px-sm-3">
                  <div class="row align-items-center">
                    <div class="col-5 col-sm-7 col-xl-8 p-0">
                      <h3 class="mb-1 mb-sm-0">Outdoor Unit Data</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h3 class="display-5">Area: <?php echo "----";?></h3>
                  <h3 class="display-5">Fan Level: <?php echo "----";?></h3>
                  <h3 class="display-5">Fan rpm: <?php echo $ODU_Fan_Speed;?></h3>
                  <h3 class="display-5">Drv Fault : <?php echo "------";?></h3>
                  <h3 class="display-5">EEV : <?php echo "------";?></h3>
                  
                </div>
              </div>
            </div>

            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h3 class="display-5">Tsu: <?php echo "----";?></h3>
                  <h3 class="display-5">Ta: <?php echo $Ta."°C";?></h3>
                  <h3 class="display-5">Tc: <?php echo $Tc."°C";?></h3>
                  <h3 class="display-5">Td : <?php echo $Td."°C";?></h3>
                  <h3 class="display-5">Tipm : <?php echo $Tipm."°C";?></h3>
                  
                </div>
              </div>
            </div>

            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h3 class="display-5">DC CUR: <?php echo $DC_CRNT;?></h3>
                  <h3 class="display-5">DC VOL: <?php echo $DC_VOLT;?></h3>
                  <h3 class="display-5">AC CUR: <?php echo $AC_CRNT;?></h3>
                  <h3 class="display-5">AC VOL : <?php echo $AC_VOLT;?></h3>
                  <h3 class="display-5"><?php echo $Time_STS;?> Time : <?php echo $Time." Sec";?></h3>
                  
                  
                </div>
              </div>
            </div>

            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h3 class="display-5">Machine Type : <?php echo $comp_type ;?></h3>
                  <h3 class="display-5">System Type : <?php echo $ODUType;?></h3>
                  <h3 class="display-5">FAN IPM : <?php echo $FAN_IPM."°C";?></h3>
                  <h1 class="display-5">MCU Checksum: <?php echo $ODU_MCU_CheckSum;?></h1>
                  <h1 class="display-5">EE Checksum: <?php echo $ODU_EE_CheckSum;?></h1>                  
                </div>
              </div>
            </div>

          </div>

        </div>

        <!-- partial:./partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © WALTON 2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Product of <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank"> Residential Air Conditoner</a> Research & Innovation</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <script src="js/jquery-1.11.2.min.js"></script>
  <script>
    //var submittedMessage = $(':text[name="message"]').val();
    function formateEEFile(argument) {
      // body...

      $.ajax({
       type: 'GET',
       url:  'controller/formate.php',
       data: { }
     })
      .done( function (responseText) {
            // Triggered if response status code is 200 (OK)
      //$('#message').html('Your message is: ' + responseText);
      })
      .fail( function (jqXHR, status, error) {
            // Triggered if response status code is NOT 200 (OK)
        alert("Fail;")
      })
      .always( function() {
            // Always run after .done() or .fail()
        $('p:first').after('<p>Thank you.</p>');
      });
    }
  </script>
</head>
<body>






  <script src="./assets/vendors/js/vendor.bundle.base.js"></script>

  <script src="./assets/vendors/select2/select2.min.js"></script>
  <script src="./assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>

  <script src="./assets/js/off-canvas.js"></script>
  <script src="./assets/js/hoverable-collapse.js"></script>
  <script src="./assets/js/misc.js"></script>
  <script src="./assets/js/settings.js"></script>
  <script src="./assets/js/todolist.js"></script>
  <script src="./assets/js/file-upload.js"></script>
  <script src="./assets/js/typeahead.js"></script>
  <script src="./assets/js/select2.js"></script>


</body>
</html>


<!--  

RndacGps@#786

-->