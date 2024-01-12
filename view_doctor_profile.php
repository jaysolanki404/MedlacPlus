<?php require_once 'toaster.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/table.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/display.css">

</head>

<body class="g-sidenav-show  bg-gray-100">

    <div class="sidebar">
        <?php require_once 'sidepenal.php'; ?>
    </div>
    <main class="main-content border-radius-lg ">

        <?php require_once 'header.php'; ?>


        <div class="container-fluid py-4">
            <div class="row" style="display:inline;">
                <div class="col-lg-7 position-relative z-index-2">
                    <button onclick="history.back()">Back</button>

                    <?php
                    require_once 'config/config.php';
                    $id = $_REQUEST['id'];

                    $query = "SELECT * FROM doctor WHERE id = :id";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        $row = $stmt->fetch();
                        ?>
                        <table border="1">
                            <tr>
                                <th class="example"><strong>id</strong></th>
                                <td>
                                    <?php echo $row["id"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>Profile Photo</strong></th>
                                <td>
                                    <?php
                                    $imageData_profile = $row['profile_photo'];
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData_profile) . '" alt="Profile Photo" />';
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="example"><strong>First Name</strong></th>
                                <td>
                                    <?php echo $row["first_name"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>Last Name</strong></th>
                                <td>
                                    <?php echo $row["last_name"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>Gender</strong></th>
                                <td>
                                    <?php echo $row["gender"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>Date of Birth </strong></th>
                                <td>
                                    <?php echo $row["dob"]; ?>
                                </td>
                            </tr>


                            <tr>
                                <th class="example"><strong>Phone</strong></th>
                                <td>
                                    <?php echo $row["phone"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>State</strong></th>
                                <td>
                                    <?php echo $row["state"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>City</strong></th>
                                <td>
                                    <?php echo $row["city"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>Address</strong></th>
                                <td>
                                    <?php echo $row["address"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>Hospital</strong></th>
                                <td>
                                    <?php echo $row["hospital"]; ?>
                                </td>
                            </tr>


                            <tr>
                                <th class="example"><strong>Qualification</strong></th>
                                <td>
                                    <?php echo $row["qualification"]; ?>
                                </td>
                            </tr>

                            <th class="example"><strong>Specialist</strong></th>
                            <td>
                                <?php echo $row["specialist"]; ?>
                            </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>License Number</strong></th>
                                <td>
                                    <?php echo $row["license_number"]; ?>
                                </td>
                            </tr>




                            <tr>
                                <th class="example"><strong>License Photo</strong></th>
                                <td>
                                    <?php
                                    $imageData_profile = $row['profile_photo'];
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData_profile) . '" alt="Profile Photo" />';
                                    ?>
                                </td>
                            </tr>





                            <tr>

                                <th class="example"><strong>Aadhar Number</strong></th>
                                <td>
                                    <?php echo $row["aadhar_number"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>Digital Signature </strong></th>
                                <td>
                                    <?php
                                    $imageData_profile = $row['profile_photo'];
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData_profile) . '" alt="Profile Photo" />';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="example"><strong>Email</strong></th>
                                <td>
                                    <?php echo $row["email"]; ?>
                                </td>
                            </tr>


                        </table>
                        <?php
                    } else {
                        echo "No records found.";
                    }
                    ?>
                </div>
            </div>
        </div>


    </main>

    <?php require_once 'js_links.php'; ?>


    <script src="assets/js/delete.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>

</body>

</html>