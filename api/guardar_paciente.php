<?php
header('Content-Type: application/json');
include 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

$rut = $conn->real_escape_string($data['rut']);
$nombre = $conn->real_escape_string($data['nombre']);
$apellidos = $conn->real_escape_string($data['apellidos']);
$direccion = $conn->real_escape_string($data['direccion']);
$region = $conn->real_escape_string($data['region']);
$comuna = $conn->real_escape_string($data['comuna']);
$mail = $conn->real_escape_string($data['mail']);
$fono = intval($data['fono']);
$sangre = $conn->real_escape_string($data['sangre']);

$sql = "INSERT INTO pacientes (rut, nombre, apellidos, direccion, region, comuna, mail, fono, grupo_sangre)
        VALUES ('$rut', '$nombre', '$apellidos', '$direccion', '$region', '$comuna', '$mail', $fono, '$sangre')
        ON DUPLICATE KEY UPDATE
        nombre='$nombre', apellidos='$apellidos', direccion='$direccion', region='$region',
        comuna='$comuna', mail='$mail', fono=$fono, grupo_sangre='$sangre'";

if ($conn->query($sql) === TRUE) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "error" => $conn->error]);
}
$conn->close();
?>