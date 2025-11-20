<?php
header('Content-Type: application/json');
include 'conexion.php';

$sql = "SELECT DISTINCT region FROM regiones_comunas ORDER BY region ASC";
$result = $conn->query($sql);

$regiones = [];
while ($row = $result->fetch_assoc()) {
  $regiones[] = $row['region'];
}
echo json_encode($regiones);
$conn->close();
?>