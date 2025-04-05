<?php

require_once 'config/config.php';

// Assuming you have a session variable storing the patient's ID after login
$patient_id = $_SESSION['patient_id'];

$sql = "SELECT a.id, p.first_name as patient_name, a.date, a.time, a.note, a.status, a.patient_id
        FROM appointment a
        JOIN patient p ON a.patient_id = p.id
        WHERE a.patient_id = :patient_id
        ORDER BY a.id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':patient_id', $patient_id);
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>
    <?php require_once 'table_links.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/display.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-content {
            padding: 21px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    <div class="sidebar">
        <div class="sidebar">
            <?php require_once 'sidepenal.php'; ?>
        </div>
    </div>
    <main class="main-content">
        <?php require_once 'header.php'; ?>

        <div class="button-group">
            <button class="btn btn-primary" style="display:inline; margin-right: 10px;">
                <i class="fa-solid fa-plus fa-xl"></i>
                <a href="book_appointment.php" style="color:white">Add Appointment</a>
            </button>

            </form>
        </div>
        <br>
        <!---main table--->
        <table id="example" class="ui celled table" class="yo">
            <thead>
                <tr>
                    <th>Id</th>

                    <th>Date</th>
                    <th>Time</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $row): ?>
                <tr>
                    <td>
                        <?= $row["id"]; ?>
                    </td>

                    <td>
                        <?= $row["date"]; ?>
                    </td>
                    <td>
                        <?= $row["time"]; ?>
                    </td>
                    <td>
                        <?= $row["note"]; ?>
                    </td>
                    <td>
                        <?php if ($row["status"] == 'pending'): ?>
                        <i class="fa-solid fa-clock" style="color: #fbbc05;"></i> Pending
                        <?php elseif ($row["status"] == 'accept'): ?>
                        <i class="fa-solid fa-check-circle" style="color: #34a853;"></i> Accepted
                        <?php elseif ($row["status"] == 'reject'): ?>
                        <i class="fa-solid fa-times-circle" style="color: #ea4335;"></i> Rejected
                        <?php else: ?>
                        Status:
                        <?= $row["status"]; ?>
                        <?php endif; ?>

                    </td>
                    <td>
                        <a href="download_appointment.php?id=<?= $row['id']; ?>" target="_blank">
                            <i class="fa-solid fa-download" style="color: #007bff; cursor: pointer;"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>



    <script>
        new DataTable('#example');
    </script>
    <script src="assets/js/delete.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>