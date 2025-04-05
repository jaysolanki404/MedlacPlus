<html>

<head>
  <style>
    .nav-link {
      color: black !important;
    }
  </style>

</head>

<body>

  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="profile_<?php echo $_SESSION['role']; ?>.php" class="nav-link text-body font-weight-bold px-0"
              style="color: black;">
              <i class="fa-solid fa-id-card-clip" style="color: black;"></i> Profile
            </a>
          </li>




        </ul>
      </div>
    </div>
  </nav>

</body>

</html>