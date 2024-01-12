<?php
require_once 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $aadhar = $_POST['aadhar'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];



    // $default_password = $first_name . date("Y", strtotime($date_of_birth));
    $default_password = $first_name . $age;
    $hashed_password = password_hash($default_password, PASSWORD_BCRYPT);


    $profile = $_FILES["profile"]["tmp_name"];
    $profileType = $_FILES["profile"]["type"];

    if (substr($profileType, 0, 5) === "image") {
        $profileData = file_get_contents($profile);
    } else {
        echo "Invalid file type. Please upload an image.";
    }

    // $check_email_sql = "SELECT COUNT(*) as count FROM receptionist WHERE email = :email";
    // $check_email_stmt = $conn->prepare($check_email_sql);
    // $check_email_stmt->bindParam(':email', $email);
    // $check_email_stmt->execute();
    // $result_email = $check_email_stmt->fetch(PDO::FETCH_ASSOC);

    // if ($result_email['count'] > 0) {
    //     $_SESSION['error'] = 'email';
    //     header("Location: form_receptionist.php");
    //     exit();
    // }

    // $check_aadhar_sql = "SELECT COUNT(*) as count FROM aadhar WHERE aadhar_number = :aadhar";
    // $check_aadhar_stmt = $conn->prepare($check_aadhar_sql);
    // $check_aadhar_stmt->bindParam(':aadhar', $aadhar);
    // $check_aadhar_stmt->execute();
    // $result = $check_aadhar_stmt->fetch(PDO::FETCH_ASSOC);

    // if ($result['count'] == 0) {
    //     $_SESSION['error'] = 'aadhar';
    //     header("Location: form_receptionist.php");
    //     exit();
    // }

    // $check_pass_sql = "SELECT COUNT(*) as count FROM pass WHERE number = :pass";
    // $check_pass_stmt = $conn->prepare($check_pass_sql);
    // $check_pass_stmt->bindParam(':pass', $pass);
    // $check_pass_stmt->execute();
    // $result_pass = $check_pass_stmt->fetch(PDO::FETCH_ASSOC);

    // if ($result_pass['count'] == 0) {
    //     $_SESSION['error'] = 'pass';
    //     header("Location: form_receptionist.php");
    //     exit();
    // }

    $sql = "INSERT INTO receptionist (profile_photo ,first_name, last_name, gender, age, phone, state, city, aadhar_number, 12_pass, address, email, password) 
    VALUES (:profile_photo, :first_name, :last_name, :gender, :age, :phone, :state, :city, :aadhar, :pass, :address,  :email, :password)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':profile_photo', $profileData);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':aadhar', $aadhar);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['add'] = 'true';
        header("Location: form_receptionist.php");
        exit();
    }



} else {
    header("Location: home.php");
    exit();
}