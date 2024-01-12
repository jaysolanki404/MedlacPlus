<?php
require_once 'toaster.php';
require_once 'config/config.php';
$id = $_SESSION['id'];
$query = "SELECT * FROM patient WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $row['password'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (password_verify($current_password, $password)) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            $update = "UPDATE patient SET password = :password WHERE id = :id ";
            $query = $conn->prepare($update);
            $query->bindParam(':id', $id);
            $query->bindParam(':password', $hashed_password);

            if ($query->execute()) {
                $_SESSION['password'] = 'true';
                header("location: profile_patient.php");
                exit();
            } else {
                $_SESSION['password'] = 'false';
                header("location: profile_patient.php");
                exit();
            }
        } else {
            $_SESSION['password'] = 'false';
            header("location: profile_patient.php");
            exit();
        }
    } else {
        $_SESSION['password'] = 'false';
        header("location: profile_patient.php");
        exit();
    }
}
?>



<html>

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Bootstrap JS (including Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: rgb(99, 39, 120)
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <?php
                    // Display the image using the appropriate content type
                    $imageData = $row['profile_photo'];
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="License Photo" height=150px width=150px/>';
                    ?>
                    <span class="font-weight-bold">
                        <?php echo $row['first_name']; ?>
                    </span><span class="text-black-50">edogaru@mail.com.my</span><span> </span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">First Name</label><input type="text"
                                class="form-control" value="<?php echo $row['first_name']; ?>"></div>
                        <div class="col-md-6"><label class="labels">Last Name</label><input type="text"
                                class="form-control" value="<?php echo $row['last_name']; ?>"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">gender</label><input type="text"
                                class="form-control" value="<?php echo $row['gender']; ?>"></div>
                        <div class="col-md-12"><label class="labels">Blood Group</label><input type="text"
                                class="form-control" value="<?php echo $row['blood_group']; ?>"></div>
                        <div class="col-md-12"><label class="labels">Date Of Birth</label><input type="text"
                                class="form-control" value="<?php echo $row['dob']; ?>"></div>
                        <div class="col-md-12"><label class="labels">Phone</label><input type="text"
                                class="form-control" value="<?php echo $row['phone']; ?>"></div>
                        <div class="col-md-12"><label class="labels">Aadhar No.</label><input type="text"
                                class="form-control" value="<?php echo $row['aadhar']; ?>"></div>


                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">State</label><input type="text" class="form-control"
                                value="<?php echo $row['state']; ?>"></div>
                        <div class="col-md-6"><label class="labels">City</label><input type="text" class="form-control"
                                value="<?php echo $row['city']; ?>"></div>
                    </div>
                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control"
                            value="<?php echo $row['address']; ?>"></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control"
                            value="<?php echo $row['email']; ?>"></div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save
                            Profile</button></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <form action="" method="post">
                        <div class="d-flex justify-content-between align-items-center experience"><span>Change
                                PAssword</span><span class="border px-3 p-1 add-experience"><i
                                    class="fa fa-plus"></i></span></div><br>
                        <div class="col-md-12"><label class="labels">Current Password</label><input type="text"
                                class="form-control" name="current_password"></div> <br>
                        <div class="col-md-12"><label class="labels">New Password</label><input type="text"
                                class="form-control" name="new_password"></div><br>
                        <div class="col-md-12"><label class="labels">Confirm Password</label><input type="text"
                                class="form-control" name="confirm_password"></div><br>

                        <button class="btn btn-primary profile-button" type="button">Change Password</button>
                        <button class="btn btn-primary profile-button" type="button">Cancle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>