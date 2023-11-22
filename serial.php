<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Corona Admin</title>
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

  include "./controller/logics.php";
  $Byte_2= array("Standby" ,"Cool","Heat","Fan","DRY","","","Test","SelfTest");
    //$Byte_6 = array("Standby" ,"Cool","Heat","Fan","DRY","","","Test","SelfTest");
  $Byte_18 = array("Compressor on","Oil return open","Outdoor fan on","Fluoro received","Fourway valve open","Defrost on", "Test mode on","Electric heating on");
  $Byte_19 = array("Stopped","Faint","Silent","Low","Mid","High","Powerful");
  $Alarm_clr = array("outline-secondary","danger","success","primary");

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ee_monitoring";


  $devList = array();
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM `log` ORDER BY `id` DESC LIMIT 1;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      array_push( $devList,$row);
    }
  } else {
    echo "0 results";
  }
  $conn->close();

  $navDevList = array();
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
  $conn->close();

//print_r($navDevList);

  $guiData = "";
  $guiData  = explode(",",$devList[0]["data"] );
  $Alarms   =  str_split(decbin($guiData[18]),1);

    // Indicator Section
  $Compressor = ($Alarms[0] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $RetnOil    = ($Alarms[1] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $OutFan     = ($Alarms[2] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $FourWay    = ($Alarms[4] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $DeFrst     = ($Alarms[5] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $TestMod    = ($Alarms[6] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
  $PreHeat    = ($Alarms[7] == 1) ? $Alarm_clr[2] : $Alarm_clr[0] ;
    //$Eco        = ($guiData[27]==8) ? $Alarm_clr[2] : $Alarm_clr[0] ;


  $Fault      = MajorAlarmDetection($guiData[6],$Alarm_clr);
  $Protect    = Protection($guiData[7],$Alarm_clr);
  $Limit      = Limit_Freq($guiData[8],$Alarm_clr);
    //$Down       = Down_Freq($guiData[8],$Alarm_clr);


    //$In_Flt     = ($guiData[6]>0) ? $Alarm_clr[2] : $Alarm_clr[0];


    //echo "<pre>";print_r($Limit);echo "</pre>";
    //echo "<pre>";print_r($guiData);echo "</pre>";
    /*foreach ($devList as $key => $value) {
      echo "<li class=\"nav-item menu-items\">
        <a class=\"nav-link\" href=\"index.html\">
          <span class=\"menu-icon\">
            <i class=\"mdi mdi-cellphone\"></i>
          </span><span class=\"menu-title\">"."01675702741"."</span></a></li>";
        }*/

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
                          <h4 class="mb-1 mb-sm-0">Version : <?php echo ($guiData[23]);?></h4> 
                          <h4 class="mb-1 mb-sm-0">Version Date: <?php echo ("20".$guiData[34]."-".$guiData[35]."-".$guiData[36]); ?></h4>
                          <h4 class="mb-1 mb-sm-0">System Type : <?php echo ("Machine Type ".$guiData[23]) ?></h4>
                          <h4 class="mb-1 mb-sm-0">Last Updated Time &nbsp;: <?php echo ($devList[0]["created"]) ?></h4>
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
                                    <h3 class="mb-0"><?php echo ("F".$guiData[4]);?></h3>
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
                                    <h3 class="mb-0"><?php echo ("F".$guiData[5]);?></h3>
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
                                    <h3 class="mb-0"><?php echo ($guiData[3]);?></h3>
                                    <p class="text-danger ml-2 mb-0 font-weight-medium">Hz</p>
                                  </div>

                                  <div class="d-flex align-items-left align-self-start">
                                    <h3 class="mb-0"><?php echo (" ".$guiData[3]*60);?></h3>
                                    <p class="text-danger ml-2 mb-0 font-weight-medium">rpm</p>
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
                                <td><button type="button" class="btn btn-<?php echo $Fault[0];?> btn-rounded btn-icon"></button></td>
                                <td><?php 
                                for ($i=1; $i < count($Fault) ; $i++) { 
                                  echo $Fault[$i]."</br>";                        }
                                ?></td>
                              </tr>
                              <tr>
                                <td>Protect</td>
                                <td><button type="button" class="btn btn-<?php echo $Protect[0];?> btn-rounded btn-icon">
                                </button></td>
                                <td><?php 
                                for ($i=1; $i < count($Protect) ; $i++) { 
                                  echo $Protect[$i]."</br>";                        }
                                ?></td>
                              </tr>
                              <tr>
                                <td>Limit Freq</td>
                                <td><button  class="btn btn-<?php echo $Limit[0];?> btn-rounded btn-icon">
                                </button></td>
                                <td><?php 
                                for ($i=1; $i < count($Limit) ; $i++) { 
                                  echo $Limit[$i]."</br>";                        }
                                ?></td>
                              </tr>
                              <tr>
                                <td>Down Freq</td>
                          <td><!-- <button type="button" class="btn btn-danger btn-rounded btn-icon">
                          </button> --></td>
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
                          <td>Collect F</td>
                          <td><button type="button" class="btn btn-<?php //echo $Compressor;?> btn-rounded btn-icon">
                          </button></td>                          
                        </tr>
                        <tr>
                          <td>Proof</td>
                          <td><button type="button" class="btn btn-<?php //echo $Compressor;?> btn-rounded btn-icon">
                          </button></td>
                          <td>E C O</td>
                          <td><button type="button" class="btn btn-<?php echo $Eco;?> btn-rounded btn-icon">
                          </button></td>                          
                        </tr>
                        <tr>
                          <td>Ever Off</td>
                          <td><button type="button" class="btn btn-<?php //echo $Compressor;?> btn-rounded btn-icon">
                          </button></td>
                          <td>In Fault</td>
                          <td><button type="button" class="btn btn-<?php echo $In_Flt;?> btn-rounded btn-icon">
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
                  <h1 class="display-5">Mode: <?php echo $Byte_2[$guiData[2]];?></h1>
                  <h1 class="display-5">Rated Mode: <?php echo "----";?></h1>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h1 class="display-5">Tr: <?php echo (($guiData[10]-60)/2)."°C";?></h1>
                  <h1 class="display-5">Ts: <?php echo (($guiData[9]-60)/2)."°C";?></h1>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h1 class="display-5">Te: <?php echo (($guiData[13]-60)/2)."°C";?></h1>
                  <h1 class="display-5">Customer : <?php echo "------";?></h1>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h1 class="display-5">Fan Level: <?php echo ($Byte_19[$guiData[19]]);?></h1>
                  <h1 class="display-5">Fan rpm: <?php echo (($guiData[33]*10)."rpm");?></h1>
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
                  <h3 class="display-5">Fan rpm: <?php echo "----";?></h3>
                  <h3 class="display-5">Drv Fault : <?php echo "------";?></h3>
                  <h3 class="display-5">EEV : <?php echo "------";?></h3>
                  <h3 class="display-5">Comp Type : <?php echo "------";?></h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h3 class="display-5">Tsu: <?php echo "----";?></h3>
                  <h3 class="display-5">Ta: <?php echo (($guiData[11]-60)/2)."°C";?></h3>
                  <h3 class="display-5">Tc: <?php echo (($guiData[14]-60)/2)."°C";?></h3>
                  <h3 class="display-5">Td : <?php echo ($guiData[12]-30)."°C";?></h3>
                  <h3 class="display-5">Tipm : <?php echo ($guiData[26])."°C";?></h3>
                  <h3 class="display-5">On Time : <?php echo "------";?></h3>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card-body">
                <div class="template-demo">
                  <h3 class="display-5">DC CUR: <?php echo ($guiData[21]/10);?></h3>
                  <h3 class="display-5">DC VOL: <?php echo ($guiData[20]*2);?></h3>
                  <h3 class="display-5">AC CUR: <?php echo ($guiData[16]/10);?></h3>
                  <h3 class="display-5">AC VOL : <?php echo ($guiData[15]*2);?></h3>
                  <h3 class="display-5">Off Time : <?php echo "------";?></h3>
                  <h3 class="display-5">System Type : <?php echo "------";?></h3>
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
  <form method="POST">


    <script>
      async function uploadFile() {
        let formData = new FormData();           
        formData.append("file", fileupload.files[0]);
        await fetch('./controller/checkSumUpdater.php', {
          method: "POST", 
          body: formData,
          contentType: 'application/octet-stream; charset=utf-8',
    })//.then(response => response.json())
        .then(data => console.log(data));    

      }
    </script>


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