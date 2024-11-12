<?php
$servername = "sql12.freesqldatabase.com";
$username = "sql12743622";
$password = "fFcf32Snex";
$dbname = "sql12743622";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
