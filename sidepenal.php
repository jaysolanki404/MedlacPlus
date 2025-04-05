<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <style>
    @import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600);

    /* body{
  font-family: "Lato";
  font-size: 100%; 
    overflow-y: scroll; 
 font-family: sans-serif; 
 -ms-text-size-adjust: 100%; 
 -webkit-text-size-adjust: 100%; 
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale; 
  text-rendering: optimizeLegibility;
  background-color: #fefefe;
} */


    a {
      text-decoration: none;
      transition: all 0.6s ease;

      &:hover {
        transition: all 0.6s ease;
      }
    }

    .app {
      height: 100vh;
    }

    .sidebar {
      position: fixed;
      z-index: 2;
      /* Increase the z-index value */
      /* ... other sidebar styles ... */
    }

    /* -------------
Sidebar
----------------*/
    .sidebar {
      position: absolute;
      width: 17em;
      height: 100%;
      top: 0;
      overflow: hidden;
      background-color: #19222a;
      -webkit-transform: translateZ(0);
      visibility: visible;
      -webkit-backface-visibility: hidden;
    }

    .sidebar header {
      background-color: whitesmoke;
      width: 100%;
      display: block;
      padding: 0.75em 1em;
    }

    /* -------------
Sidebar Nav
----------------*/
    .sidebar-nav {
      position: fixed;
      background-color: white;
      height: 100%;
      font-weight: 400;
      font-size: 1.2em;
      overflow: auto;
      padding-bottom: 6em;
      z-index: 9;
      overflow: hidden;
      -webkit-overflow-scrolling: touch;
    }

    .sidebar-nav ul {
      list-style: none;
      display: block;
      padding: 0;
      margin: 0;
    }

    .sidebar-nav ul li {
      margin-left: 0;
      padding-left: 0;
      display: inline-block;
      width: 100%;
    }

    .sidebar-nav ul li a {
      color: black;
      font-size: 0.75em;
      padding: 1.05em 1em;
      position: relative;
      display: block;
    }

    .sidebar-nav ul li a:hover {
      /* background-color: #743089; */
      transition: all 0.6s ease;
    }

    .sidebar-nav ul li i {
      font-size: 1.8em;
      padding-right: 0.5em;
      width: 9em;
      display: inline;
      vertical-align: middle;
    }

    /* -------------
Chev elements
----------------*/
    .sidebar-nav ul>li>a:after {
      content: '\f125';
      font-family: ionicons;
      font-size: 0.5em;
      width: 10px;
      color: aqua;
      position: absolute;
      right: 0.75em;
      top: 45%;
    }

    /* -------------
Nav-Flyout
----------------*/
    .sidebar-nav .nav-flyout {
      position: absolute;
      background-color: aliceblue;
      z-index: 9;
      left: 2.5em;
      top: 0;
      height: 100vh;
      transform: translateX(100%);
      transition: all 0.5s ease;
    }

    .sidebar-nav .nav-flyout a:hover {
      background-color: rgba(255, 255, 255, 0.05)
    }

    /* -------------
Hover
----------------*/
    .sidebar-nav ul li:hover .nav-flyout {
      transform: translateX(0);
      transition: all 0.5s ease;
      /*-----------------------------------side hover*/
      <?php if ($_SESSION['role'] == 'admin') { ?>
        background-color: #cae6fe;
      <?php } elseif ($_SESSION['role'] == 'doctor') { ?>
        background-color: #facbcb;
      <?php } elseif ($_SESSION['role'] == 'patient') { ?>
        background-color: #bea3d4;
      <?php } elseif ($_SESSION['role'] == 'receptionist') { ?>
        background-color: #93c0bc;
      <?php } elseif ($_SESSION['role'] == 'chemist') { ?>
        background-color: #cae6fe;
      <?php } ?>
    }

    .sidebar {
      position: fixed;
      width: 17em;
      /* Add a width to the sidebar */
      z-index: 1;
      /* Ensure it's on top */
      /* ... other sidebar styles ... */
    }

    a {
      font-weight: 700;
    }
  </style>
</head>

