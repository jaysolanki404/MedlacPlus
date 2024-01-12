<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medlacplus";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve the images from the database
$sql = "SELECT image_data FROM images";
$result = $conn->query($sql);

// Check if there are any images in the database
if ($result->num_rows > 0) {
    // Output the images as HTML
    while ($row = $result->fetch_assoc()) {
        $imageData = $row['image_data'];
        // Display the image using the appropriate content type
        header("Content-type: image/jpeg"); // Change the content type based on your image type
        echo $imageData;
    }
} else {
    echo "No images found in the database.";
}

// Close the database connection
$conn->close();
?>
