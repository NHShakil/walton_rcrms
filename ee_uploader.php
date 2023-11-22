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
//   $data = "";
//   $filename = "./controller/uploads/01675702741.txt";
//   $lines = array();
//   $fp = fopen($filename, "rb");



//   if(filesize($filename) > 0){
//     $content = fread($fp, filesize($filename));
//     $lines = explode("\n", $content);
//     echo "<pre>";
//     print_r($lines);
//     echo "</pre>";
//     fclose($fp);
//   }
// //
// // Removing last empty line of BIN file.
//   foreach ($lines as  $key=> $value) {
//     if(ord($lines[$key]) == 0){
//       unset($lines[$key]);
//     }
//   }

//   $EE_CHK_SUM = ",";
//   $ElmntCount = 0;
//   $SEGMNT = array("");
//   $SEGCUNT = 0;
//   foreach ($lines as $key => $value) {
//     $rowData = explode(" ", $value);
//     //$ElmntCount = count ($rowData) + $ElmntCount;


//     foreach ($rowData as $element => $FourDgtHex) {
//       $HEX = str_split($FourDgtHex,2);
//       // $EE_CHK_SUM .= ",".hexdec($HEX[0]).",".hexdec($HEX[1]);
//       // echo "<pre>";
//       // echo $HEX[0]."-".hexdec($HEX[0])."\n";
//       // echo $HEX[1]."-".hexdec($HEX[1])."\n";
//       // echo "</pre>";

//       // if($ElmntCount<128){
//       //   $SEGMNT[$SEGCUNT][$ElmntCount] = $HEX[0];
//       //   $SEGMNT[$SEGCUNT][$ElmntCount+1] = $HEX[1];
//       // }else if ($ElmntCount =128){
//       //   $SEGCUNT = $SEGCUNT+1;
//       //   $ElmntCount = 0;
//       // }
//       // $ElmntCount = $ElmntCount + 2;
//       array_push($SEGMNT,$HEX[0]);array_push($SEGMNT,$HEX[1]);
//     }

//   }
//   //file_put_contents("./controller/uploads/01675702741-D.txt",$SEGMNT);
//   /*echo "<pre>";

