<?php

require_once 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $number = $_POST['license'];

 

    $sql = "INSERT INTO license (first_name, last_name, number) 
    VALUES (:first_name, :last_name, :license)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':license', $number);


    if ($stmt->execute()) {
        header("Location: form_license.php");
        exit();
    }



} else {
    header("Location: home.php");
    exit();
}
