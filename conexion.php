<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');

$host = "localhost";
$user = "root";
$pass = "";
$db = "tablero_php";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
