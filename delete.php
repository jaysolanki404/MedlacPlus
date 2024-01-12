<?php
require('config/config.php');
$id = $_REQUEST['id'];
$tableName = $_REQUEST['table'];  // Get the table name from the request

// Define an associative array to map table names to their respective column names
$tableColumnMap = array(
    'admin' =>'id',
    'doctor' => 'id',
    'chemist' => 'id',
    'patient' => 'id',
    'receptionist' => 'id',
    'license' => 'id',
    'brand' => 'id',
    'company' => 'id',
    // Add more table names and their respective columns here
);

if (array_key_exists($tableName, $tableColumnMap)) {
    $delete = "DELETE FROM $tableName WHERE " . $tableColumnMap[$tableName] . " = :id";
    $stmt = $conn->prepare($delete);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redirect to the appropriate view page based on the table name
    header("Location: view_" . $tableName . ".php");
    exit();
} else {
    echo "Invalid table name";
}
?>
