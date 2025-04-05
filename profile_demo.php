<?php
require_once 'toaster.php';
require_once 'config/config.php';
$id = $_SESSION['id'];
$query = "SELECT * FROM patient WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <style>
        /* Import Font Dancing Script */
        @import url(https://fonts.googleapis.com/css?family=Dancing+Script);

        * {
            margin: 0;
        }

        body {
            background-color: #e8f5ff;
            font-family: Arial;
            overflow: hidden;
        }

        /* NavbarTop */
        .navbar-top {
            background-color: #fff;
            color: #333;
            box-shadow: 0px 4px 8px 0px grey;
            height: 70px;
        }

        .title {
            font-family: 'Dancing Script', cursive;
            padding-top: 15px;
            position: absolute;
            left: 45%;
        }

        .navbar-top ul {
            float: right;
            list-style-type: none;
            margin: 0;
            overflow: hidden;
            padding: 18px 50px 0 40px;
        }

        .navbar-top ul li {
            float: left;
        }

        .navbar-top ul li a {
            color: #333;
            padding: 14px 16px;
            text-align: center;
            text-decoration: none;
        }

        .icon-count {
            background-color: #ff0000;
            color: #fff;
            float: right;
            font-size: 11px;
            left: -25px;
            padding: 2px;
            position: relative;
        }

        /* End */

        /* Sidenav */
        .sidenav {
            background-color: #fff;
            color: #333;
            border-bottom-right-radius: 25px;
            height: 86%;
            left: 0;
            overflow-x: hidden;
            padding-top: 20px;
            position: absolute;
            top: 70px;
            width: 250px;
        }

        .profile {
            margin-bottom: 20px;
            margin-top: -12px;
            text-align: center;
        }

        .profile img {
            border-radius: 50%;
            box-shadow: 0px 0px 5px 1px grey;
        }

        .name {
            font-size: 20px;
            font-weight: bold;
            padding-top: 20px;
        }

        .job {
            font-size: 16px;
            font-weight: bold;
            padding-top: 10px;
        }

        .url,
        hr {
            text-align: center;
        }

        .url hr {
            margin-left: 20%;
            width: 60%;
        }

        .url a {
            color: #818181;
            display: block;
            font-size: 20px;
            margin: 10px 0;
            padding: 6px 8px;
            text-decoration: none;
        }

        .url a:hover,
        .url .active {
            background-color: #e8f5ff;
            border-radius: 28px;
            color: #000;
            margin-left: 14%;
            width: 65%;
        }

        /* End */

        /* Main */
        .main {
            margin-top: 2%;
            margin-left: 29%;
            font-size: 28px;
            padding: 0 10px;
            width: 58%;
        }

        .main h2 {
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .main .card {
            background-color: #fff;
            border-radius: 18px;
            box-shadow: 1px 1px 8px 0 grey;
            height: auto;
            margin-bottom: 20px;
            padding: 20px 0 20px 50px;
        }

        .main .card table {
            border: none;
            font-size: 16px;
            height: 270px;
            width: 80%;
        }

        .edit {
            position: absolute;
            color: #e7e7e8;
            right: 14%;
        }


        /* End */
    </style>

    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
</head>

<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1>Profile</h1>
        </div>

        <!-- Navbar -->
        <ul>
            <li>
                <a href="#message">
                    <span class="icon-count">29</span>
                    <i class="fa fa-envelope fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="#notification">
                    <span class="icon-count">59</span>
                    <i class="fa fa-bell fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="#sign-out">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
        <!-- End -->
    </div>
    <!-- End -->

    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <?php
            // Display the image using the appropriate content type
            $imageData = $row['profile_photo'];
            echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="License Photo" />';
            ?>


            <div class="name">
                <?php echo $row['first_name']; ?>
            </div>

        </div>

        <div class="sidenav-url">
            <div class="url">
                <a href="#profile" class="active">Profile</a>
                <hr align="center">
            </div>
            <div class="url">
                <a href="#settings">Settings</a>
                <hr align="center">
            </div>
        </div>
    </div>
    <!-- End -->

    <!-- Main -->
    <div class="main">
        <h2>IDENTITY</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <table>
                    <tbody>
                        <tr>
                            <td> First Name</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['first_name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Last Name</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['last_name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Gender</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['gender']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Blood Group</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['blood_group']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Date Of Birth</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['dob']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Phone No.</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['phone']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Aadhar No.</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['aadhar']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['state']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Ciry</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['city']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['address']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- End -->



     <!-- Change Password Section -->
    <div class="card" id="change-password" style="display: none;">
        <div class="card-body">
            <h2>Change Password</h2>
            <!-- Add your form for changing password here -->
            <!-- For example: -->
            <form action="change_password.php" method="post">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new_password" required>
                
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
                
                <button type="submit">Change Password</button>
            </form>
        </div>
    </div>
</div>

<!-- ... Existing HTML and JavaScript code ... -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the elements
        var profileLink = document.querySelector('.url a[href="#profile"]');
        var settingsLink = document.querySelector('.url a[href="#settings"]');
        var profileSection = document.querySelector('.card');
        var changePasswordSection = document.getElementById('change-password');

        // Add a click event listener to the "Profile" link
        profileLink.addEventListener('click', function (event) {
            // Prevent the default behavior of the link
            event.preventDefault();

            // Show the profile section and hide the change password section
            profileSection.style.display = 'block';
            changePasswordSection.style.display = 'none';
        });

        // Add a click event listener to the "Settings" link
        settingsLink.addEventListener('click', function (event) {
            // Prevent the default behavior of the link
            event.preventDefault();

            // Hide the profile section and show the change password section
            profileSection.style.display = 'none';
            changePasswordSection.style.display = 'block';
        });
    });
</script>
</body>

</html>