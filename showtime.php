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

if (isset($_POST['select_movie'])) {
    $movie_id = mysqli_real_escape_string($con, $_POST['select_movie']);
    $query = "SELECT * FROM movie WHERE id = $movie_id";
    $query_run = mysqli_query($con, $query);
    $movierow = mysqli_fetch_assoc($query_run);


    mysqli_query($con, "UPDATE showtime SET movie_id = $movie_id");

    // if ($query_run) {
    //     $_SESSION['message'] = "Movie deleted successfully!";
    //     header("Location: index.php");
    //     exit(0);
    // } else {
    //     $_SESSION['message'] = "Movie not deleted!";
    //     header("Location: index.php");
    //     exit(0);
    // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Movie Mania</title>
</head>

<body>
    <div class="container">
        <?php include('message.php') ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header py-2">
                        <h4><a href="index.php" class="black">Movie Mania</a>
                            <div class="float-end d-flex flex-row align-items-center">
                                <div>
                                    <a href="logout.php" class="fs-6">Log out</a>
                                    <p class="fs-6">Welcome
                                        <?php echo $row["username"]; ?>
                                    </p>
                                </div>
                                <a href="create-movies.php" class="btn btn-primary mx-2">Add Movies</a>
                            </div>

                        </h4>
                    </div>
                    <div class="card-body">
                        <div class=row>



                            <?php
                            $query = "SELECT * FROM showtime";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $showtime) {
                                    ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>
                                                    Movie Title:
                                                    <?php echo $movierow["title"]; ?>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <p>
                                                    Screen No :
                                                    <?= $showtime['screen_no']; ?>
                                                </p>
                                                <p>
                                                    Start Time :
                                                    <?= $showtime['start_time']; ?>
                                                </p>

                                                <form action="code.php" method="POST">

                                                    <button type="submit" name="select_ticket"
                                                        value="<?= $showtime['showtime_id']; ?>"
                                                        class="btn btn-primary float-end">Select Showtime</button>
                                                </form>


                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                            } else {
                                echo "<h5> No Record Found! </h5>";
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>