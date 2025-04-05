<?php require_once 'config/config.php';
$tableName = 'patient'; ?>



<?php

require_once 'config/config.php';

if (isset($_POST['export_patient'])) {

    // Set PHP headers for CSV output.
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=patients.csv');

    $header_args = array(
        'ID',
        'First Name',
        'Last Name',
        'Gender',
        'Blood Group',
        'Birth Of Date',
        'Phone No.',
        'State',
        'City',
        'Address',
        'Aashar Card No.',
        'Email'
    );

    $result_patient = "SELECT * FROM patient;";
    $stmt = $conn->query($result_patient);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = fopen('php://output', 'w');

    fputcsv($output, $header_args);

    foreach ($data as $data_item) {
        // You can reorder the fields as needed here to match your CSV structure.
        fputcsv($output, [
            $data_item['id'],
            $data_item['first_name'],
            $data_item['last_name'],
            $data_item['gender'],
            $data_item['blood_group'],
            $data_item['dob'],
            $data_item['phone'],
            $data_item['state'],
            $data_item['city'],
            $data_item['address'],
            $data_item['aadhar'],
            $data_item['email']
        ]);
    }

    fclose($output);
    exit;
}
?>







<!DOCTYPE html>
<html lang="en">

<head>


    <?php require_once 'css_links.php'; ?>
    <?php require_once 'table_links.php'; ?>


    <link rel="stylesheet" href="assets/css/display.css">
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

<body>


    <div class="sidebar">
        <?php require_once 'sidepenal.php'; ?>
    </div>

    <main class="main-content">
        <?php require_once 'header.php'; ?>

        <button onclick="history.back()" style="background-color:#216ABE; padding:5px 15px 5px 15px"
            class="btn btn-dark"><i class=" fa-solid fa-arrow-left"></i></button>

        <div class="button-group">

            <?php if ($_SESSION['role'] == 'doctor') { ?>
                <button style="background-color:#216ABE;" class="btn btn-primary"
                    style="display:inline; margin-right: 10px;"><i class="fa-solid fa-plus fa-xl"></i> <a
                        href="search_prescription.php" style="color:white">view
                        prescription</a></button>
            <?php } else { ?>
                <button style="background-color:#216ABE;" class="btn btn-primary"
                    style="display:inline; margin-right: 10px;"><i class="fa-solid fa-plus fa-xl"></i> <a
                        href="form_patient.php" style="color:white">Add
                        patient</a></button>
                <!---export--->
            <form method="POST" style="display:inline">
                <button style="background-color:#216ABE;" type="submit" name="export_patient" class="btn btn-primary"><i
                        class="fa-solid fa-file-export fa-xl"></i>Export patient Details</button>
            </form>
            <?php } ?>
        </div>
        <br>
        <!---main table--->
        <table id="example" class="ui celled table" class="yo">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Profile Photo</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Blood Group</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM patient ORDER BY id;";
                $stmt = $conn->prepare($query);
                $stmt->execute();



                while ($row = $stmt->fetch()) { ?>
                <tr>
                    <td>
                        <?php echo $row["id"]; ?>
                    </td>
                    <td>
                        <?php
                        $imageData_profile = $row['profile_photo'];
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData_profile) . '" alt="Profile Photo"  width="85" height="75" />';
                        ?>
                    </td>
                    <td>
                        <?php echo $row["first_name"]; ?>
                    </td>
                    <td>
                        <?php echo $row["last_name"]; ?>
                    </td>
                    <td>
                        <?php echo $row["gender"]; ?>
                    </td>
                    <td>
                        <?php echo $row["blood_group"]; ?>
                    </td>

                    <td>
                        <a href="view_patient_profile.php?id=<?php echo $row['id']; ?>"><i
                                class='material-icons'>visibility</i></a>
                        <a href="update_patient.php?id=<?php echo $row["id"]; ?>"><i class='material-icons'
                                color="black">edit</i></a>
                        <a href="#"
                            onclick="confirmDelete(<?php echo $row['id']; ?>, '<?php echo $tableName; ?>', 'delete.php')"><i
                                class='material-icons'>delete</i></a>


                    </td>
                </tr>
                <?php } ?>
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