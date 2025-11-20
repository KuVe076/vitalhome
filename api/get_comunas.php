<?php
header('Content-Type: application/json');
include 'conexion.php';

$region = $conn->real_escape_string($_GET['region']);
$sql = "SELECT comuna FROM regiones_comunas WHERE region = '$region' ORDER BY comuna ASC";
$result = $conn->query($sql);

$comunas = [];
while ($row = $result->fetch_assoc()) {
  $comunas[] = $row['comuna'];
}
echo json_encode($comunas);
$conn->close();
?>