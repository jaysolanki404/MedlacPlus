<?php
require_once 'config/config.php';

// Retrieve data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Extract patient ID and image data
$patient_id = $data['patient_id'];
$image_data = $data['image_data'];

// Update the patient table with the image data
$query = "UPDATE patient SET health_card_image = :health_card_image WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':health_card_image', $image_data);
$stmt->bindParam(':id', $patient_id);

if ($stmt->execute()) {
    http_response_code(200);
} else {
    http_response_code(500);
}
?>