<?php

session_start();
require 'dbcon.php';

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

    <title>Edit Movies</title>
</head>

<body>
    <div class="mt-5 container">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Movies
                            <a href="index.php" class="btn btn-danger float-end">Back</a>
                        </h4>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['id'])) {
                                $movie_id = mysqli_real_escape_string($con, $_GET['id']);
                                $query = "SELECT * FROM movie WHERE id='$movie_id'";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    $movie = mysqli_fetch_array($query_run);
                                    ?>
                                    <form action="code.php" method="POST">
                                        <input type='hidden' name="movie-id" value="<?= $movie['id'] ?>">
                                        <div class="mb-3">
                                            <label>Movie Title</label>
                                            <input type="text" value="<?= $movie['title']; ?>" name="movie-title" id=""
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Director</label>
                                            <input type="text" value="<?= $movie['director']; ?>" name="director" id=""
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Release Year</label>
                                            <input type="text" value="<?= $movie['release_year']; ?>" name="release-year" id=""
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" name="update-movie" class="btn btn-primary">Update
                                                Movie</button>
                                        </div>
                                    </form>
                                    <?php
                                } else {
                                    echo "<h4>No Such ID Found!</h4>";
                                }
                            }
                            ?>

                        </div>
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