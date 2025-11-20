function obtenerReservaPorId($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM reservas WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}