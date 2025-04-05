<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="card mt-5" style="width:500px">
            <div class="card-header">
                <h1 class="text-center">Forgot Password</h1>
            </div>
            <div class="card-body">
                <form action="send_mail.php" method="post">
                    <div class="mt-4">
                        <label for="email">Email : </label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>

                    <div class="mt-4">
                        <label class="form-label">role</label><br>
                            <input type="radio" id="admin" name="role" value="admin">admin &nbsp;
                            <input type="radio" id="patient" name="role" value="patient">patient &nbsp;
                            <input type="radio" id="doctor" name="role" value="doctor">doctor &nbsp;
                            <input type="radio" id="chemist" name="role" value="chemist">chemist &nbsp;
                            <input type="radio" id="receptionist" name="role" value="receptionist">receptionist
                    </div>
                    <div class="mt-4 text-end">
                        <input type="submit" name="send-link" class="btn btn-primary">
                        <a href="index.php" class="btn btn-danger">Back</a>
                    </div>            
                </form>
            </div>
        </div>
    </div>
</body>
</html>
