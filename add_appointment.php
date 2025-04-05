<?php

require_once 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    if ($_SESSION['role'] == 'patient') {
        $patient_id = $_SESSION['id'];
    } else {

        $patient_id = $_POST['patient'];
    }
    $doctor_id = $_POST['doctor'];
    $appointment_date = $_POST['date'];
    $appointment_time = $_POST['time'];
    $note = $_POST['note'];

    // Check the total number of appointments for the selected doctor at the specified date and time
    $total_appointments_query = "SELECT COUNT(*) as total_appointments FROM appointment 
                                WHERE doctor_id = :doctor_id 
                                AND date = :appointment_date 
                                AND time = :appointment_time";

    $total_appointments_stmt = $conn->prepare($total_appointments_query);
    $total_appointments_stmt->bindParam(':doctor_id', $doctor_id);
    $total_appointments_stmt->bindParam(':appointment_date', $appointment_date);
    $total_appointments_stmt->bindParam(':appointment_time', $appointment_time);
    $total_appointments_stmt->execute();

    $total_appointments_result = $total_appointments_stmt->fetch(PDO::FETCH_ASSOC);
    $total_appointments = $total_appointments_result['total_appointments'];

    // Specify the maximum number of appointments allowed (in this case, 3)
    $max_appointments_allowed = 3;

    if ($total_appointments >= $max_appointments_allowed) {
        $_SESSION['appointment'] = 'false';
        if ($_SESSION['role'] == 'patient') {
            header("Location: book_appointment.php");
        } else {
            header("Location: form_appointment.php");
        }
        exit();
    } else {
        // Assuming you have a table named "appointments" with the appropriate columns
        $insert_query = "INSERT INTO appointment (patient_id, doctor_id, date, time, note) 
                        VALUES (:patient_id, :doctor_id, :appointment_date, :appointment_time, :note)";

        $insert_stmt = $conn->prepare($insert_query);

        $insert_stmt->bindParam(':patient_id', $patient_id);
        $insert_stmt->bindParam(':doctor_id', $doctor_id);
        $insert_stmt->bindParam(':appointment_date', $appointment_date);
        $insert_stmt->bindParam(':appointment_time', $appointment_time);
        $insert_stmt->bindParam(':note', $note);

        if ($insert_stmt->execute()) {
            $_SESSION['add'] = 'true';
            if ($_SESSION['role'] == 'patient') {
                header("Location: book_appointment.php");
            } else {
                header("Location: form_appointment.php");
            }
            exit();
        } else {
            echo "Error: " . $insert_stmt->errorInfo()[2];
        }
    }
}
?>