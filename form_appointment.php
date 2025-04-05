<?php
require_once 'config/config.php';
// Fetch the list of doctors
$query = "SELECT * FROM doctor";
$stmt = $conn->prepare($query);
$stmt->execute();
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);


$query1 = "SELECT * FROM patient";
$stmt = $conn->prepare($query1);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                                <div class="card-header" style="background-color:#46a0f0fe; color:white;">Add
                                    Appointment</div>
                                <div class="card-body">
                                    <form method="POST" id="patient" action="add_appointment.php"
                                        enctype="multipart/form-data">


                                        <input type="hidden" name="new" value="1" />


                                        <div class="form-group row">
                                            <label for="doctor" class="col-md-4 col-form-label text-md-right">Select
                                                Patient</label>
                                            <div class="col-md-6">
                                                <input type="number" id="patient" class="form-control" name="patient">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="doctor" class="col-md-4 col-form-label text-md-right">Select
                                                Doctor</label>
                                            <div class="col-md-6">
                                                <select id="doctor" class="form-control" name="doctor">
                                                    <option value="" disabled selected>Select doctor</option>
                                                    <?php foreach ($doctors as $doctor): ?>
                                                        <option value="<?= $doctor['id'] ?>">
                                                            <?= $doctor['first_name'] . ' ' . $doctor['last_name'] . ' (' . $doctor['specialist'] . ')' ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- date -->
                                        <div class="form-group row">
                                            <label for="date" class="col-md-4 col-form-label text-md-right">date</label>
                                            <div class="col-md-6">
                                                <input type="date" id="datePicker" class="form-control" name="date">
                                            </div>
                                        </div>


                                        <!-- time -->
                                        <div class="form-group row">
                                            <label for="time" class="col-md-4 col-form-label text-md-right">time</label>
                                            <div class="col-md-6">
                                                <select id="timeSelect" class="form-control" name="time">
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="note" class="col-md-4 col-form-label text-md-right">Note</label>
                                            <div class="col-md-6">
                                                <textarea id="note" class="form-control" name="note"
                                                    rows="4"></textarea>
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
    <script src="assets/js/date.js"></script>
    <?php require_once 'js_links.php'; ?>
    <script src="assets/js/patient_validation.js"></script>
    <script src="assets/js/time.js"></script>
</body>

</html>