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

  <title>Movie Mania</title>
</head>

<body>
  <div class="container">
    <?php include('message.php') ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header py-2">
            <h4><a href="index.php" class="black">Movie Mania</a></h4>
            <div class="float-end d-flex flex-row align-items-center">
              <div>
                <a href="logout.php" class="fs-6">Log out</a>
                <p class="fs-6">Welcome
                  <?php echo $row["username"]; ?>
                </p>
              </div>
              <?php
              if ($row["role"] == 'user') {
                ?>
                <div>
                  <a href="my-bookings.php" class="btn btn-primary mx-2">My Bookings</a>
                </div>
                <?php
              } else {
                ?>
                <div class="d-flex flex-row justify-content-between align-items-center">
                  <div>
                    <a href="create-movies.php" class="btn btn-primary mx-2">Add Movies</a>
                  </div>
                  <div>
                    <a href="all-bookings.php" class="btn btn-primary mx-2">All Bookings</a>
                  </div>
                  <div>
                    <a href="all-users.php" class="btn btn-primary mx-2">All Users</a>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
          </div>


          <div class="card-body">
            <div class=row>



              <?php
              $query = "SELECT * FROM movie";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $movie) {
                  ?>
                  <div class="col-md-4 mb-4">
                    <div class="card">
                      <div class="card-header">
                        <h5>
                          <?= $movie['title']; ?>
                        </h5>
                      </div>
                      <div class="card-body">
                        <p>
                          Director :
                          <?= $movie['director']; ?>
                        </p>
                        <p>
                          Release Year :
                          <?= $movie['release_year']; ?>
                        </p>
                        <?php
                        if ($row["role"] == 'admin') {
                          ?>
                          <div class="mb-3">
                            <a href="view-movie.php?id=<?= $movie['id'] ?>" class="btn btn-info btn-sm">View</a>
                            <a href="edit-movie.php?id=<?= $movie['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                            <form action="code.php" method="POST" class="d-inline">
                              <button type="submit" class="btn btn-danger btn-sm" name="delete_movie"
                                value="<?= $movie['id']; ?>" class="bn btn-danger btn-sm">Delete</button>
                            </form>
                          </div>
                          <?php
                        } else {
                          ?>
                          <form action="showtime.php" method="POST">

                            <button type="submit" name="select_movie" value="<?= $movie['id']; ?>"
                              class="btn btn-primary float-end">Select Movie</button>
                          </form>
                          <?php
                        }
                        ?>




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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>


</body>

</html>