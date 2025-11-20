<?php
require_once 'reservas.php';

// Crear reserva
$id = crearReserva([
    'profesional_rut' => '12.345.678-9',
    'profesional_nombre' => 'Dra. Ana Pérez',
    'paciente_rut' => '22.222.222-2',
    'paciente_nombre' => 'Juan Soto',
    'fecha' => '2025-11-18',
    'hora' => '10:45:00',
    'estado' => 'activa',
    'registrado_por' => 'Dra. Ana Pérez'
]);

// Consultar reservas
$reservas = obtenerReservas('12.345.678-9', '2025-11-18');
print_r($reservas);
?>