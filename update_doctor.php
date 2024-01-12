<?php
require_once 'config/config.php';

$id = $_REQUEST['id'];
$query = "SELECT * FROM doctor WHERE id=:id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['new']) && $_POST['new'] == 1) {
    $id = $_REQUEST['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $gender = $_REQUEST['gender'];
    $dob = $_REQUEST['dob'];
    $phone = $_REQUEST['phone'];
    $state = $_REQUEST['state'];
    $city = $_REQUEST['city'];
    $address = $_REQUEST['address'];
    $hospital = $_REQUEST['hospital'];
    $specialist = $_REQUEST['specialist'];
    $license_number = $_REQUEST['license_number'];
    $aadhar_number = $_REQUEST['aadhar_number'];
    $email = $_REQUEST['email'];

    // Profile Photo
    $profile = $_FILES["profile"]["tmp_name"];
    $profileType = $_FILES["profile"]["type"];

    if (substr($profileType, 0, 5) === "image") {
        $profileData = file_get_contents($profile);
    } else {
        echo "Invalid file type. Please upload an image.";
        exit; // Stop execution if file type is invalid
    }

    $update = "UPDATE doctor SET  profile_photo = :profile_photo,  first_name = :first_name, last_name = :last_name, gender = :gender, dob = :dob, phone = :phone, state = :state, city = :city, address = :address, hospital = :hospital, specialist = :specialist, license_number = :license_number, aadhar_number = :aadhar_number, email = :email WHERE id = :id ";

    $query = $conn->prepare($update);
    $query->bindParam(':id', $id);
    $query->bindParam(':profile_photo', $profileData, PDO::PARAM_LOB); // Bind profile photo as a BLOB
    $query->bindParam(':first_name', $first_name);
    $query->bindParam(':last_name', $last_name);
    $query->bindParam(':gender', $gender);
    $query->bindParam(':dob', $dob);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':state', $state);
    $query->bindParam(':city', $city);
    $query->bindParam(':address', $address);
    $query->bindParam(':hospital', $hospital);
    $query->bindParam(':specialist', $specialist);
    $query->bindParam(':license_number', $license_number);
    $query->bindParam(':aadhar_number', $aadhar_number);
    $query->bindParam(':email', $email);

    $result = $query->execute();
    if ($result) {
        $_SESSION['update'] = 'true';
        echo '<script>window.location.href = "view_doctor_profile.php?id=' . $id . '";</script>';
    } else {
        echo "Error updating record: ";
    }
}
?>

