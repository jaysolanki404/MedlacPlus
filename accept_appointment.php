<?php
require_once 'config/config.php';

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Update the status to 'accept' in the database
    $updateSql = "UPDATE appointment SET status = 'accept' WHERE id = :id";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bindParam(':id', $appointmentId);

    if ($updateStmt->execute()) {
        // Appointment accepted successfully
        header('Location: view_my_appointments.php');
        exit();
    } else {
        // Handle the error
        echo "Error updating appointment status.";
    }
} else {
    // Handle the case where the appointment ID is not provided
    echo "Invalid appointment ID.";
}
?>