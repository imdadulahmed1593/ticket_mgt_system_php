<?php
require 'dbcon.php';
session_start();
$_SESSION['id'] = null;
$_SESSION = [];
session_unset();
session_destroy();
header("Location: login.php");

?>