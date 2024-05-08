<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>WALTON Air Conditoner</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./../assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="./../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="./../assets/images/favicon.png" />
</head>
<body>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ee_monitoring";


  $devLogs = array();
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM `log` ORDER BY `id` DESC LIMIT 500;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      //echo $row["data"];
      //echo "<pre>";print_r($value);echo "</pre>";
      array_push( $devLogs,$row);
    }
  } else {
    echo "0 results";
  }
  $conn->close();
  ?>
  <div class="container-scroller">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">

      <ul class="nav">
        <li class="nav-item menu-items">
          <a class="nav-link" href="register.php"  method="post">
            <span class="menu-icon">
              <i class="mdi mdi-credit-card-multiple"></i>
            </span>
            <span class="menu-title">Device Registration</span>
          </a>
        </li>

        <li class="nav-item menu-items">
          <a class="nav-link" href="logs.php"  method="post">
            <span class="menu-icon">
              <i class="mdi mdi-credit-card-multiple"></i>
            </span>
            <span class="menu-title">Log Report</span>
          </a>
        </li>

        <li class="nav-item nav-category">
          <span class="nav-link">Connected Device</span>
        </li>            


      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="content-wrapper">
        <div class="card-body">
          <h4 class="card-title">Device Logs</h4>

          <div class="table-responsive">
            <table class="table table-dark">
              <thead>
                <tr>
                  <!-- <th> ID </th>
                  <th> Mob</th> -->
                  <th> 0</th>
                  <th> 1</th>
                  <th> 2</th>
                  <th> 3</th>
                  <th> 4</th>
                  <th> 5</th>
                  <th> 6</th>
                  <th> 7</th>
                  <th> 8</th>
                  <th> 9</th>
                  <th> 10</th>
                  <th> 11</th>
                  <th> 12</th>
                  <th> 13</th>
                  <th> 14</th>
                  <th> 15</th>
                  <th> 16</th>
                  <th> 17</th>
                  <th> 18</th>
                  <th> 19</th>
                  <th> 20</th>
                  <th> 21</th>
                  <th> 22</th>
                  <th> 23</th>
                  <th> 24</th>
                  <th> 25</th>
                  <th> 26</th>
                  <th> 27</th>
                  <th> 28</th>
                  <th> 29</th>
                  <th> 30</th>
                  <th> 31</th>
                  <th> 32</th>
                  <th> 33</th>
                  <th> 34</th>
                  <th> 35</th>
                  <th> 36</th>
                  <th> 37</th>
              

                  <th> Time </th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($devLogs as $key => $value) {

                  $cellData = explode(",", $value["data"]);
                  $time = explode(" ", $value["created"]);
                  //"<tr><td>".$value["id"]."</td><td>".$value["mob_no"].
                  // "</td><td>".$cellData[1]."</td><td>".
                  // "</td><td>".$cellData[2]."</td><td>".
                  // "</td><td>".$cellData[3]."</td><td>".
                  // "</td><td>".$cellData[4]."</td><td>".
                  // "</td><td>".$cellData[5]."</td><td>".
                  // "</td><td>".$cellData[6]."</td><td>".
                  // "</td><td>".$cellData[7]."</td><td>".
                  //print_r($cellData);
                  echo "</tr><td>".$cellData[0].
                  "</td><td>".hexdec($cellData[1]).
                  "</td><td>".hexdec($cellData[2]).
                  "</td><td>".hexdec($cellData[3]).
                  "</td><td>".hexdec($cellData[4]).
                  "</td><td>".hexdec($cellData[5]).
                  "</td><td>".hexdec($cellData[6]).
                  "</td><td>".hexdec($cellData[7]).
                  "</td><td>".hexdec($cellData[8]).
                  "</td><td>".hexdec($cellData[9]).
                  "</td><td>".hexdec($cellData[10]).
                  "</td><td>".hexdec($cellData[11]).
                  "</td><td>".hexdec($cellData[12]).
                  "</td><td>".hexdec($cellData[13]).
                  "</td><td>".hexdec($cellData[14]).
                  "</td><td>".hexdec($cellData[15]).
                  "</td><td>".hexdec($cellData[16]).
                  "</td><td>".hexdec($cellData[17]).
                  "</td><td>".hexdec($cellData[18]).
                  "</td><td>".hexdec($cellData[19]).
                  "</td><td>".hexdec($cellData[20]).
                  "</td><td>".hexdec($cellData[21]).
                  "</td><td>".hexdec($cellData[22]).
                  "</td><td>".hexdec($cellData[23]).
                  "</td><td>".hexdec($cellData[24]).
                  "</td><td>".hexdec($cellData[25]).
                  "</td><td>".hexdec($cellData[26]).
                  "</td><td>".hexdec($cellData[27]).
                  "</td><td>".hexdec($cellData[28]).
                  "</td><td>".hexdec($cellData[29]).
                  "</td><td>".hexdec($cellData[30]).
                  "</td><td>".hexdec($cellData[31]).
                  "</td><td>".hexdec($cellData[32]).
                  "</td><td>".hexdec($cellData[33]).
                  "</td><td>".hexdec($cellData[34]).
                  "</td><td>".hexdec($cellData[35]).
                  "</td><td>".hexdec($cellData[36]).
                  "</td><td>".hexdec($cellData[37]).
                  "</td><td>".$time[1]."</td></tr>";
                }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div>    
      </div>

      <script src="./../assets/vendors/js/vendor.bundle.base.js"></script>
      <script src="./../assets/js/off-canvas.js"></script>
      <script src="./../assets/js/hoverable-collapse.js"></script>
      <script src="./../assets/js/misc.js"></script>
      <script src="./../assets/js/settings.js"></script>
      <script src="./../assets/js/todolist.js"></script>
    </body>
    </html>