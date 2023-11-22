<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Air Conditoner</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="../../index.html"><img src="../../assets/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
      </div>
      <ul class="nav">
        <li class="nav-item menu-items">
          <a class="nav-link" href="index.html">
            <span class="menu-icon">
              <i class="mdi mdi-credit-card-multiple"></i>
            </span>
            <span class="menu-title">Device Registration</span>
          </a>
        </li>
        <li class="nav-item nav-category">
          <span class="nav-link">Connected Device</span>
        </li>

        <li class="nav-item menu-items">
          <a class="nav-link" href="index.html">
            <span class="menu-icon">
              <i class="mdi mdi-cellphone"></i>
            </span>
            <span class="menu-title">01675702741</span>
          </a>
        </li>


      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <div class="main-panel">
        <div class="content-wrapper">

          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Device Registration form</h4>

                <form action="./controller/register.php" class="forms-sample" method="post">
                  <div class="form-group">
                    <label for="exampleInputUsername1">Zone</label>
                    <select class="form-control" id="zone" name="zone" value ="">
                      <option value ="Dhaka">Dhaka</option>
                      <option value ="Borisal">Borisal</option>
                      <option value ="Khulna">Khulna</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sub Zone</label>
                    <select class="form-control" id="subZone" name="subZone" value="">
                      <option value ="North">North</option>
                      <option value ="South">South</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="text" class="form-control" id="mobNo" name="mobNo" placeholder="016XXXXXXX" >
                  </div>
                  <button type="submit" class="btn btn-primary mr-2" value="Submit">Submit</button>

                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © WALTON Air Conditoner 2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Developped By <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Research & Innovation</a> </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script>
    function register(value) {
      console.log(value);
      request = $.ajax({

        url: "./controller/register.php",
        type: "get",
        data: {"id":value}
      });
      request.done(function (response, textStatus, jqXHR){
      });
      request.fail(function (jqXHR, textStatus, errorThrown){

        console.error(
          "The following error occurred: "+
          textStatus, errorThrown
          );
      });
    }
  </script>
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>
</html>