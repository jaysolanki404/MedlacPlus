<?php

require_once 'config/config.php';
$doctor_id = $_SESSION['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $working_days = implode(", ", $_POST['working_days']);
    $consulting_from = $_POST['consulting_from'];
    $consulting_till = $_POST['consulting_till'];



    $sql = "UPDATE doctor SET working_days = :working_days, working_from = :consulting_from, working_till = :consulting_till WHERE id = :doctor_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':working_days', $working_days);
    $stmt->bindParam(':consulting_from', $consulting_from);
    $stmt->bindParam(':consulting_till', $consulting_till);
    $stmt->bindParam(':doctor_id', $doctor_id);


    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    }



}
?>




<?php require_once 'toaster.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/display.css">
    <style>
        .error-message {
            color: red;
        }

        .submit-botton {
            margin-left: 430px;
            margin-top: 40px;
        }

        .drop {
            width: 103.5%;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <div class="sidebar">
        <div class="sidebar">
            <?php require_once 'sidepenal.php'; ?>
        </div>
    </div>
    <main class="main-content border-radius-lg ">

        <?php require_once 'header.php'; ?>


        <div class="container-fluid py-4">
            <div class="row" style="display:inline;">
                <div class="col-lg-7 position-relative z-index-2">



                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <button onclick="history.back()"
                                style="background-color:#47A0F0; padding:5px 15px 5px 15px;" class="btn btn-dark"><i
                                    class=" fa-solid fa-arrow-left"></i></button>
                            <div class="card">
                                <div class="card-header" style="background-color:#46a0f0fe; color:white;">Consulting
                                    Time
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="chemist" enctype="multipart/form-data">

                                        <input type="hidden" name="new" value="1" />





                                        <!-- consulting_from -->
                                        <div class="form-group row">
                                            <label for="consulting_from"
                                                class="col-md-4 col-form-label text-md-right">Consulting From</label>
                                            <div class="col-md-6">
                                                <select id="timeSelect" class="form-control" name="consulting_from">
                                                </select>

                                            </div>
                                        </div>


                                        <!-- consulting_till -->
                                        <div class="form-group row">
                                            <label for="consulting_till"
                                                class="col-md-4 col-form-label text-md-right">Consulting Till</label>
                                            <div class="col-md-6">
                                                <select id="timeSelect1" class="form-control" name="consulting_till">
                                                </select>

                                            </div>
                                        </div>



                                        <!-- Days of the Week -->
                                        <div class="form-group row">
                                            <label for="working_days" class="col-md-4 col-form-label text-md-right">Days
                                                of the Week</label>
                                            <div class="col-md-6">
                                                <select class="drop" name="working_days[]" id="working_days" multiple
                                                    multiselect-search="true" multiselect-select-all="true"
                                                    multiselect-max-items="7"
                                                    onchange="console.log(this.selectedOptions)">
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                    <option value="Sunday">Sunday</option>
                                                </select>
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
    <script src="assets/js/chemist_validation.js"></script>
    <script src="assets/js/statencity.js"></script>
    <script src="assets/js/time.js"></script>
    <script src="assets/js/multiselect-dropdown.js"></script>
</body>

</html>