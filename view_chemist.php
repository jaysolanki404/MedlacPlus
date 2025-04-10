<?php require_once 'config/config.php';
$tableName = 'chemist'; ?>



<?php

require_once 'config/config.php';

if (isset($_POST['export_chemist'])) {

    // Set PHP headers for CSV output.
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=chemists.csv');

    $header_args = array(
        'ID',
        'First Name',
        'Last Name',
        'Age',
        'Phone',
        'city',
        'state',
        'Address',
        'License No.',
        'Aadhar',
        'Email'
    );

    $result_chemist = "SELECT * FROM chemist;";
    $stmt = $conn->query($result_chemist);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = fopen('php://output', 'w');

    fputcsv($output, $header_args);

    foreach ($data as $data_item) {
        // You can reorder the fields as needed here to match your CSV structure.
        fputcsv($output, [
            $data_item['id'],
            $data_item['first_name'],
            $data_item['last_name'],
            $data_item['age'],
            $data_item['phone'],
            $data_item['city'],
            $data_item['state'],
            $data_item['address'],
            $data_item['license_number'],
            $data_item['aadhar_number'],
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.semanticui.min.css" />

    <?php require_once 'css_links.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/72c602bb8f.js" crossorigin="anonymous"></script>
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
        <!-- new button -->

        <div class="button-group">
            <button style="background-color:#216ABE;" class="btn btn-primary"
                style="display:inline; margin-right: 10px;"><i class="fa-solid fa-plus fa-xl"></i> <a
                    href="form_chemist.php" style="color:white;">Add
                    chemist</a></button>
            <!---export--->
            <form method="POST" style="display:inline">
                <button style="background-color:#216ABE;" type="submit" name="export_chemist" class="btn btn-primary"><i
                        class="fa-solid fa-file-export fa-xl"></i>Export chemist Details</button>
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
                $query = "SELECT * FROM chemist ORDER BY id;";
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
                        <a href="view_chemist_profile.php?id=<?php echo $row['id']; ?>"><i
                                class='material-icons'>visibility</i></a>
                        <a href="update_chemist.php?id=<?php echo $row["id"]; ?>"><i class='material-icons'
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