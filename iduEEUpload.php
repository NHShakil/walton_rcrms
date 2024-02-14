<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
  <style>
    .progress-bar {
      width: auto;
      height: 20px;
      background-color: #f2f2f2;
      position: relative;
    }

    .progress {
      height: 100%;
      background-color: #4caf50;
      position: absolute;
      top: 0;
      left: 0;
      width: 0%;
    }
  </style>
</head>
<body onload="unsetButton()">
  <?php
  $Type = $_POST['type'];
  $Capacity = $_POST['capacity'];
  $Version = $_POST['version'];
  $Model = $_POST['Model'];
  $MobNo = $_POST['MobNo'];


  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ee_monitoring";
  $devList = array();
  $data = $_POST;
    //print_r($data);

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM `ee_program_list` WHERE `type`='".$Type."' AND `capacity`='".$Capacity."' AND `version`='".$Version."' AND `model`='".$Model."'; ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      array_push( $devList,$row);
      $created = $row['created'];
      $modified = $row['modified'];
    }
  } else {
      //echo "0";
  }

  $conn->close();
  //print_r($created);
  

  $navDevList = array();
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  $sql ="UPDATE `live_updating_table` SET `data` = '".$devList[0]['segMnt_one']."' WHERE `live_updating_table`.`mobNo` = '".$MobNo."'; ";
  $conn->query($sql);

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

  $segOne = explode(",", $devList[0]["segMnt_one"]);
  $segTwo = explode(",", $devList[0]["segMnt_Two"]);
  $checkSum = $devList[0]['checksum'];
  //print_r($segOne);
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
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card" style="overflow-x:auto;">
              <div class="card">
                <div class="card-body">
                  <div class="progress-bar">
                    <div class="progress"></div>
                  </div>
                  <span class="countdown"></span>
                  <h4 class="card-title">EE Program Uploading Status</h4>
                  <div class="table-responsive div-scroll" >
                    <h1 id="status" class="card-body">
                    </h1>
                  </div>
                </div>
              </div>              
            </div>
            <div class="card-body">

              <h4 class="card-title">EE Program Uploading Test Report</h4>

              <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                <div class="text-md-center text-xl-left">
                  <h6 class="mb-1">Actual EE Check Sum</h6>
                  <p class="text-muted mb-0">Created  : <?php echo $created;?></p>
                  <p class="text-muted mb-0">Modified : <?php echo $modified;?></p>
                </div>
                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                  <h6 id="EE_CHK_SUM" class="font-weight-bold mb-0">0x<?php echo $checkSum;?></h6>
                </div>
              </div>
              <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                <div class="text-md-center text-xl-left">
                  <h6 class="mb-1">Device EE Check Sum</h6>
                  <p class="text-muted mb-0">XX XXX XXXX, XX:XX XX</p>
                </div>
                <div id="deviceChecksum" class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                  <h6  class="font-weight-bold mb-0">0XXXXX</h6>
                </div>
              </div>
              <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">                  
                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                  <button id="checkButton" type="button" class="btn btn-success btn-rounded btn-fw not-visible" onclick="checkEE()" disabled >Check EE Version</button>
                </div>     
                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                  <button id="crossMatchButton" type="button" class="btn btn-danger btn-rounded btn-fw not-visible" onclick="crossCheckEE()" disabled >Cross Match</button>
                </div>           
              </div> 


            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © WALTON 2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Product of <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank"> Residential Air Conditoner</a> Research & Innovation</span>
          </div>
        </footer>

      </div>
    </div>
  </div>
</body>
<script>
  function unsetButton() {
    $('#checkButton').prop('disabled', false);
    $('#crossMatchButton').prop('disabled', false);
  }
