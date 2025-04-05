<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "medlacplus";

    $conn = new mysqli($servername,$username,$password,$dbname);

    if($conn->connect_error){
        die ('connection faild:'.$conn->connect_error);
    }
?>