<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>


<?php
require_once 'config/config.php';


if (isset($_SESSION['add']) && $_SESSION['add'] == 'true') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.success('Successfully Registered', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['add']);
}


if (isset($_SESSION['error']) && $_SESSION['error'] == 'email') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.error('This User Already Exist', '', {
                positionClass: 'toast-top-right'
            }
                                                                                });
    </script>
    <?php
    unset($_SESSION['error']);
}


if (isset($_SESSION['error']) && $_SESSION['error'] == 'aadhar') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.error('Aadhaar Number Not Matched', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['error']);
}

if (isset($_SESSION['error']) && $_SESSION['error'] == 'license') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.error('License Number Not Matched', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['error']);
}

if (isset($_SESSION['error']) && $_SESSION['error'] == 'pass') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.error('Receptionist Has Not Passed 12!', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['error']);
}




if (isset($_SESSION['update']) && $_SESSION['update'] == 'true') { ?>
    <script>
        window.addEventListener('load', function () {
            toastr.success('Successfully Updated', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['update']);
}




if (isset($_SESSION['password']) && $_SESSION['password'] == 'false') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.error('Wrong Password', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['password']);
}





if (isset($_SESSION['password']) && $_SESSION['password'] == 'true') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.success('Password Updated Successfully', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['password']);
}









if (isset($_SESSION['appointment']) && $_SESSION['appointment'] == 'false') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.error('Slot Not Availble try Booking Other Slot', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['appointment']);
}



if (isset($_SESSION['appointment_status']) && $_SESSION['appointment_status'] == 'accept') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.sucess('Acceoted', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['appointment_status']);
}



if (isset($_SESSION['appointment_status']) && $_SESSION['appointment_status'] == 'reject') {
    ?>
    <script>
        window.addEventListener('load', function () {
            toastr.error('Rejected', '', {
                positionClass: 'toast-top-right'
            });
        });
    </script>
    <?php
    unset($_SESSION['appointment_status']);
}
