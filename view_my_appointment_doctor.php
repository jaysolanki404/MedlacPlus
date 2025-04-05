<?php require_once 'config/config.php';
$tableName = 'appointment'; ?>



<?php

require_once 'config/config.php';

if (isset($_POST['export_appointment'])) {

    // Set PHP headers for CSV output.
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=appointments.csv');

    $header_args = array(
        'ID',
        'Date',
        'Time',
        'Note',
        'Status',
    );

    $result_appointment = "SELECT * FROM appointment;";
    $stmt = $conn->query($result_appointment);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = fopen('php://output', 'w');

    fputcsv($output, $header_args);

    foreach ($data as $data_item) {
        // You can reorder the fields as needed here to match your CSV structure.
        fputcsv($output, [
            $data_item['id'],
            $data_item['date'],
            $data_item['time'],
            $data_item['note'],
            $data_item['status']
        ]);
    }

    fclose($output);
    exit;
}
?>



<?php

require_once 'config/config.php';

// Assuming you have a session variable storing the doctor's ID after login
$doctor_id = $_SESSION['doctor_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_status'])) {
        $appointmentId = $_POST['appointment_id'];
        $currentStatus = $_POST['current_status'];

        // Toggle the status from accept to reject or vice versa
        $newStatus = ($currentStatus == 'accept') ? 'reject' : 'accept';

        // Update the appointment status in the database
        $updateSql = "UPDATE appointment SET status = :new_status WHERE id = :appointment_id";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':new_status', $newStatus);
        $updateStmt->bindParam(':appointment_id', $appointmentId);
        $updateStmt->execute();
    }
}

$sql = "SELECT a.id, p.first_name as patient_name, a.date, a.time, a.note, a.status, a.patient_id
        FROM appointment a
        JOIN patient p ON a.patient_id = p.id
        WHERE a.doctor_id = :doctor_id
        ORDER BY a.id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':doctor_id', $doctor_id);
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



    <!-- Add this to the head section of your HTML -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <link href="https://cdn.jsdelivr.net/css-toggle-switch/latest/toggle-switch.css" rel="stylesheet" />
    <style>
        .main-content {
            padding: 21px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }


        .switch-candy label {
            background-color: #4f3f60;
            color: black;
            font-weight: bold;
        }


        .switch-candy input[type="radio"]:checked+label[for^="on_"] {
            background-color: #affc41;
            /* Change this to the desired color for "Accept" */
        }

        .switch-candy input[type="radio"]:checked+label[for^="off_"] {
            background-color: red
                /* Change this to the desired color for "Reject" */
        }

        .switch-candy input[type="radio"]:checked+label[for^="na_"] {
            background-color: #fcf300;
            /* Change this to the desired color for "Pending" */
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    <div class="sidebar">
        <?php require_once 'sidepenal.php'; ?>
    </div>
    <main class="main-content">
        <?php require_once 'header.php'; ?>
        <button onclick="history.back()" style="background-color:#216ABE; padding:5px 15px 5px 15px"
            class="btn btn-dark"><i class=" fa-solid fa-arrow-left"></i></button>
        <div class="button-group">

            <form method="POST" style="display:inline">
                <button style="background-color: #216ABE; " type="submit" name="export_appointment"
                    class="btn btn-primary">
                    <i clviewass="fa-solid fa-file-export fa-xl"></i>Export Appointment Details
                </button>
            </form>
        </div>
        <br>

        <table id="example" class="ui celled table" class="yo">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>view</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $row): ?>
                    <tr>
                        <td>
                            <?php echo $row['patient_name']; ?>
                        </td>
                        <td>
                            <?php echo $row['date']; ?>
                        </td>
                        <td>
                            <?php echo $row['time']; ?>
                        </td>
                        <td>
                            <?php echo $row['note']; ?>
                        </td>
                        <td>
                            <div class="switch-toggle switch-3 switch-candy">
                                <input id="on_<?php echo $row['id']; ?>" name="state-d_<?php echo $row['id']; ?>"
                                    type="radio" <?php echo ($row['status'] == 'accept') ? 'checked' : ''; ?>
                                    onchange="updateStatus('<?php echo $row['id']; ?>', 'accept')" />
                                <label for="on_<?php echo $row['id']; ?>" onclick="">Accept</label>

                                <input id="na_<?php echo $row['id']; ?>" name="state-d_<?php echo $row['id']; ?>"
                                    type="radio" disabled <?php echo ($row['status'] == 'pending') ? 'checked' : ''; ?> />
                                <label for="na_<?php echo $row['id']; ?>" class="disabled" onclick="">&nbsp;</label>

                                <input id="off_<?php echo $row['id']; ?>" name="state-d_<?php echo $row['id']; ?>"
                                    type="radio" <?php echo ($row['status'] == 'reject') ? 'checked' : ''; ?>
                                    onchange="updateStatus('<?php echo $row['id']; ?>', 'reject')" />
                                <label for="off_<?php echo $row['id']; ?>" onclick="">Reject</label>

                                <a></a>
                            </div>
                        </td>
                        <td>
                            <a href="view_patient_profile.php?id=<?php echo $row['patient_id']; ?>">
                                <i class="fa-solid fa-id-card">View profile</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <!-- Add this where you want the calendar to appear -->
        <div id="calendar"></div>

    </main>
    <script>
        function updateStatus(appointmentId, newStatus) {
            // Send AJAX request to update the status in the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_status.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response if needed
                    console.log(xhr.responseText);
                }
            };
            xhr.send('appointment_id=' + appointmentId + '&new_status=' + newStatus);
        }
    </script>
    <script>
        new DataTable('#example');
    </script>
    <!-- Add this script after including FullCalendar -->
    <script>
        $(document).ready(function () {
            $('#calendar').fullCalendar({
                events: [
                    <?php foreach ($appointments as $row): ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php if ($row["status"] == 'accept'): ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            {
                                title: '<?php echo $row["patient_name"]; ?>',
                                start: '<?php echo $row["date"] . ' ' . $row["time"]; ?>',
                                description: '<?php echo $row["note"]; ?>'
                            },
                        <?php endif; ?>
                    <?php endforeach; ?>
                ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                eventClick: function (event) {
                    alert('Patient Name: ' + event.title + '\nDate: ' + event.start.format('MMMM DD, YYYY') + '\nNote: ' + event.description);
                }
            });
        });
    </script>

    <script src="assets/js/delete.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>