<?php require_once 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/display.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
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
                                <div class="card-header">Update Doctor</div>
                                <div class="card-body">
                                    <form action="#" method="POST" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="new" value="1" />



                                        <!-- Profile Photo -->
                                        <div class="form-group row">
                                            <label for="profile" class="col-md-4 col-form-label text-md-right">Profile
                                                Photo</label>
                                            <div class="col-md-6">
                                                <?php
                                                $imageData_profile = $row['profile_photo'];
                                                $base64_profile = 'data:image/jpeg;base64,' . base64_encode($imageData_profile);
                                                echo '<img src="' . $base64_profile . '" alt="Profile Photo" width="100" height="100" />';
                                                ?>

                                            </div>
                                        </div>


                                        <!-- Profile Photo -->
                                        <div class="form-group row">
                                            <label for="profile" class="col-md-4 col-form-label text-md-right">Change
                                                Profile
                                                Photo</label>
                                            <div class="col-md-6">
                                                <input type="file" id="profile" class="form-control" name="profile"
                                                    accept="image/*">
                                            </div>
                                        </div>


                                        <!-- First Name -->
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="first_name" class="form-control"
                                                    name="first_name" value="<?php echo $row['first_name']; ?>"
                                                    style="background-color:white ;" readonly>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="form-group row">
                                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="last_name" class="form-control" name="last_name"
                                                    value="<?php echo $row['last_name']; ?>"
                                                    style="background-color:white ;" readonly>
                                            </div>
                                        </div>

                                        <!-- Gender -->
                                        <div class="form-group row">
                                            <label for="gender"
                                                class="col-md-4 col-form-label text-md-right">Gender</label>
                                            <div class="col-md-6">
                                                <select id="gender" class="form-control" name="gender" required>
                                                    <option value="male" <?php echo $row['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                                                    <option value="female" <?php echo $row['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                                                    <option value="other" <?php echo $row['gender'] == 'other' ? 'selected' : ''; ?>>Other</option>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- Date of Birth -->
                                        <div class="form-group row">
                                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date of
                                                Birth</label>
                                            <div class="col-md-6">
                                                <input type="date" id="dob" class="form-control" name="dob"
                                                    value="<?php echo $row['dob']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="form-group row">
                                            <label for="phone"
                                                class="col-md-4 col-form-label text-md-right">Phone</label>
                                            <div class="col-md-6">
                                                <input type="tel" id="phone" class="form-control" name="phone"
                                                    value="<?php echo $row['phone']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- state -->
                                        <div class="form-group row">
                                            <label for="state"
                                                class="col-md-4 col-form-label text-md-right">State</label>
                                            <div class="col-md-6">
                                                <input type="text" id="state" class="form-control" name="state"
                                                    value="<?php echo $row['state']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- city -->
                                        <div class="form-group row">
                                            <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                                            <div class="col-md-6">
                                                <input type="text" id="city" class="form-control" name="city"
                                                    value="<?php echo $row['city']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="form-group row">
                                            <label for="address"
                                                class="col-md-4 col-form-label text-md-right">Address</label>
                                            <div class="col-md-6">
                                                <input type="text" id="address" class="form-control" name="address"
                                                    value="<?php echo $row['address']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Hospital -->
                                        <div class="form-group row">
                                            <label for="hospital"
                                                class="col-md-4 col-form-label text-md-right">Hospital</label>
                                            <div class="col-md-6">
                                                <input type="text" id="hospital" class="form-control" name="hospital"
                                                    value="<?php echo $row['hospital']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Specialist -->
                                        <div class="form-group row">
                                            <label for="specialist"
                                                class="col-md-4 col-form-label text-md-right">Specialist</label>
                                            <div class="col-md-6">
                                                <input type="text" id="specialist" class="form-control"
                                                    name="specialist" value="<?php echo $row['specialist']; ?>"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- License Number -->
                                        <div class="form-group row">
                                            <label for="license_number"
                                                class="col-md-4 col-form-label text-md-right">License Number</label>
                                            <div class="col-md-6">
                                                <input type="text" id="license_number" class="form-control"
                                                    name="license_number" value="<?php echo $row['license_number']; ?>"
                                                    style="background-color:white ;" readonly>
                                            </div>
                                        </div>

                                        <!-- License Photo -->
                                        <!-- <div class="form-group row">
                                <label for="license_photo" class="col-md-4 col-form-label text-md-right">License Photo</label>
                                <div class="col-md-6">
                                    <input type="file" id="license_photo" class="form-control" name="license_photo" accept="image/*" required>
                                </div>
                            </div> -->

                                        <!-- Aadhar -->
                                        <div class="form-group row">
                                            <label for="aadhar"
                                                class="col-md-4 col-form-label text-md-right">Aadhar</label>
                                            <div class="col-md-6">
                                                <input type="text" id="aadhar" class="form-control" name="aadhar_number"
                                                    value="<?php echo $row['aadhar_number']; ?>"
                                                    style="background-color:white ;" readonly>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group row">
                                            <label for="email_address"
                                                class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                            <div class="col-md-6">
                                                <input type="email" id="email_address" class="form-control" name="email"
                                                    value="<?php echo $row['email']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>







                    </div>
                </div>
            </div>
            <!-- </div> -->





        </div>


    </main>

    <?php require_once 'js_links.php'; ?>
</body>

</html>