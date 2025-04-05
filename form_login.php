<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- <style>
        body{
           background-color: #29C5F6;
        }
    </style> -->


    <style>
        body {

            background-image: url('assets/img/back.jpg');
            /* Replace 'background.jpg' with the path to your background image */
            background-size: cover;
            /* This will make sure the image covers the entire viewport */
            background-repeat: no-repeat;
            /* This prevents the image from repeating */
        }

        /* Custom alert styling */
        #captcha-alert {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f44336;
            /* Red background color */
            color: white;
            /* White text color */
            font-weight: bold;
            text-align: center;
        }

        .card {
            border: none;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            min-width: 750px;
        }

        .card-header {
            background-color: #3b6c25;
            color: white;
        }

        .card-body {
            background-color: #85b86e;
        }

        .dropdown {
            background-color: #85b86e;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer>
    </script>
</head>

<body>
    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="card mt-5" style="width:500px">
            <div class="card-header">
                <h1 class="text-center">Login</h1>
            </div>
            <div class="card-body">
                <form id="myForm" method="POST" action="verify_login.php" onsubmit="return validateForm();">
                    <div class="mt-2">
                        <?php
                        session_start();
                        if (isset($_SESSION['error']) && $_SESSION['error'] == 'unvalid') { ?>
                            <h5 align="center" class="invalid" style="color: red;">Invalid email or password</h5>
                        <?php }
                        unset($_SESSION['error']);
                        ?>

                        <strong><label for="role"> Select Role </label></strong>
                        <select class="form-control" name="role">
                            <option value="" disabled selected>Select Role</option>
                            <option class="dropdown" value="admin">Admin</option>
                            <option class="dropdown" value="doctor">Doctor</option>
                            <option class="dropdown" value="patient">Patient</option>
                            <option class="dropdown" value="chemist">Chemist</option>
                            <option class="dropdown" value="receptionist">Receptionist</option>
                        </select>
                        <br>

                        <strong><label for="email">Email : </label></strong>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                        <br>

                        <strong><label for="Password">Password : </label></strong>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">

                        <div class="mt-4 text-end">
                            <a href="forgot_password.php" style="padding-right: 341px;" color="white">Forgot
                                Password?</a><br>

                            <input type="submit" name="login" value="login" class="btn btn-primary" color="#3b6c25">
                        </div>

                        <div class="g-recaptcha" id="captcha-container"
                            data-sitekey="6LdjeuwnAAAAAI12SXUiC02h1m8VuDuTZssRhFkU"></div>
                        <div id="captcha-alert" class="alert alert-danger" style="display: none;">
                            Please complete the CAPTCHA.
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- <script>
            function validateForm() {
                var recaptchaResponse = grecaptcha.getResponse();
                if (recaptchaResponse.length == 0) {
                    // Show the custom alert
                    document.getElementById("captcha-alert").style.display = "block";
                    return false;
                }
                return true;
            }
        </script> -->

</body>