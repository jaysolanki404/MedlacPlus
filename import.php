<?php


$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'medlacplus';

$connection = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$filePath = 'C:\wamp64\www\medlac_medlac\medicine.txt';

$file = fopen($filePath, 'r');

while (($data = fgetcsv($file)) !== false) {
   
    $name = mysqli_real_escape_string($connection, $data[0]);
    
    $query = "INSERT INTO medicine (name) VALUES ('$name')";

    if (mysqli_query($connection, $query)) {
        echo "Data inserted successfully: $name<br>";
    } else {
        echo "Error inserting data: " . mysqli_error($connection) . "<br>";
    }
}

fclose($file);

mysqli_close($connection);
?> 
