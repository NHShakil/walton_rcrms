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
</head>
<body>
  <?php

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

          </div>
        </li>
        <li class="nav-item nav-category">
          <span class="nav-link">Navigation</span>
        </li>

        <div id="liveDevice">

          <?php
          foreach ($navDevList as $key => $value) {
            echo "<li id = \"".$value['mob_no']."\" class=\"nav-item menu-items\">
            <a class=\"nav-link\" href=\"view.php?mobNo=".$value['mob_no']."\" aria-expanded=\"false\" aria-controls=\"ui-basic\">
            <span class=\"menu-icon\">
            <i class=\"mdi mdi mdi-laptop\"></i>
            </span>
            <span class=\"menu-title\">".$value['mob_no']."</span>
            </a>
            </li>";
          }
          ?>   
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          
          
          </span>
                         
          </a>
          
        </div>         
      </ul>
    </nav>
 


  </div>

  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © WALTON 2023</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Product of <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank"> Residential Air Conditoner</a> Research & Innovation</span>
    </div>
  </footer>

</div>

<script src="js/jquery-1.11.2.min.js"></script>
<script>
  window.setInterval(function(){
  ajaxCallFunction();  //calling every 5 seconds
}, 5000);

  function ajaxCallFunction(){
    console.log("Updating GUI : Virus function is going to CALLED");
    $.ajax({
     type: 'GET',
     url:  'controller/indexpageDB.php',
     data: { }
   })
    .done( function (responseText) {
      
      //console.log(responseText);
      var devDataPac = responseText.split(";");
      var inActiv = devDataPac[0].split(",");
      var activ = devDataPac[1].split(",");
      for (var i = 0; i < inActiv.length; i++) {
        console.log("INACTIVE:"+inActiv[i]);
        //$("#"+inActiv[i]+"\'").remove();
        $('#'+inActiv[i]).remove();
      }
      // Adding new Device section

      /* This function is not working. The Nth element is required to add new device.*/
      // for (var i = 0; i < activ.length; i++) {
      //   console.log("ACTIVE:"+activ[i]);
      //   $("#liveDevice1 :nth-last-child(3)").append("<li id=\"liveDevice1\" class=\"nav-item menu-items\">"+
      //     "<a class=\"nav-link\" href=\"view.php\">"+
      //     "<span class=\"menu-icon\">"+
      //     "<i class=\"mdi mdi mdi-laptop\"></i>"+
      //     "</span>"+
      //     "<span class=\"menu-title\">"+activ[i]+"</span>"+
      //     "</a>"+
      //     "</li>");
      // }
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
    //var submittedMessage = $(':text[name="message"]').val();
  function formateEEFile(argument) {
      // body...


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
