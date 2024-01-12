<?php
require_once 'config/config.php';
// Fetch the list of doctors
$query = "SELECT * FROM doctor";
$stmt = $conn->prepare($query);
$stmt->execute();
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once 'toaster.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/display.css">
    <style>
        .submit-botton {
            margin-left: 430px;
            margin-top: 40px;
        }
    </style>

</head>

<body class="g-sidenav-show  bg-gray-100">

    <div class="sidebar">
        <?php require_once 'sidepenal.php'; ?>
    </div>
    <main class="main-content border-radius-lg ">

        <?php require_once 'header.php'; ?>


        <div class="container-fluid py-4">
            <div class="row" style="display:inline;">
                <div class="col-lg-7 position-relative z-index-2">




                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <button onclick="history.back()"
                                style="background-color:#e91e63; padding:5px 15px 5px 15px;" class="btn btn-dark"><i
                                    class=" fa-solid fa-arrow-left"></i></button>
                            <div class="card">
                                <div class="card-header">Add Appointment</div>
                                <div class="card-body">
                                    <form method="POST" id="patient" action="add_patient.php"
                                        enctype="multipart/form-data">


                                        <input type="hidden" name="new" value="1" />

                                        <!-- First Name -->
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="first_name" class="form-control"
                                                    name="first_name">
                                                <span class="error-message" id="first_name-error"></span>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="form-group row">
                                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="last_name" class="form-control" name="last_name">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="doctor" class="col-md-4 col-form-label text-md-right">Select
                                                Doctor</label>
                                            <div class="col-md-6">
                                                <select id="doctor" class="form-control" name="doctor">
                                                    <?php foreach ($doctors as $doctor): ?>
                                                        <option value="<?= $doctor['id'] ?>">
                                                            <?= $doctor['first_name'] . ' ' . $doctor['last_name'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- Phone -->
                                        <div class="form-group row">
                                            <label for="phone"
                                                class="col-md-4 col-form-label text-md-right">Phone</label>
                                            <div class="col-md-6">
                                                <input type="tel" id="phone" class="form-control" name="phone">
                                            </div>
                                        </div>



                                        <div class="submit-botton">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <?php require_once 'js_links.php'; ?>
    <script src="assets/js/patient_validation.js"></script>

</body>

</html>