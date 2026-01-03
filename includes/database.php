<?php
$host = "127.0.0.1";
$database = "boxing_rankings";
$user = "root";
$password = "";

$db = mysqli_connect($host, $user, $password, $database);

if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}
