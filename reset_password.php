<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the new password and confirm password match
    if ($new_password === $confirm_password) {
        $role = $_SESSION['role']; // Retrieve the role from the session

        // Hash the new password before updating it in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $sql = "UPDATE $role SET password = :password WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Password reset successful
            echo '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Password Reset Success</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
            </head>
            <body>
                <div class="container d-flex justify-content-center mt-5 pt-5">
                    <div class="card mt-5" style="width:500px">
                        <div class="card-header">
                            <h1 class="text-center">Password Reset Success</h1>
                        </div>
                        <div class="card-body">
                            <p class="text-success">Your password has been successfully reset.</p>
                            <a href="index.php" class="btn btn-primary">Login</a>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
        } else {
            // Password reset failed
            echo '<p class="text-danger">Password reset failed. Please try again later.</p>';
        }
    } else {
        // Passwords don't match
        echo '<p class="text-danger">New password and confirm password do not match.</p>';
    }
} else {
    // Invalid request
    echo '<p class="text-danger">Invalid request.</p>';
}
?>
