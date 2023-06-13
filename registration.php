<?php
session_start();
require 'dbcon.php';
if (!empty($_SESSION['id'])) {
    header("Location: index.php");
}
if (isset($_POST["register"])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmpwd = mysqli_real_escape_string($con, $_POST['confirmpwd']);
    $duplicate = mysqli_query($con, "SELECT * FROM person WHERE username='$username' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo
            "<script> alert('Username or Email has already been taken');</script>";
    } else {
        if ($password == $confirmpwd) {
            $query = "INSERT INTO person(name,username,email,password) VALUES('$name','$username','$email','$password')";
            mysqli_query($con, $query);
            echo
                "<script> alert('registration successful!');</script>";
        } else {
            echo
                "<script> alert('password does not match');</script>";
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Registration Page</title>
</head>

<body>
    <div class="container-md mt-5">
        <div class=" d-flex flex-row justify-content-center align-items-center">
            <div class="col-md-6">
                <h3>Register Yourself!</h3>
                <form action="" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="" required>

                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby=""
                            required>

                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="" required>

                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmpwd" class="form-label">Confirm Password</label>
                        <input type="password" name="confirmpwd" class="form-control" id="confirmpwd" required>
                    </div>

                    <button type="submit" name="register" class="btn btn-primary mb-2">Submit</button>
                </form>
                <a class="my-3" href="login.php">Or login</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>