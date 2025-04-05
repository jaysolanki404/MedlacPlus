<?php

require_once 'config/config.php';
require_once 'vendor/autoload.php'; // Load the Composer autoloader

use Picqer\Barcode\BarcodeGeneratorPNG;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['dob'];
    $blood_group = $_POST['blood_group'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $aadhar = $_POST['aadhar'];
    $email = $_POST['email'];

    $default_password = $first_name . date("Y", strtotime($date_of_birth));
    $hashed_password = password_hash($default_password, PASSWORD_BCRYPT);

    $profile = $_FILES["profile"]["tmp_name"];
    $profileType = $_FILES["profile"]["type"];

    if (substr($profileType, 0, 5) === "image") {
        $profileData = file_get_contents($profile);
    } else {
        echo "Invalid file type. Please upload an image.";
        exit();
    }



    // $check_aadhar_sql = "SELECT COUNT(*) as count FROM aadhar WHERE aadhar_number = :aadhar";
    // $check_aadhar_stmt = $conn->prepare($check_aadhar_sql);
    // $check_aadhar_stmt->bindParam(':aadhar', $aadhar);
    // $check_aadhar_stmt->execute();
    // $result_aadhar = $check_aadhar_stmt->fetch(PDO::FETCH_ASSOC);

    // if ($result_aadhar['count'] == 0) {
    //     $_SESSION['error'] = 'aadhar';
    //     header("Location: form_doctor.php");
    //     exit();
    // }


    $check_email_sql = "SELECT COUNT(*) as count FROM patient WHERE email = :email";
    $check_email_stmt = $conn->prepare($check_email_sql);
    $check_email_stmt->bindParam(':email', $email);
    $check_email_stmt->execute();
    $result_email = $check_email_stmt->fetch(PDO::FETCH_ASSOC);

    if ($result_email['count'] > 0) {
        $_SESSION['error'] = 'email';
        header("Location: form_patient.php");
        exit();
    }

    $sql = "INSERT INTO patient (profile_photo, first_name, last_name, gender, dob, blood_group, phone, aadhar, state, city, address, email, password) 
            VALUES (:profile_photo, :first_name, :last_name, :gender, :dob, :blood_group, :phone, :aadhar, :state, :city, :address, :email, :password)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':profile_photo', $profileData);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':dob', $date_of_birth);
    $stmt->bindParam(':blood_group', $blood_group);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':aadhar', $aadhar);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
        // Generate barcode
        $barcodeNumber = $conn->lastInsertId(); // Assuming patient ID is the last inserted ID

        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcodeData = $generator->getBarcode($barcodeNumber, $generator::TYPE_CODE_128);

        // Save barcode image data to the database
        $updateBarcodeImageSql = "UPDATE patient SET barcode_image = :barcode_image WHERE id = :patient_id";
        $updateBarcodeImageStmt = $conn->prepare($updateBarcodeImageSql);
        $updateBarcodeImageStmt->bindParam(':barcode_image', $barcodeData, PDO::PARAM_LOB);
        $updateBarcodeImageStmt->bindParam(':patient_id', $barcodeNumber);
        $updateBarcodeImageStmt->execute();

        // Save barcode image to a file in the specified location
        $filePath = 'assets/img/barcode/' . $barcodeNumber . '.png';
        file_put_contents($filePath, $barcodeData);

        // Set headers to force download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        readfile($filePath);

        // Now redirect to the form
        $_SESSION['add'] = 'true'; // Set the add session variable only on successful insert
        header("Location: form_patient.php");
        exit();
    }


} else {
    header("Location: home.php");
    exit();
}
?>