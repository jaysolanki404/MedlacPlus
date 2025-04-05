<?php require_once 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <style>
    /* Style for the rectangular cards */
    .col-lg-5.col-sm-5 {
      padding: 0;
      /* Remove default padding */
      margin: 10px;
      /* Add some margin for spacing */
      border-radius: 10px;
      /* Add rounded corners */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      /* Add a shadow effect */
      background-color: #ffffff;
      /* Background color for the cards */
      transition: transform 0.2s;
      /* Add a smooth transition effect */
      overflow: hidden;
      /* Hide any overflowing content */
      max-width: 250px;
      /* Limit the maximum width of the cards */
    }

    /* Style for the card headers */
    .card-header {
      padding: 20px;
      position: relative;
      background-color: #f5f5f5;
      /* Background color for the headers */
    }

    /* Style for the icons */
    .icon-shape {
      width: 60px;
      /* Adjust the width of the icon container */
      height: 60px;
      /* Adjust the height of the icon container */
      display: flex;
      align-items: first baseline;
      justify-content: first baseline;
      border-radius: 50%;
      /* Make the icon container circular */
      position: relative;
      top: 20px;

      /* Position the icon container above the header */
      left: 20%;
      /* Center the icon horizontally */
      transform: translateX(-50%);
      /* Center the icon horizontally */
      background: linear-gradient(45deg, #ffffff, #e0e0e0);
      /* Gradient background for the icons */
    }

    /* Style for the text content */
    .text-end {
      text-align: right;
      /* Align text to the right */
    }

    /* Style for the card footers */
    .card-footer {
      padding: 20px;
      background-color: #f5f5f5;
      /* Background color for the footers */
    }

    /* Hover effect to scale the cards */
    .col-lg-5.col-sm-5:hover {
      transform: scale(1.2);
      /* Scale up the card on hover */
    }

    a {
      font-weight: 700;
    }
  </style>


  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://kit.fontawesome.com/72c602bb8f.js" crossorigin="anonymous"></script>
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/jpeg" href="./assets/img/favicon.jpeg">
  <title>
    MedlacPlus
  </title>
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/display.css">




</head>


<body class="g-sidenav-show  bg-gray-100">
  <div class="sidebar">
    <div class="sidebar">

      <?php require_once 'sidepenal.php'; ?>
      <!-- <?php if ($_SESSION['role'] == 'patient' || $_SESSION['role'] == 'chemist') { ?>
        <?php require_once 'sidepenal_demo.php'; ?>

      <?php } else { ?>
        <?php require_once 'sidepenal.php'; ?>
      <?php } ?> -->
    </div>
  </div>
  <main class="main-content border-radius-lg dashboard">


    <?php require_once 'header.php'; ?>


    <div class="container-fluid py-4">
      <div class="row" style="display:inline;">
        <div class="col-lg-7 position-relative z-index-2">

          <div class="row">

            <?php if ($_SESSION['role'] == 'admin') { ?>

              <!---doctor--->
            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div
                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-stethoscope"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Doctors</p>
                    <h4 class="mb-0">
                      <?php
                      $query = "SELECT count(*) as total_row FROM doctor";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <a href="view_doctor.php">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>View Doctors</p>
                  </a>
                </div>
              </div>
            </div>

            <!---patient--->
            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-bed-pulse"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Patients</p>
                    <h4 class="mb-0">
                      <?php
                      $query = "SELECT count(*) as total_row FROM patient";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <a href="view_patient.php">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>View Patients</p>
                  </a>
                </div>
              </div>
            </div>

            <!---chemist--->
            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div
                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-flask-vial"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Chemist</p>
                    <h4 class="mb-0 ">
                      <?php
                      $query = "SELECT count(*) as total_row FROM chemist";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <a href="view_chemist.php">
                    <p class="mb-0 "><span class="text-success text-sm font-weight-bolder"></span>View Chemist</p>
                  </a>
                </div>
              </div>
            </div>

            <!---receptionist--->
            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-regular fa-address-book"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Receptionist</p>
                    <h4 class="mb-0 ">
                      <?php
                      $query = "SELECT count(*) as total_row FROM receptionist";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <a href="view_receptionist.php">
                    <p class="mb-0 ">View Receptionist</p>
                  </a>
                </div>
              </div>
            </div>

            <?php } elseif ($_SESSION['role'] == 'patient') { ?>

            <!---appoiement--->
            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div style="background: linear-gradient(45deg, #8e24aa, #4a148c);"
                    class="icon icon-lg icon-shape shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-regular fa-calendar-check"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Book Appoiment</p>
                    <h4 class="mb-0 ">
                      <?php
                      $query = "SELECT count(*) as total_row FROM appointment";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <a href="view_my_appointment_patient.php">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>View Appoiment</p>
                  </a>
                </div>
              </div>
            </div>

            <!---doctor--->
            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div style="background: #eeef20;"
                    class="icon icon-lg icon-shape shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-user-doctor" style="color: black;"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Doctor</p>
                    <h4 class="mb-0 ">
                      <?php
                      $query = "SELECT count(*) as total_row FROM doctor";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <a href="view_patient.php">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>View Doctor</p>
                  </a>
                </div>
              </div>
            </div>

            <!---prescription--->
            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div style="background: linear-gradient(45deg, #ff9800, #ff5722);"
                    class="icon icon-lg icon-shape shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-prescription"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Prescription</p>
                    <h4 class="mb-0 ">
                      <?php
                      $query = "SELECT count(*) as total_row FROM prescription";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <a href="view_patient.php">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>View prescription</p>
                  </a>
                </div>
              </div>
            </div>


            <!---virtual card--->
            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div style="background: #90a955;"
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-credit-card" style="color: black;"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Virtual Card</p>
                    <h4 class="mb-0">
                      &nbsp;
                    </h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <a href="view_card.php">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>View Virtual Card</p>
                  </a>
                </div>
              </div>
            </div>


            <?php } elseif ($_SESSION['role'] == 'doctor') { ?>

            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div style="background: #bc39b9;"
                    class="icon icon-lg icon-shape bg-gradient- shadow- shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-regular fa-calendar-check"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">appoiement</p>
                    <h4 class="mb-0">
                      <?php
                      $doctorId = $_SESSION['id']; // Replace 1 with the actual doctor_id you want to query
                      $query = "SELECT COUNT(*) as total_row FROM appointment WHERE doctor_id = ?";
                      $result = $conn->prepare($query);
                      if ($result->execute([$doctorId])) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <a href="view_my_appointment_doctor.php">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Manage appointment</p>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div style="background: #0c9ec3;"
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-bed-pulse"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Patient</p>
                    <h4 class="mb-0 ">
                      <?php
                      $query = "SELECT count(*) as total_row FROM receptionist";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <a href="view_patient.php">
                    <p class="mb-0 ">Manage Patient</p>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div style="background: #517957;"
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-user-doctor"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Doctor</p>
                    <h4 class="mb-0 ">
                      <?php
                      $query = "SELECT count(*) as total_row FROM doctor";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <a href="view_doctor.php">
                    <p class="mb-0 ">View doctor</p>
                  </a>
                </div>
              </div>
            </div>




            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div style="background: #e865das;"
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-file-prescription"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">prescription</p>
                    <h4 class="mb-0 ">
                      <?php
                      $query = "SELECT count(*) as total_row FROM prescription";
                      $result = $conn->prepare($query);
                      if ($result->execute()) {
                        $fetch = $result->fetch();
                        echo $fetch["total_row"];
                      }
                      ?>
                    </h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <a href="search_prescription.php">
                    <p class="mb-0 ">View prescription</p>
                  </a>
                </div>
              </div>
            </div>




            <?php } elseif ($_SESSION['role'] == 'receptionist') { ?>
            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div style="background: #0c9ec3;"
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-folder-plus"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Register Patient</p>
                    <h4 class="mb-0 ">
                      &nbsp;
                    </h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <a href="form_patient.php">
                    <p class="mb-0 ">Add Patient</p>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div style="background: #dc32b3;" class="icon icon-lg icon-shape bg-gradient-info shadow-in
                    o text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-hospital-user"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">View Patient</p>
                    <h4 class="mb-0 ">
                      &nbsp;
                    </h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <a href="view_patient.php">
                    <p class="mb-0 ">View Patient</p>
                  </a>
                </div>
              </div>
            </div>



            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div style="background: #f37c7e;"
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-calendar-week"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Appointment</p>
                    <h4 class="mb-0">
                      &nbsp
                    </h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <a href="view_my_appointment_doctor.php">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>Manage Appointment</p>
                  </a>
                </div>
              </div>
            </div>






            <div class="col-lg-5 col-sm-5">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div style="background: #70e000;"
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fa-solid fa-print"></i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Printing Layout</p>
                    <h4 class="mb-0 ">
                      &nbsp;
                    </h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <a href="#">
                    <p class="mb-0 ">Print Patient's Card</p>
                  </a>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>



        <div class="row">
          <div class="col-12">
            <div id="globe" class="position-absolute end-0 top-10 mt-sm-3 mt-7 me-lg-7">
              <canvas width="700" height="600" class="w-lg-100 h-lg-100 w-75 h-75 me-lg-0 me-n10 mt-lg-5"></canvas>
            </div>
          </div>
        </div>




      </div>

      <!-- <?php require_once 'footer.php'; ?> -->
  </main>





















  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>









































































  <script async defer src="https://buttons.github.io/buttons.js"></script>


  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>