<?php
$host = "localhost";
$user = "root";
$password = ""; // Cambia si tienes contraseña
$db = "vitalhome_db";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>