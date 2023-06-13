<?php

$con = mysqli_connect("localhost", "root", "", "ticket_mgt_system");

if (!$con) {
    die('Connection failed' . mysqli_connect_error());
}

?>