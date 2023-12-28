<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Corona Admin</title>

  <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="./assets/css/style.css">

  <link rel="shortcut icon" href="./assets/images/favicon.png" />
</head>
<body>
  <?php

  $mobileNo = $_GET ['mobNo'];
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ee_monitoring";

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
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card" >
              <div class="card">
                <div class="card-body">
                  <div class="row"><img src="./assets/images/faces/off.png" alt="" width="100%" height="50%">
                  </div>
                  <h3 class="mb-0" align="center">Device Connected</h3>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row"><img src="./assets/images/faces/serial.png" alt="" width="100%" height="50%">
                  </div>
                  <a class="nav-link" href="serial.php?mobNo=<?php echo $mobileNo;?>">
                    <h3 class="mb-0" align="center">Serial Monitoring</h3>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row"><img src="./assets/images/faces/idu.png" alt="" width="100%" height="50%">
                  </div>
                  <a class="nav-link" href="iduEE.php?mobNo=<?php echo $mobileNo;?>">
                    <h3 class="mb-0" align="center">IDU EE Program</h3>
                  </a>              
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row"><img src="./assets/images/faces/odu.png" alt="" width="100%" height="50%">
                  </div>
                  <a class="nav-link" href="oduEE.php?mobNo=<?php echo $mobileNo;?>">
                    <h3 class="mb-0" align="center">ODU EE Program</h3>
                  </a>             
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
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
</body>

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

<script>
  async function uploadFile() {
    let formData = new FormData();           
    formData.append("file", fileupload.files[0]);
    await fetch('./controller/checkSumUpdater.php', {
      method: "POST", 
      body: formData,
      contentType: 'application/octet-stream; charset=utf-8',
    }).then(data => console.log(data));    

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


<!--  

RndacGps@#786

-->