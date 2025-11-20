<?php
require_once 'reservas.php';

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    if (isset($_GET['id'])) {
      echo json_encode(obtenerReservaPorId($_GET['id']));
    } elseif (isset($_GET['profesional_rut'], $_GET['fecha'])) {
      echo json_encode(obtenerReservas($_GET['profesional_rut'], $_GET['fecha']));
    } else {
      http_response_code(400);
      echo json_encode(['error' => 'Parámetros faltantes']);
    }
    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'), true);
    $id = crearReserva($data);
    echo json_encode(['id' => $id]);
    break;

  case 'PUT':
    parse_str(file_get_contents("php://input"), $data);
    if (!isset($data['id'])) {
      http_response_code(400);
      echo json_encode(['error' => 'ID requerido']);
      break;
    }
    $ok = editarReserva($data['id'], $data);
    echo json_encode(['success' => $ok]);
    break;

  case 'DELETE':
    parse_str(file_get_contents("php://input"), $data);
    $ok = eliminarReserva($data['id']);
    echo json_encode(['success' => $ok]);
    break;

  default:
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>