<?php
$host = "localhost";  // WAMP default: "localhost"
$user = "root";       // Default MySQL username
$pass = "";           // Default WAMP has no password (leave blank)
$db_name = "progresso";  // Change this to your database name

$conn = mysqli_connect($host, $user, $pass, $db_name);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
