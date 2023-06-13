<?php

session_start();
require 'dbcon.php';

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($con, "SELECT * FROM person WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>My bookings</title>
</head>

<body>
    <div class="container mt-5">
        <?php include('message.php') ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <h4>My bookings</h4>
                        <div class="d-flex flex-row align-items-center">
                            <p class="m-0">Welcome
                                <span class="fw-bold">
                                    <?php echo $row["username"]; ?>
                                </span>
                            </p>
                            <form action="" method="POST" class="d-inline mx-2">
                                <input type="text" name="search" id="search">
                                <button type="submit" name="search-movie"
                                    class="btn btn-success btn-sm mx-2">Search</button>
                            </form>
                            <a href="index.php" class="btn btn-primary float-end m-2">Back to home</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['search-movie'])) {
                                    $search_val = mysqli_real_escape_string($con, $_POST['search']);
                                    $query2 = "SELECT * FROM person WHERE username LIKE '%$search_val%'";
                                    $query_run2 = mysqli_query($con, $query2);
                                    // echo $search_val;
                                    if (mysqli_num_rows($query_run2) > 0) {
                                        foreach ($query_run2 as $person) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $person['user_id']; ?>
                                                </td>
                                                <td>
                                                    <?= $person['role']; ?>
                                                </td>
                                                <td>
                                                    <?= $person['name']; ?>
                                                </td>
                                                <td>
                                                    <?= $person['email']; ?>
                                                </td>
                                                <td>
                                                    <?= $person['username']; ?>
                                                </td>


                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<h5> No Record Found! </h5>";
                                    }

                                } else {
                                    $query = "SELECT * FROM person";
                                    $query_run = mysqli_query($con, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $person) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $person['user_id']; ?>
                                                </td>
                                                <td>
                                                    <?= $person['role']; ?>
                                                </td>
                                                <td>
                                                    <?= $person['name']; ?>
                                                </td>
                                                <td>
                                                    <?= $person['email']; ?>
                                                </td>
                                                <td>
                                                    <?= $person['username']; ?>
                                                </td>


                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<h5> No Record Found! </h5>";
                                    }
                                }





                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


</body>

</html>