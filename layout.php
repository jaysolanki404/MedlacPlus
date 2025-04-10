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

</head>


<body class="g-sidenav-show  bg-gray-100">

<!---sidepenal--->
  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">

    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
        target="_blank">
        <img src="./assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
      </a>
    </div>


    <hr class="horizontal light mt-0 mb-2">





    <ul>
        <li>
        <a href="#">Doctor<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="view_doctor.php"><i class="fa fa-list fa-fw"></i>View Doctor</a>
                </li>
                <li>
                    <a href="add_doctor.php"><i class="fa fa-plus fa-fw"></i>Add Doctor</a>
                </li>
            </ul>
      </li>
    </ul>


    <ul>
        <li>
        <a href="#">Patient<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="view_patient.php"><i class="fa fa-list fa-fw"></i>View Patient</a>
                </li>
                <li>
                    <a href="add_patient.php"><i class="fa fa-plus fa-fw"></i>Add Patient</a>
                </li>
            </ul>
      </li>
    </ul>



    <ul>
        <li>
        <a href="#">Chemist<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="view_chemist.php"><i class="fa fa-list fa-fw"></i>View Chemist</a>
                </li>
                <li>
                    <a href="add_chemist.php"><i class="fa fa-plus fa-fw"></i>Add Chemist</a>
                </li>
            </ul>
      </li>
    </ul>


    



    <ul>
        <li>
        <a href="#">Receptionist<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="view_receptionist.php"><i class="fa fa-list fa-fw"></i>View Receptionist</a>
                </li>
                <li>
                    <a href="add_receptionist.php"><i class="fa fa-plus fa-fw"></i>Add Receptionist</a>
                </li>
            </ul>
      </li>
    </ul>





    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link text-white " href="./dashboard.html">

            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>

            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

      </ul>
    </div>

    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn btn-outline-primary mt-4 w-100"
          href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard?ref=sidebarfree"
          type="button">Documentation</a>
      </div>
    </div>

  </aside>
  <main class="main-content border-radius-lg ">

<!---Header--->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">

          <!-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">index</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">index</h6> -->

        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

            <!-- <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div> -->

          </div>
          <ul class="navbar-nav  justify-content-end">
            <!-- <li class="nav-item d-flex align-items-center">
              <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank"
                href="https://www.creative-tim.com/builder?ref=navbar-material-dashboard">Online Builder</a>
            </li> -->
            <li class="mt-2">
              <!-- <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard"
                data-icon="octicon-star" data-size="large" data-show-count="true"
                aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a> -->
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <!-- <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a> -->
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <!-- <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a> -->

              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/small-logos/logo-spotify.svg"
                          class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background"
                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                    opacity="0.593633743"></path>
                                  <path class="color-background"
                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                  </path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="#" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>Profile

                <!-- <span class="d-sm-inline d-none">Sign In</span> -->

              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


       <div class="container-fluid py-4">


        

      </div>

      <?php require_once 'footer.php';?>
    </main>




















  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>










































 





























  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>


  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>