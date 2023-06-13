<?php
session_start();
require 'dbcon.php'; // this is the connectin config file
// if (!empty($_SESSION['id'])) {
//     header("Location: index.php");
// }

if (isset($_POST["login"])) {
    $usernameoremail = mysqli_real_escape_string($con, $_POST['usernameoremail']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM person WHERE username = '$usernameoremail' OR email = '$usernameoremail'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if ($password == $row["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["user_id"];
            header("Location: index.php");
        } else {
            echo
                "<script> alert('Wrong password!'); </script>";
        }
    } else {
        echo
            "<script> alert('User not registered!'); </script>";
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
    <title>Login Page</title>
</head>

<body>
    <div class="container-md mt-5">
        <div class=" d-flex flex-row justify-content-center align-items-center">
            <div class="col-md-6">
                <h3>Login Yourself!</h3>
                <form action="" method="POST" autocomplete="off">

                    <div class="mb-3">
                        <label for="usernameoremail" class="form-label">Username or Email</label>
                        <input type="text" name="usernameoremail" required class="form-control" id="usernameoremail"
                            aria-describedby="">

                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>

                    <button type="submit" name="login" class="btn btn-primary mb-2">Submit</button>
                </form>
                <a href="registration.php">Or register yourself</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>