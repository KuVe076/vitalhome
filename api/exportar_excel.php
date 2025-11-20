<?php
require_once 'db.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Agenda_" . date("Ymd_His") . ".xls");

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
$datos = $stmt->fetchAll();

// Encabezado de tabla
echo "<table border='1'>";
echo "<tr>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Paciente</th>
        <th>RUT Paciente</th>
        <th>Estado</th>
        <th>Registrado por</th>
      </tr>";

// Filas
foreach ($datos as $fila) {
  echo "<tr>
          <td>{$fila['fecha']}</td>
          <td>{$fila['hora']}</td>
          <td>{$fila['paciente_nombre']}</td>
          <td>{$fila['paciente_rut']}</td>
          <td>{$fila['estado']}</td>
          <td>{$fila['registrado_por']}</td>
        </tr>";
}
echo "</table>";
?>