//   print_r ($SEGMNT);
//   echo "</pre>";*/
  ?>

  <div class="container-scroller">
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="./index.html"><img src="./assets/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="./index.html"><img src="./assets/images/logo-mini.svg" alt="logo" /></a>
      </div>
      <ul class="nav">
        <li class="nav-item profile">
          <div class="profile-desc">
            <div class="profile-pic">
              <div class="count-indicator">
                <img class="img-xs rounded-circle " src="./assets/images/faces/face15.jpg" alt="">
                <span class="count bg-success"></span>
              </div>
              <div class="profile-name">
                <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
                <span>Gold Member</span>
              </div>
            </div>
            <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
            <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
              <a href="#" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-settings text-primary"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                </div>
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
        <li class="nav-item menu-items">
          <a class="nav-link" href="./index.html">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-laptop"></i>
            </span>
            <span class="menu-title">Basic UI Elements</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="./pages/ui-features/buttons.html">Buttons</a></li>
              <li class="nav-item"> <a class="nav-link" href="./pages/ui-features/dropdowns.html">Dropdowns</a></li>
              <li class="nav-item"> <a class="nav-link" href="./pages/ui-features/typography.html">Typography</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="./pages/forms/basic_elements.html">
            <span class="menu-icon">
              <i class="mdi mdi-playlist-play"></i>
            </span>
            <span class="menu-title">Form Elements</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="./pages/tables/basic-table.html">
            <span class="menu-icon">
              <i class="mdi mdi-table-large"></i>
            </span>
            <span class="menu-title">Tables</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="./pages/charts/chartjs.html">
            <span class="menu-icon">
              <i class="mdi mdi-chart-bar"></i>
            </span>
            <span class="menu-title">Charts</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="./pages/icons/mdi.html">
            <span class="menu-icon">
              <i class="mdi mdi-contacts"></i>
            </span>
            <span class="menu-title">Icons</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <span class="menu-icon">
              <i class="mdi mdi-security"></i>
            </span>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="./pages/samples/blank-page.html"> Blank Page </a></li>
              <li class="nav-item"> <a class="nav-link" href="./pages/samples/error-404.html"> 404 </a></li>
              <li class="nav-item"> <a class="nav-link" href="./pages/samples/error-500.html"> 500 </a></li>
              <li class="nav-item"> <a class="nav-link" href="./pages/samples/login.html"> Login </a></li>
              <li class="nav-item"> <a class="nav-link" href="./pages/samples/register.html"> Register </a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
            <span class="menu-icon">
              <i class="mdi mdi-file-document-box"></i>
            </span>
            <span class="menu-title">Documentation</span>
          </a>
        </li>
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
          <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
              <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                <input type="text" class="form-control" placeholder="Search products">
              </form>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-lg-block">
              <!-- <button class="file-upload-browse btn btn-danger  btn-fw" type="button">Upload EE File</button> -->
              <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" aria-expanded="false" href="ee_uploader.php">EE Programe Upload</a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                <div class="form-group">

                  <input type="file" name="img[]" class="file-upload-default">
                  <div class="input-group col-xs-12">
                    <!-- <input type="text" class="form-control file-upload-info" disabled="" placeholder=""> -->
                    <input id="fileupload" type="file" name="fileupload" class="form-control file-upload-info"  />
                    <span class="input-group-append">

                      <span class="input-group-append">
                        <!-- <button class="file-upload-browse btn btn-danger  btn-fw" type="button">Upload EE File</button> -->
                        <button id="upload-button" class="file-upload-browse btn btn-success  btn-fw" type="button" name="inputfile" onclick="uploadFile()"> Upload EE File To Server </button>

                      </span>    
                      <button class="btn btn-danger  btn-fw" type="button" name=""
                      onclick="formateEEFile()" >Send EE File to AC</button>
                    </span>                      
                  </div>
                </div>

              </div>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">Serial Monitor</a>
            </li>

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
            <div class="card-body">
              <h4 class="card-title">EEPROM SEGMENT : 01</h4>
              <button type="button" class="btn btn-danger btn-icon-text" onclick="uploadEEDataO()">
                <i class="mdi mdi-upload btn-icon-prepend"></i> Upload 
              </button>
              
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ADDRESS</th>
                      <th>FILE DATA</th>
                      <th>DEVICE DATA</th>
                      <th>REMARKS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $hexDataO = "IDU,0,127,";
                    for ($i=1; $i <= 128 ; $i++) { 
                      $hexDataO .=hexdec($SEGMNT[$i]) .","; 
                      echo "<tr>
                      <td>".number_format($i) ."</td>                            
                      <td class=\"text-success\"> ".strtoupper($SEGMNT[$i])." </td>
                      <td class=\"text-danger\"> 00 </td>
                      <td> N/A </td>
                      </tr>";                      
                    }
                    ?>                    
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-body">
              <h4 class="card-title">EEPROM SEGMENT : 02</h4>
              <button type="button" class="btn btn-danger btn-icon-text" onclick="uploadEEDataT()">
                <i class="mdi mdi-upload btn-icon-prepend"></i> Upload 
              </button>
              
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ADDRESS</th>
                      <th>FILE DATA</th>
                      <th>DEVICE DATA</th>
                      <th>REMARKS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $hexDataT = "IDU,128,127,";
                    for ($i=129; $i <= 256 ; $i++) { 
                      $hexDataT .=hexdec($SEGMNT[$i]) .",";
                      echo "<tr>
                      <td>".number_format($i) ."</td>                            
                      <td class=\"text-success\"> ".strtoupper($SEGMNT[$i])." </td>
                      <td class=\"text-danger\"> 00 </td>
                      <td> N/A </td>
                      </tr>";                      
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div> 

        </div>
      </div>            
    </div>
    

    <!-- partial:./partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
      </div>
    </footer>
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- fgfgfgf -->
<style>
  #myProgress {
    width: 100%;
    background-color: #ddd;
  }

  #myBar {
    width: 1%;
    height: 30px;
    background-color: #04AA6D;
  }
</style>
<body>

  <h1>JavaScript Progress Bar</h1>

  <div id="myProgress">
    <div id="myBar"></div>
  </div>

  <br>
  <button onclick="move()">Click Me</button> 

  <script>
    var i = 0;
    function move() {
      if (i == 0) {
        i = 1;
        var elem = document.getElementById("myBar");
        var width = 1;
        var id = setInterval(frame, 10);
        function frame() {
          if (width >= 100) {
            clearInterval(id);
            i = 0;
          } else {
            width++;
            elem.style.width = width + "%";
          }
        }
      }
    }
  </script>


  <!-- dfdfdfsdf -->


  <script src="js/jquery-1.11.2.min.js"></script>
  <script>
    //var submittedMessage = $(':text[name="message"]').val();
    function uploadEEDataO() {
      var mal = "<?php echo $hexDataO;?>";
      //console.log(mal);

      $.ajax({
       type: 'GET',
       url:  'controller/formate.php',
       data: {mal}
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
    //var submittedMessage = $(':text[name="message"]').val();
    function uploadEEDataT() {
      var mal = "<?php echo $hexDataT;?>";
      //console.log(mal);

      $.ajax({
       type: 'GET',
       url:  'controller/formate.php',
       data: {mal}
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
          body: formData
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