<?php
$db_host = 'localhost';
$db_name = 'medlacplus';
$db_user = 'root';
$db_pass = '';

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection or query errors here
    // You can redirect back to the form page with an error message
    // For simplicity, we'll just display an error message here
    die("Error: " . $e->getMessage());
}



SESSION_START();