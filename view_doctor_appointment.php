<?php

require_once 'toaster.php';
require_once 'config/config.php';
$id = $_SESSION['id'];
$query = "SELECT * FROM doctor";
$stmt = $conn->prepare($query);
$stmt->execute();
$doctors = $stmt->fetchAll(); // Fetch all doctors

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once 'css_links.php'; ?>
    <?php require_once 'table_links.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/display.css">
    <style>
        body {
            background: #DCDCDC;
            margin-top: 20px;
        }

        .main-content {
            padding: 21px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .card-box {
            padding: 20px;
            border-radius: 3px;
            margin-bottom: 30px;
            background-color: #fff;
        }

        .text-muted {
            color: #98a6ad !important;
        }

        h4 {
            line-height: 22px;
            font-size: 18px;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="sidebar">
        <?php require_once 'sidepenal.php'; ?>
    </div>
    <main class="main-content">
        <?php require_once 'header.php'; ?>
        <!---main table--->
        <div class="content">
            <div class="container">
                <?php $count = 0; ?>
                <?php foreach ($doctors as $doctor): ?>
                <?php if ($count % 3 == 0): ?>
                <div class="row">
                    <?php endif; ?>
                    <div class="col-lg-4">
                        <div class="text-center card-box">
                            <div class="member-card pt-2 pb-2">

                                <div class="thumb-lg member-thumb mx-auto">
                                    <?php
                                    $imageData = $doctor['profile_photo'];
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="License Photo" height=150px width=150px/>';
                                    ?>
                                </div>
                                <div class>
                                    <h4>
                                        <?php echo $doctor['first_name'] . ' ' . $doctor['last_name']; ?>
                                    </h4>
                                    <p class="text-muted">
                                        <?php echo $doctor['specialist']; ?><span>| </span><span>
                                            <?php echo $doctor['qualification']; ?>
                                        </span>
                                    </p>
                                    <?php echo $doctor['hospital']; ?>
                                </div>
                                <a href="book_appointment.php?id=<?php echo $doctor["id"]; ?>">
                                    <button type="button"
                                        class="btn btn-primary mt-3 btn-rounded waves-effect w-md waves-light"
                                        style="background-color:#5C1894;">BOOK
                                        APPOINTMENT</button>
                                </a>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mt-3">
                                                <h4>
                                                    <?php echo $doctor['working_days']; ?>
                                                </h4>
                                                <p class="mb-0 text-muted">Working Days</p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mt-3">
                                                <h4>
                                                    <?php echo $doctor['working_from']; ?>
                                                </h4>
                                                <p class="mb-0 text-muted">Working From</p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mt-3">
                                                <h4>
                                                    <?php echo $doctor['working_till']; ?>
                                                </h4>
                                                <p class="mb-0 text-muted">Working Till</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($count % 3 == 2 || $count == count($doctors) - 1): ?>
                </div>
                <?php endif; ?>
                <?php $count++; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script>
        new DataTable('#example');
    </script>
    <script src="assets/js/delete.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>