<body>
  <section class="app">
    <aside class="sidebar">
      <a href="dashboard.php">


        <!---------------------------top------------------------->
        <?php if ($_SESSION['role'] == 'admin') { ?>
        <header style="background-color:#216abe; color:#fffffffe">
          <?php } elseif ($_SESSION['role'] == 'doctor') { ?>
          <header style="background-color:#f37c7e; color:black">
            <?php } elseif ($_SESSION['role'] == 'patient') { ?>
            <header style="background-color:#5c1894; color:#fffffffe">
              <?php } elseif ($_SESSION['role'] == 'receptionist') { ?>
              <header style="background-color:#4f9a96; color:#fffffffe">
                <?php } elseif ($_SESSION['role'] == 'chemist') { ?>
                <header style="background-color:#216abe; color:#fffffffe">
                  <?php } ?>
                  <strong>
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                    Admin Panel
                    <?php } elseif ($_SESSION['role'] == 'doctor') { ?>
                    Doctor
                    <?php } elseif ($_SESSION['role'] == 'patient') { ?>
                    Patient
                    <?php } elseif ($_SESSION['role'] == 'receptionist') { ?>
                    Receptionist
                    <?php } elseif ($_SESSION['role'] == 'chemist') { ?>
                    Chemist
                    <?php } ?>
                  </strong>
                </header>
      </a>


      <!--------------------------bottom--------------------------------->
      <?php if ($_SESSION['role'] == 'admin') { ?>
      <nav class="sidebar-nav" style="background-color:#bde0fe;">
        <?php } elseif ($_SESSION['role'] == 'doctor') { ?>
        <nav class="sidebar-nav" style="background-color:#f7a3a5;">
          <?php } elseif ($_SESSION['role'] == 'patient') { ?>
          <nav class="sidebar-nav " style="background-color:#b697cf;">
            <?php } elseif ($_SESSION['role'] == 'receptionist') { ?>
            <nav class="sidebar-nav" style="background-color:#7eb3af;">
              <?php } elseif ($_SESSION['role'] == 'chemist') { ?>
              <nav class="sidebar-nav" style="background-color:#bde0fe;">
                <?php } ?>
                <ul>
                  <?php if ($_SESSION['role'] == 'admin') { ?>
                  <li>
                    <a href="#"><i class="ion-bag"></i> <span>Doctor</span></a>
                    <ul class="nav-flyout">
                      <li>
                        <a href="view_doctor.php"><i class="material-icons">list</i>View Doctor</a>
                      </li>
                      <li>
                        <a href="form_doctor.php"><i class="material-icons">add</i>Add Doctors</a>
                      </li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($_SESSION['role'] == 'admin') { ?>
                  <li>
                    <a href="#"><i class="ion-ios-settings"></i> <span> Receptionists</span></a>
                    <ul class="nav-flyout">
                      <li>
                        <a href="view_receptionist.php"><i class="material-icons">list</i>View Receptionists</a>
                      </li>
                      <li>
                        <a href="form_receptionist.php"><i class="material-icons">add</i>Add Receptionists</a>
                      </li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($_SESSION['role'] == 'admin') { ?>
                  <li>
                    <a href="#"><i class="ion-ios-briefcase-outline"></i> <span class="">Chemist</span></a>
                    <ul class="nav-flyout">
                      <li>
                        <a href="view_chemist.php"><i class="material-icons">list</i>View Chemist</a>
                      </li>
                      <li>
                        <a href="form_chemist.php"><i class="material-icons">add</i>Add Chemist</a>
                      </li>
                    </ul>
                  </li>
                  <?php } ?>


                  <?php if ($_SESSION['role'] == 'doctor') { ?>
                  <li>
                    <a href="consultingtime.php"><i class="ion-ios-briefcase-outline"></i> <span class="">Consulting
                        Time</span></a>

                  </li>
                  <li>
                    <a href="search_doctor.php"><i class="ion-ios-briefcase-outline"></i> <span
                        class="">Doctor</span></a>
                    <ul class="nav-flyout">

                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'doctor' || $_SESSION['role'] == 'receptionist') { ?>

                  <?php if ($_SESSION['role'] == 'receptionist') { ?>
                  <li>
                    <a href="search_card.php"><i class="ion-ios-analytics-outline"></i> <span class="">Card</span></a>
                    <ul class="nav-flyout">






                    </ul>
                  </li>
                  <?php } ?>
                  <li>
                    <a href="#"><i class="ion-ios-analytics-outline"></i> <span class="">Patient</span></a>
                    <ul class="nav-flyout">




                      <li>
                        <a href="view_patient.php"><i class="material-icons">list</i>View Patient</a>
                      </li>
                      <li>
                        <a href="form_patient.php"><i class="material-icons">add</i>Add Patient</a>
                      </li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($_SESSION['role'] == 'doctor') { ?>
                  <li>
                    <a href="#"><i class="ion-ios-analytics-outline"></i> <span class="">Prescription</span></a>
                    <ul class="nav-flyout">
                      <li>
                        <a href="#"><i class="material-icons">list</i>View Prescription</a>
                      </li>
                      <li>
                        <a href="#"><i class="material-icons">add</i>Add Prescription</a>
                      </li>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'patient' || $_SESSION['role'] == 'receptionist' || $_SESSION['role'] == 'doctor') { ?>

                  <?php if ($_SESSION['role'] !== 'admin') { ?>
                  <li>
                    <a href="#"><i class="ion-ios-briefcase-outline"></i> <span class="">Appointment</span></a>
                    <ul class="nav-flyout">
                      <li>
                        <?php if ($_SESSION['role'] == 'patient') { ?>
                        <a href="view_my_appointment_patient.php"><i class="material-icons">list</i>View Appointment</a>
                        <?php } else { ?>
                        <a href="view_my_appointment_doctor.php"><i class="material-icons">list</i>View Appointment</a>
                        <?php } ?>
                      </li>
                      <li>
                        <?php if ($_SESSION['role'] == 'patient') { ?>
                        <a href="book_appointment.php"><i class="material-icons">add</i>Add Appointment</a>
                        <?php } else { ?>
                        <a href="form_appointment.php"><i class="material-icons">add</i>Add Appointment</a>
                        <?php } ?>
                      </li>
                    </ul>
                  </li>
                  <?php } ?>
                  <?php } ?>
                  <?php if ($_SESSION['role'] == 'patient') { ?>
                  <li>
                    <a href="view_card.php"><i class="ion-ios-briefcase-outline"></i> <span class="">Virtual
                        Card</span></a>

                  </li>

                  <li>
                    <a href="view_card.php"><i class="ion-ios-briefcase-outline"></i> <span
                        class="">Prescription</span></a>

                  </li>
                  <?php } ?>
                </ul>
              </nav>
    </aside>
  </section>
</body>

</html>