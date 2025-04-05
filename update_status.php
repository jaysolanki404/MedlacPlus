<?php

require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['appointment_id']) && isset($_POST['new_status'])) {
        $appointmentId = $_POST['appointment_id'];
        $newStatus = $_POST['new_status'];

        // Validate new status to prevent SQL injection
        if (!in_array($newStatus, ['accept', 'reject'])) {
            // Invalid status
            echo json_encode(['success' => false, 'message' => 'Invalid status']);
            exit;
        }

        // Update the appointment status in the database
        $updateSql = "UPDATE appointment SET status = :new_status WHERE id = :appointment_id";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':new_status', $newStatus);
        $updateStmt->bindParam(':appointment_id', $appointmentId);

        try {
            $updateStmt->execute();
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error updating status']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request parameters']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

?>