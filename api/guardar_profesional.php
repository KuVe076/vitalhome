<?php
header('Content-Type: application/json');

// Configuración básica para guardar archivo y datos
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Validar campos obligatorios
$requiredFields = ['rut', 'nombre', 'apellidos', 'profesion', 'registro_sis', 'mail', 'region', 'comuna', 'fecha_ingreso', 'activo'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'error' => "El campo $field es obligatorio."]);
        exit;
    }
}

// Recoger datos
$rut = trim($_POST['rut']);
$nombre = trim($_POST['nombre']);
$apellidos = trim($_POST['apellidos']);
$profesion = trim($_POST['profesion']);
$registro_sis = trim($_POST['registro_sis']);
$mail = trim($_POST['mail']);
$region = $_POST['region'];
$comuna = $_POST['comuna'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$activo = $_POST['activo'];
$motivo = isset($_POST['motivo']) ? trim($_POST['motivo']) : '';

// Manejo del archivo PDF
$cvPath = '';
if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['cv']['tmp_name'];
    $fileName = basename($_FILES['cv']['name']);
    $fileSize = $_FILES['cv']['size'];
    $fileType = $_FILES['cv']['type'];

    // Validar tipo y tamaño (ejemplo: max 5MB)
    $allowedMimeTypes = ['application/pdf'];
    if (!in_array($fileType, $allowedMimeTypes)) {
        echo json_encode(['success' => false, 'error' => 'Solo se permiten archivos PDF.']);
        exit;
    }
    if ($fileSize > 5 * 1024 * 1024) {
        echo json_encode(['success' => false, 'error' => 'El archivo es demasiado grande. Máximo 5MB.']);
        exit;
    }

    // Guardar archivo
    $destPath = $uploadDir . uniqid() . '_' . $fileName;
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        $cvPath = $destPath;
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al guardar el archivo.']);
        exit;
    }
}

// Aquí puedes agregar la lógica para guardar los datos en base de datos
// Por ahora, solo respondemos éxito

echo json_encode(['success' => true]);
exit;
?>