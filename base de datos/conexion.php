<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "escuela";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>