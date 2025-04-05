<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['otp'];

    if(isset($_SESSION['otp']) && $_SESSION['otp'] === $otp){
        unset($_SESSION['otp']); 
        header("location: dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = 'otp';
        header("location: form_otp.php");
        exit();
    }
}
?>



<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <style>
        body{
           background-color: #29C5F6;
        }
    </style>

</head>
 
<body>
    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="card mt-5" style="width:500px">
            <div class="card-header">
                <h1 class="text-center">Email Verification</h1>
            </div>
            <div class="card-body">
                <form id="myForm" method="POST" action="">
                <div class="mt-2">

                <?php 
                    if (isset($_SESSION['error']) && $_SESSION['error'] == 'otp') { ?>
                        <h5 align="center" class="invalid" style="color: red;">Invalid OTP</h5>
                    <?php }
                     unset($_SESSION['error']);
                    ?>

                        
                    <label for="email">Enter OTP : </label>
                    <input type="number" name="otp" class="form-control" placeholder="Enter opt">
                    <br>

                        <input type="submit" name="login" value="login" class="btn btn-primary">
                </div>
</div>

            </div>
            </form>
        </div>
    </div>

</body>