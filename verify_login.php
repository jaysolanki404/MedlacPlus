<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $table = $_POST['role'];

    function loginUser($conn, $table, $email, $password)
    {

        $query = "SELECT * FROM $table WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();

        if ($row && password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $table;
            $_SESSION[$table . '_id'] = $row['id'];
            // header("location: auth.php");
            header("location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = 'unvalid';
            header('location:form_login.php');
        }
    }

    switch ($role) {
        case 'admin':
            loginUser($conn, 'admin', $email, $password);
            break;
        case 'doctor':
            $_SESSION['doctor'] = 'true';
            loginUser($conn, 'doctor', $email, $password);
            break;
        case 'patient':
            loginUser($conn, 'patient', $email, $password);
            break;
        case 'chemist':
            loginUser($conn, 'chemist', $email, $password);
            break;
        case 'receptionist':
            loginUser($conn, 'receptionist', $email, $password);
            break;
        default:
            $_SESSION['error'] = 'unvalid';
            header("location: form_login.php"); // Adjust this URL as needed
            exit();
    }
}
?>