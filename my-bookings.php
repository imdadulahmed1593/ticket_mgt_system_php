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
                            <a href="index.php" class="btn btn-primary float-end m-2">Back to home</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Start Time</th>
                                    <th>Movie Title</th>
                                    <th>Ticket Price</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION["id"];
                                $query = "SELECT * FROM ticket WHERE user_id ='$user_id'";
                                $query_run = mysqli_query($con, $query);


                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $ticket) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $ticket['ticket_id']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $user_id = $_SESSION["id"];
                                                $result = mysqli_query($con, "SELECT * FROM person WHERE user_id = '$user_id'");
                                                $row = mysqli_fetch_assoc($result);
                                                echo $row["name"];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $showtime_id = $ticket["showtime_id"];
                                                $result = mysqli_query($con, "SELECT * FROM showtime WHERE showtime_id = '$showtime_id'");
                                                $row = mysqli_fetch_assoc($result);
                                                echo $row["start_time"];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $movie_id = $ticket["movie_id"];
                                                $result = mysqli_query($con, "SELECT * FROM movie WHERE id = '$movie_id'");
                                                $row = mysqli_fetch_assoc($result);
                                                echo $row["title"];
                                                ?>
                                            </td>
                                            <td>
                                                <?= $ticket['amount']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<h5> No Record Found! </h5>";
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