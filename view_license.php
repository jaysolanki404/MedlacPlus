<?php require_once 'config/config.php';?>

<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://kit.fontawesome.com/72c602bb8f.js" crossorigin="anonymous"></script>
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/jpeg" href="./assets/img/favicon.jpeg">
  <title>
    MedlacPlus
  </title>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />

<link rel="stylesheet" href="assets/css/display.css">


<link href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.semanticui.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    
</head>


<body>

<div class="sidebar">
    <?php require_once 'sidepenal.php';?> 
</div>
  <main class="main-content">


  <?php require_once 'header.php';?>


    <div class="container-fluid py-4">
      <div class="row" style="display:inline;">
        <div class="col-lg-7 position-relative z-index-2">


        <a href="form_license">Add</a>


                        <!-- Table -->
                    <table id="example" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th><strong>id</strong></th>
                                <th><strong>License Number</strong></th>
                                <th><strong>action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // require 'config/config.php';
                            $query = "SELECT * FROM license ORDER BY id;";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();



                            while ($row =  $stmt->fetch()) { ?>
                                <tr>
                                    <td><?php echo $row["id"]; ?></td>
                                    <td><?php echo $row["number"]; ?></td>
                                
                                    <td>
                                      <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>, 'license', 'delete.php')">
    <i class='material-icons'>delete</i>
</a>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
          
            </div>
          </div>
        </div>
        <!-- </div> -->



        

      </div>

  
    </main>

    <script src="assets/js/delete.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script>
new DataTable('#example');
   </script>



  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="./assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>