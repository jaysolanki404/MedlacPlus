<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="card mt-5" style="width:500px">
            <div class="card-header">
                <h1 class="text-center">Reset Password</h1>
            </div>
            <div class="card-body">
                <?php
                require_once 'config/config.php';

                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    if (isset($_GET['email'])) {
                        $email = $_GET['email'];
                        $role = $_SESSION['role']; // Retrieve the role from the session

                        // Check if the email and role combination is valid
                        $sql = "SELECT * FROM $role WHERE email = :email";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();

                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row) {
                            // Valid email and role, allow the user to reset the password
                            echo '
                            <form action="reset_password.php" method="post">
                                <input type="hidden" name="email" value="' . $email . '">
                                <div class="mt-4">
                                    <label for="password">New Password : </label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter New Password" required>
                                </div>

                                <div class="mt-4">
                                    <label for="confirm_password">Confirm Password : </label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" required>
                                </div>

                                <div class="mt-4 text-end">
                                    <input type="submit" name="reset_password" class="btn btn-primary" value="Reset Password">
                                </div>
                            </form>';
                        } else {
                            // Invalid email and role combination
                            echo '
                            <p class="text-danger">Invalid email address or role.</p>
                            <a href="index.php" class="btn btn-danger">Back to Home</a>';
                        }
                    } else {
                        // Email parameter not provided
                        echo '
                        <p class="text-danger">Email parameter missing.</p>
                        <a href="index.php" class="btn btn-danger">Back to Home</a>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
