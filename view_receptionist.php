<?php require_once 'config/config.php';
$tableName = 'receptionist'; ?>



<?php

require_once 'config/config.php';

if (isset($_POST['export_receptionist'])) {

    // Set PHP headers for CSV output.
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=receptionists.csv');

    $header_args = array(
        'ID',
        'First Name',
        'Last Name',
        'Gender',
        'Age',
        'Phone No',
        'State',
        'City',
        'Address',
        'Aadhar No.',
        '12 Pass',
        'Email'
    );

    $result_receptionist = "SELECT * FROM receptionist;";
    $stmt = $conn->query($result_receptionist);
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
            $data_item['age'],
            $data_item['phone'],
            $data_item['state'],
            $data_item['city'],
            $data_item['address'],
            $data_item['aadhar_number'],
            $data_item['12_pass'],
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
    <?php require_once 'table_links.php'; ?>
    <?php require_once 'css_links.php'; ?>

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


        <button onclick="history.back()" style="background-color:#216ABE; padding:5px 15px 5px 15px;"
            class="btn btn-dark"><i class=" fa-solid fa-arrow-left"></i></button>

        <div class="button-group">
            <button class="btn btn-primary" style="display:inline; margin-right: 10px;  background-color:#216ABE;"><i
                    class="fa-solid fa-plus fa-xl"></i> <a href="form_receptionist.php" style="color:white;">Add
                    receptionist</a></button>

            <form method="POST" style="display:inline">
                <button type="submit" name="export_receptionist" class="btn btn-primary"
                    style="background-color:#216ABE;"><i class="fa-solid fa-file-export fa-xl"></i>Export receptionist
                    Details</button>
            </form>
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
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM receptionist ORDER BY id;";
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
                        <?php echo $row["age"]; ?>
                    </td>

                    <td>
                        <a href="view_receptionist_profile.php?id=<?php echo $row['id']; ?>"><i
                                class='material-icons'>visibility</i></a>
                        <a href="update_receptionist.php?id=<?php echo $row["id"]; ?>"><i class='material-icons'
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