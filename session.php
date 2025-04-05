<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $_SESSION['id'] = $_POST['id'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['role'] = $_POST['role'];
}
?>
<form method="POST">
    id<input type="text" name="id"><br>
    email<input type="email" name="email"><br>
    role<input type="text" name="role"><br>
    <input type="submit">
</form>