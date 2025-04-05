<?php

require_once 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $aadhar = $_POST['aadhar'];

 

    $sql = "INSERT INTO aadhar (first_name, last_name, aadhar_number) 
    VALUES (:first_name, :last_name, :aadhar)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':aadhar', $aadhar);


    if ($stmt->execute()) {
        header("Location: form_aadhar.php");
        exit();
    }



} else {
    header("Location: home.php");
    exit();
}
