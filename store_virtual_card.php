<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get card number and patient ID from session or other source
    $cardNumber = $_SESSION['cardNumber'];
    $patientId = $_SESSION['id'];

    // Extract image data from request (assuming it's sent as 'image' in FormData)
    $image = $_FILES['image']['tmp_name'];

    $stmt = $conn->prepare("INSERT INTO virtual_card (patient_id, image) VALUES (?, ?)");
    $stmt->bind_param("ib", $patientId, file_get_contents($image));
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Image stored successfully";
    } else {
        echo "Error storing image";
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
}
?>