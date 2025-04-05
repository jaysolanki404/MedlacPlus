<?php
require_once 'toaster.php';
require_once 'config/config.php';
$id = $_SESSION['id'];
$query = "SELECT * FROM receptionist WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch();


$_SESSION['virtual_auth'] = $row;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $row['password'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (password_verify($current_password, $password)) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            $update = "UPDATE receptionist SET password = :password WHERE id = :id ";
            $query = $conn->prepare($update);
            $query->bindParam(':id', $id);
            $query->bindParam(':password', $hashed_password);

            if ($query->execute()) {
                $_SESSION['password'] = 'true';
                header("location: profile_receptionist.php");
                exit();
            } else {
                $_SESSION['password'] = 'false';
                header("location: profile_receptionist.php");
                exit();
            }
        } else {
            $_SESSION['password'] = 'false';
            header("location: profile_receptionist.php");
            exit();
        }
    } else {
        $_SESSION['password'] = 'false';
        header("location: profile_receptionist.php");
        exit();
    }
}
?>


<html>

<head>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/72c602bb8f.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Bootstrap JS (including Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .form-control[readonly] {
            background-color: white;
        }


        body {
            background: rgb(99, 39, 120)
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .virtual-auth {
            background: rgb(99, 39, 120);
            box-shadow: none;
            margin-top: 10px;
            border: none
        }

        .virtual-auth:hover {
            background: #682773
        }

        .virtual-auth:focus {
            background: #682773;
            box-shadow: none
        }

        .virtual-auth:active {
            background: #682773;
            box-shadow: none
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
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Profile Photo" height=150px width=150px/>';
                    ?>
                    <span class="font-weight-bold">
                        <?php echo $row['first_name']; ?>
                    </span><span> </span>

                    <br>
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket fa-2xl"></i></a>

                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">First Name</label><input type="text"
                                class="form-control" value="<?php echo $row['first_name']; ?>" readonly></div>
                        <div class="col-md-6"><label class="labels">Last Name</label><input type="text"
                                class="form-control" value="<?php echo $row['last_name']; ?>" readonly></div>
                    </div>
                    <div class="col-md-12"><label class="labels">Gender</label><input type="text" class="form-control"
                            value="<?php echo $row['gender']; ?>" readonly></div>
                    <div class="col-md-12"><label class="labels">Age</label><input type="text" class="form-control"
                            value="<?php echo $row['age']; ?>" readonly></div>
                    <div class="col-md-12"><label class="labels">Phone</label><input type="text" class="form-control"
                            value="<?php echo $row['phone']; ?>" readonly></div>

                    <div class="col-md-12"><label class="labels">State</label><input type="text" class="form-control"
                            value="<?php echo $row['state']; ?>" readonly></div>

                    <div class="col-md-12"><label class="labels">City</label><input type="text" class="form-control"
                            value="<?php echo $row['city']; ?>" readonly></div>

                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control"
                            value="<?php echo $row['address']; ?>" readonly></div>
                    <div class="col-md-12"><label class="labels">Aadhar Number</label><input type="text"
                            class="form-control" value="<?php echo $row['aadhar_number']; ?>" readonly></div>
                    <div class="col-md-12"><label class="labels">12 pass</label><input type="text" class="form-control"
                            value="<?php echo $row['12_pass']; ?>" readonly></div>


                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control"
                            value="<?php echo $row['email']; ?>" readonly></div>

                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save
                            Profile</button></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <form action="" method="post">
                        <div class="d-flex justify-content-between align-items-center experience"><span>Change
                                Password</span><span onclick="history.back()" class="border px-3 p-1 back"><i
                                    class="fa fa-plus"></i></span></div><br>
                        <div class="col-md-12"><label class="labels">Current Password</label><input type="text"
                                class="form-control" name="current_password"></div> <br>
                        <div class="col-md-12"><label class="labels">New Password</label><input type="text"
                                class="form-control" name="new_password"></div><br>
                        <div class="col-md-12"><label class="labels">Confirm Password</label><input type="text"
                                class="form-control" name="confirm_password"></div><br>

                        <button class="btn btn-primary profile-button" type="submit">Change Password</button>
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