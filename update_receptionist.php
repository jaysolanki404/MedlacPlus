<?php
require_once 'config/config.php';

$id = $_REQUEST['id'];
$query = "SELECT * FROM receptionist WHERE id=:id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);




if (isset($_POST['new']) && $_POST['new'] == 1) {
    $id = $_REQUEST['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $gender = $_REQUEST['gender'];
    $age = $_REQUEST['age'];
    $phone = $_REQUEST['phone'];
    $state = $_REQUEST['state'];
    $city = $_REQUEST['city'];
    $address = $_REQUEST['address'];
    $aadhar = $_REQUEST['aadhar_number'];
    $pass = $_REQUEST['12_pass'];
    $email = $_REQUEST['email'];

    $update = "UPDATE receptionist SET first_name = :first_name, last_name = :last_name, gender = :gender, age = :age, phone = :phone, state = :state, city = :city,  address = :address, aadhar_number = :aadhar, 12_pass = :pass, email = :email  WHERE id = :id ";

    $query = $conn->prepare($update);
    $query->bindParam(':id', $id);
    $query->bindParam(':first_name', $first_name);
    $query->bindParam(':last_name', $last_name);
    $query->bindParam(':gender', $gender);
    $query->bindParam(':age', $age);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':state', $state);
    $query->bindParam(':city', $city);
    $query->bindParam(':address', $address);
    $query->bindParam(':aadhar', $aadhar);
    $query->bindParam(':pass', $pass);
    $query->bindParam(':email', $email);
    $result = $query->execute();
    if ($result) {
        $_SESSION['update'] = 'true';
        // echo '<script>window.location.href = "profile_receptionist.php";</script>';
        echo '<script>window.location.href = "profile_receptionist.php?id=' . $id . '";</script>';

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
                                <div class="card-header">Update receptionist</div>
                                <div class="card-body">
                                    <form action="#" method="POST" action="">
                                        <input type="hidden" name="new" value="1" />
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

                                        <!-- Age -->
                                        <div class="form-group row">
                                            <label for="age" class="col-md-4 col-form-label text-md-right">Date of
                                                Birth</label>
                                            <div class="col-md-6">
                                                <input type="number" id="age" class="form-control" name="age"
                                                    value="<?php echo $row['age']; ?>" required>
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

                                        <!-- Pass -->
                                        <div class="form-group row">
                                            <label for="12_pass"
                                                class="col-md-4 col-form-label text-md-right">pass</label>
                                            <div class="col-md-6">
                                                <input type="number" id="pass" class="form-control" name="12_pass"
                                                    value="<?php echo $row['12_pass']; ?>"
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
        </div>
    </main>

    <?php require_once 'js_links.php'; ?>
</body>

</html>