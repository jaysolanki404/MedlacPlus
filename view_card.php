<?php
require_once 'config/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    echo $patient_id;

} else {

    $patient_id = $_SESSION['id'];
}
$query = "SELECT * FROM patient WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $patient_id);
$stmt->execute();
$row = $stmt->fetch();

// Calculate age from date of birth
$dob = new DateTime($row['dob']);
$currentDate = new DateTime();
$age = $currentDate->diff($dob)->y;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    if ($age < 14) {
        echo '<link rel="stylesheet" href="assets/css/childcard.css" />';
    } else {
        if ($row['gender'] == 'female') {
            echo '<link rel="stylesheet" href="assets/css/femalecard.css" />';
        } else {
            echo '<link rel="stylesheet" href="assets/css/malecard.css" />';
        }
    }
    ?>
    <?php require_once 'css_links.php'; ?>
    <?php require_once 'table_links.php'; ?>
    <link rel="stylesheet" href="assets/css/display.css">
    <style>
        .main-content {
            padding: 21px;
        }

        #healthCard {
            overflow: visible;
            /* Only apply when capturing canvas */
        }
    </style>
    <!-- Include html2canvas library -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <div class="sidebar">
        <div class="sidebar">
            <?php require_once 'sidepenal.php'; ?>
        </div>
    </div>
    <main class="main-content">
        <?php require_once 'header.php'; ?>
        <!-- Add a download button -->
        <button onclick="downloadCard()" style="background-color: #e91e63; padding: 5px 15px 5px 15px"
            class="btn btn-dark">
            <i class="fa-solid fa-download"></i> Download Card
        </button>
        <br>
        <!---main table--->
        <div class="debit-card center" id="healthCard">
            <div class="card-body">
                <div class="personal-info" id="personalInfo" style="color: black;">
                    <b>
                        <p style="font-size: xx-large;"><b>1234 5678 9016</b></p>
                        <div style="display: inline; opacity: 0.7;">GENERATED DATE

                            <?php echo $row['created_at']; ?>
                        </div>
                        <br>
                        <p style="display: inline;font-size: x-large; margin-bottom:px;">
                            <?php echo $row['first_name'] . $row['last_name']; ?>
                        </p>
                        <?php
                        $barcode = $row['barcode_image'];
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($barcode) . '" alt="Profile Photo" />';
                        ?>
                    </b>
                </div>
            </div>

        </div>
    </main>

    <!-- ... Your existing HTML code ... -->

    <script>
        function downloadCard() {
            // Adjust timeout as needed
            setTimeout(async () => {
                try {
                    // Ensure data is loaded and element is visible
                    await new Promise((resolve) => {
                        // Wait for data fetching or image loading (if necessary)
                        // and element visibility (using IntersectionObserver or similar)
                        // before resolving
                        resolve();
                    });

                    // Temporarily set overflow: visible
                    const healthCard = document.getElementById('healthCard');
                    const originalOverflow = healthCard.style.overflow;
                    healthCard.style.overflow = 'visible';

                    // Capture canvas
                    const canvas = await html2canvas(healthCard, {
                        // Experiment with options like scrollX, scrollY, useCORS
                    });

                    // Reset overflow
                    healthCard.style.overflow = originalOverflow;

                    // Create and download link
                    const link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = 'health_card.png';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } catch (error) {
                    console.error('Error capturing card:', error);
                }
            }, 500);
        }
    </script>


</body>

</html>