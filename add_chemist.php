<?php

require_once 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $license_number = $_POST['license_number'];
    $aadhar = $_POST['aadhar'];
    $email = $_POST['email'];


    $default_password = $first_name . $license_number;
    $hashed_password = password_hash($default_password, PASSWORD_BCRYPT);


    $check_aadhar_sql = "SELECT COUNT(*) as count FROM aadhar WHERE aadhar_number = :aadhar";
    $check_aadhar_stmt = $conn->prepare($check_aadhar_sql);
    $check_aadhar_stmt->bindParam(':aadhar', $_POST["aadhar"]);
    $check_aadhar_stmt->execute();
    $result = $check_aadhar_stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] == 0) {
        $_SESSION['error'] = 'aadhar';
        header("Location: form_chemist.php");
        exit();
    }

    $check_license_sql = "SELECT COUNT(*) as count FROM license WHERE number = :license";
    $check_license_stmt = $conn->prepare($check_license_sql);
    $check_license_stmt->bindParam(':license', $_POST["license_number"]);
    $check_license_stmt->execute();
    $result_license = $check_license_stmt->fetch(PDO::FETCH_ASSOC);

    if ($result_license['count'] == 0) {
        $_SESSION['error'] = 'license';
        header("Location: form_chemist.php?error=license");
        exit();
    }

    $check_email_sql = "SELECT COUNT(*) as count FROM chemist WHERE email = :email";
    $check_email_stmt = $conn->prepare($check_email_sql);
    $check_email_stmt->bindParam(':email', $email);
    $check_email_stmt->execute();
    $result_email = $check_email_stmt->fetch(PDO::FETCH_ASSOC);

    if ($result_email['count'] > 0) {


        $_SESSION['error'] = 'email';
        header("Location: form_chemist.php");
        exit();
    }


    $profile = $_FILES["profile"]["tmp_name"];
    $profileType = $_FILES["profile"]["type"];

    if (substr($profileType, 0, 5) === "image") {
        $profileData = file_get_contents($profile);
    } else {
        echo "Invalid file type. Please upload an image.";
    }


    $signature = $_FILES["signature"]["tmp_name"];
    $signatureType = $_FILES["signature"]["type"];

    if (substr($signatureType, 0, 5) === "image") {
        $signatureData = file_get_contents($signature);
    } else {
        echo "Invalid file type. Please upload an image.";
    }


    $image = $_FILES["license_photo"]["tmp_name"];
    $imageType = $_FILES["license_photo"]["type"];

    if (substr($imageType, 0, 5) === "image") {
        $imgData = file_get_contents($image);
    } else {
        echo "Invalid file type. Please upload an image.";
    }


    $sql = "INSERT INTO chemist (profile_photo, first_name, last_name, age, phone, state, city, address, license_number, license_photo, aadhar_number, email, digital_signature, password) 
VALUES (:profile_photo, :first_name, :last_name, :age, :phone, :state, :city, :address, :license_number, :license_photo, :aadhar, :email, :signature, :hashed_password)

";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':profile_photo', $profileData);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':license_number', $license_number);
    $stmt->bindParam(':license_photo', $imgData);
    $stmt->bindParam(':aadhar', $aadhar);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':signature', $signatureData);
    $stmt->bindParam(':hashed_password', $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['add'] = 'true';
        header("Location: form_chemist.php");
        exit();
    }

}
?>