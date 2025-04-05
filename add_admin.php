<?php

    require_once 'config/config.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
    $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $profile = $_FILES["profile"]["tmp_name"];
    $profileType = $_FILES["profile"]["type"];

    if (substr($profileType, 0, 5) === "image") {
        $profileData = file_get_contents($profile);
    } else {
        echo "Invalid file type. Please upload an image.";
    }
        

    $sql = "INSERT INTO admin (profile_photo, first_name, last_name, phone, address, email, password) 
            VALUES (:profile_photo, :first_name, :last_name, :phone, :address, :email, :hashed_password)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':profile_photo', $profileData);
    $stmt->bindParam(':first_name', $_POST["first_name"]);
    $stmt->bindParam(':last_name', $_POST["last_name"]);
    $stmt->bindParam(':phone', $_POST["phone"]);
    $stmt->bindParam(':address', $_POST["address"]);
    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->bindParam(':hashed_password', $hashed_password);
   
    if ($stmt->execute()) {
    $_SESSION['add'] = 'true'; 
    header("Location: form_admin.php");
    exit();
    }

}
?>