</script>
<script src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
  const countdownEl = document.querySelector(".countdown");
  const progressBarEl = document.querySelector(".progress");
    let remainingTime = 165; // seconds
    const totalTime = remainingTime;
    var EE_segMent = 0;

    function countdown() {
      if (remainingTime > 0) {
        if(remainingTime == 125){
          EE_segMent++;          
          console.log(EE_segMent);
          updateEESeg(EE_segMent);
        }
        if(remainingTime == 85){
          EE_segMent++;
          console.log("BAL:"+EE_segMent);
          updateEESeg(EE_segMent);
        }
        if(remainingTime == 45){
          EE_segMent++;
          console.log(EE_segMent);
          updateEESeg(EE_segMent);
        }
        if(remainingTime == 5){
          $('#checkButton').prop('disabled', false);
          updateEESeg();
          EE_segMent++;
          console.log(EE_segMent);
          updateEESeg(EE_segMent);
        }
        
        countdownEl.textContent = remainingTime;
        const progress = ((totalTime - remainingTime) / totalTime) * 100;
        progressBarEl.style.width = `${progress}%`;
        remainingTime--;
        setTimeout(countdown, 1000);
      } else {

        progressBarEl.style.width = "100%";
        countdownEl.textContent = "Time's up!";
      }
    }
    countdown();
  </script>
  <script type="text/javascript">
    function updateEESeg(argument) {
      $.ajax({
        type: 'POST',
        url:  'controller/idu_ee_check.php/?',
        data: { 
          type:"<?php echo $Type;?>",
          capacity:"<?php echo $Capacity;?>",
          version:"<?php echo $Version;?>",
          Model:"<?php echo $Model;?>",
          MobNo:"<?php echo $MobNo;?>",
          Segment:argument
        }
      })
      .done( function (version) {

      })   
      .fail( function (jqXHR, status, error) {
        alert("Fail;")
      })
      .always( function() {

      });
    }
    
  </script>
  <script type="text/javascript">
    function checkEE(){
      console.log("TEST");

      $.ajax({
        type: 'POST',
        url:  'controller/idu_ee_check.php/',
        data: { 
          type:"<?php echo $Type;?>",
          capacity:"<?php echo $Capacity;?>",
          version:"<?php echo $Version;?>",
          Model:"<?php echo $Model;?>",
          MobNo:"<?php echo $MobNo;?>"
        }
      })
      .done( function (version) {


      })   
      .fail( function (jqXHR, status, error) {
        alert("Fail;")
      })
      .always( function() {
        $('p:first').after('<p>Thank you.</p>');
      });

    }
    
    function crossCheckEE(argument) {
      console.log("TEST");

      $.ajax({
        type: 'POST',
        url:  'controller/crossCheck.php/',
        data: { 
          type:"<?php echo $Type;?>",
          capacity:"<?php echo $Capacity;?>",
          version:"<?php echo $Version;?>",
          Model:"<?php echo $Model;?>",
          MobNo:"<?php echo $MobNo;?>"
        }
      })
      .done( function (ee_checksum) { 
        var orgnlChkSum = $('#EE_CHK_SUM').text().toString().toUpperCase();        
        var newChkSum = "0X"+parseInt(ee_checksum, 10).toString(16).toUpperCase();
        $("#deviceChecksum").html("<h6 class=\"font-weight-bold mb-0\">0X"+parseInt(ee_checksum, 10).toString(16).toUpperCase()+"</h6>");
        if (orgnlChkSum.localeCompare(newChkSum) == 0) {
          $('#status').html("<img src=\"./assets/images/faces/test_Passed.png\"  alt=\"\" width=\"80%\" height=\"50%\">");
        }
        else{
          $('#status').html("<img src=\"./assets/images/faces/test_Failed.png\"  alt=\"\" width=\"80%\" height=\"50%\">");
        }       
      })   
      .fail( function (jqXHR, status, error) {

      })
      .always( function() {

        //

        // if ( == parseInt(ee_checksum, 10).toString(16)) {
        //   console.log($("#checkButton").val());
        // }



      });
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
  </html>
  