<?php

session_start();
require 'dbcon.php';

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($con, "SELECT * FROM person WHERE user_id = $id");
    $person_row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
}

if (isset($_POST['delete_movie'])) {
    $movie_id = mysqli_real_escape_string($con, $_POST['delete_movie']);
    $query = "DELETE FROM movie  WHERE id='$movie_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Movie deleted successfully!";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Movie not deleted!";
        header("Location: index.php");
        exit(0);
    }
}

if (isset($_POST['update-movie'])) {
    $movie_id = mysqli_real_escape_string($con, $_POST['movie-id']);

    $movie_title = mysqli_real_escape_string($con, $_POST['movie-title']);
    $director = mysqli_real_escape_string($con, $_POST['director']);
    $release_year = mysqli_real_escape_string($con, $_POST['release-year']);

    $query = "UPDATE movie SET title='$movie_title', director='$director', release_year='$release_year' WHERE id='$movie_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Movie updated successfully!";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Movie not updated!";
        header("Location: index.php");
        exit(0);
    }
}

if (isset($_POST['save-movie'])) {
    $movie_title = mysqli_real_escape_string($con, $_POST['movie-title']);
    $director = mysqli_real_escape_string($con, $_POST['director']);
    $release_year = mysqli_real_escape_string($con, $_POST['release-year']);

    $query = "INSERT INTO movie (title,director,release_year) VALUES ('$movie_title','$director','$release_year')";

    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Movie created successfully!";
        header("Location: create-movies.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Movie not created!";
        header("Location: create-movies.php");
        exit(0);
    }
}


if (isset($_POST['select_ticket'])) {
    $showtime_id = mysqli_real_escape_string($con, $_POST['select_ticket']);
    $query_run = mysqli_query($con, "SELECT * FROM showtime WHERE showtime_id = $showtime_id");
    $showtime_row = mysqli_fetch_assoc($query_run);
    $movie_id = $showtime_row["movie_id"];
    $user_id = $_SESSION["id"];

    if ($query_run) {
        mysqli_query($con, "INSERT INTO ticket(amount,movie_id,showtime_id,user_id) VALUES('400','$movie_id','$showtime_id','$user_id')");
        // echo
        //     "<script> alert('Booking done successfully!');</script>";
        $_SESSION['message'] = "Booking done successfully!";
        header("Location: index.php");
        exit(0);
    } else {
        // echo
        //     "<script> alert('Booking was unsuccessful!');</script>";
        $_SESSION['message'] = "Booking was unsuccessful!";
        header("Location: index.php");
        exit(0);
    }
}


?>