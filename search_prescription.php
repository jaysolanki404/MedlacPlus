<?php require_once 'toaster.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/display.css">
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }

        #loading-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            /* Set background color if needed */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #loading-gif {
            width: 300px;
            /* Adjust the width of your GIF */
            height: auto;
        }

        .centered-marquee {
            text-align: center;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">

    <strong>
        <marquee height="42" width="100%" bgcolor="#87CEEB" style="color:white;">
            SCAN OR ENTER THE PATIENT CARD DETAILS
        </marquee>
    </strong>

    <div id="loading-container" style="background-color:#b4ccbb;">
        <img src="assets/img/scancard.gif" id="loading-gif" alt="Loading GIF">
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <img src="assets/img/typing.gif" id="loading-gif" alt="Loading GIF">
    </div>
    <div class="sidebar">
        <?php require_once 'sidepenal.php'; ?>
    </div>
    <main class="main-content border-radius-lg ">

        <?php require_once 'header.php'; ?>


        <div class="container-fluid py-4">
            <div class="row" style="display:inline;">
                <div class="col-lg-7 position-relative z-index-2">
                    <button onclick="history.back()">Back</button>



                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header" style="background-color:#46a0f0fe; color:white;"><b> Search
                                        Prescription</b>
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="prescription" action="find_prescription.php"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="new" value="1" />
                                        <!-- First Name -->
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Enter
                                                Patient Id</label>
                                            <div class="col-md-6">
                                                <input type="text" id="search_prescription" class="form-control"
                                                    name="search_prescription" autofocus>
                                                <span class="error-message" id="prescription-error"></span>
                                            </div>
                                        </div>


                                        <div class="col-md-6 offset-md-4">
                                            <!-- <button type="submit" class="btn btn-primary">ADD</button> -->
                                            <input type="submit">
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
    <script src="assets/js/prescription.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                document.getElementById("loading-container").style.display = "none";
                document.getElementById("main-content").style.display = "block";
            }, 500);
        });
    </script>

    <script src="assets/js/delete.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>

</body>

</html>