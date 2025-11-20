<?php
require_once 'db.php';

$rut = $_GET['rut'] ?? '';
$inicio = $_GET['inicio'] ?? '';
$fin = $_GET['fin'] ?? '';
$estado = $_GET['estado'] ?? '';

$sql = "SELECT fecha, hora, paciente_nombre, paciente_rut, estado, registrado_por
        FROM reservas
        WHERE 1=1";

$params = [];

if ($rut) {
  $sql .= " AND profesional_rut = ?";
  $params[] = $rut;
}
if ($inicio && $fin) {
  $sql .= " AND fecha BETWEEN ? AND ?";
  $params[] = $inicio;
  $params[] = $fin;
}
if ($estado) {
  $sql .= " AND estado = ?";
  $params[] = $estado;
}

$sql .= " ORDER BY fecha ASC, hora ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
echo json_encode($stmt->fetchAll());
?>