<?php
require_once 'toaster.php';
require_once 'config/config.php';
$id = 0;
$query = "SELECT * FROM virtual_card WHERE card_number = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch();


$_SESSION['virtual_auth'] = $row;


?>


<?php
// Display the image using the appropriate content type
$imageData = $row['image'];
echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Profile Photo" height=150px width=150px/>';



echo $row['patient_id'];
?>