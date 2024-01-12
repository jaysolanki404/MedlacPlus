<?php require_once 'config/config.php';
require_once 'toaster.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/table.css">
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


                    <div id="page-wrapper">
                        <button onclick="history.back()" style="background-color:#e91e63; padding:5px 15px 5px 15px"
                            class="btn btn-dark"><i class=" fa-solid fa-arrow-left"></i></button>
                        <div class="row">

                            <div class="col-lg-6">
                                <h1></h1>
                                <hr>
                            </div>
                        </div>
                        <?php
                        require_once 'config/config.php';
                        $id = $_REQUEST['id'];

                        $query = "SELECT * FROM receptionist WHERE id = :id";
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
                                    <th class="example"><strong>Age</strong></th>
                                    <td>
                                        <?php echo $row["age"]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="example"><strong>Phone No</strong></th>
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
                                    <th class="example"><strong>Aadhar Card No.</strong></th>
                                    <td>
                                        <?php echo $row["aadhar_number"]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="example"><strong>12 Pass</strong></th>
                                    <td>
                                        <?php echo $row["12_pass"]; ?>
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
        </div>
        </div>
    </main>
    <?php require_once 'js_links.php'; ?>
</body>

</html>